<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Events\DonateSuccesfull;
use App\Services\YooKassaService;

use App\Models\Profile;
use App\Models\Donations;
use App\Models\User;

class DonateController extends Controller
{
    public function show(Request $request, $id)
    {
        $donate = Profile::where("user_id", $id)->first();
        return view("pages.donate", compact("donate"));
    }

    public function __construct(private YooKassaService $yooKassaService)
    {
    }

    public function create(DonateRequest $request, $id)
    {

        $isAnonymous = (int) ($request->input('anonymous', 0));

        return DB::transaction(function () use ($request, $id, $isAnonymous) {
            $donation = Donations::create([
                'user_id' => $id,
                'donator_name' => $isAnonymous ? 'Аноним' : $request->donator_name,
                'message' => $request->message,
                'amount' => $request->amount,
                'anonymous' => $isAnonymous,
                'status' => 'pending',
                'email' => $request->email ?: null,
            ]);

            $returnToken = \Str::uuid()->toString();
            $donation->update(['return_token' => $returnToken]);

            $returnUrl = route('donation.callback', ['token' => $returnToken]);
            $result = $this->yooKassaService->createPayment($donation, $returnUrl);

            if (!$result['success']) {
                return redirect()->route('donation.error')->with('error', 'Ошибка создания платежа');
            }

            $donation->update([
                'payment_id' => $result['payment_id'],
                'payment_data' => [
                    'payment_url' => $result['payment_url'],
                    'return_url' => $returnUrl,
                ],
            ]);

            return redirect($result['payment_url']);
        });
    }

    public function callback(Request $request)
    {

        $token = $request->query('token');
        $donation = Donations::where('return_token', $token)->first();

        if ($donation) {
            if ($donation->status === 'succeeded') {
                User::where('id', $donation->user_id)
                    ->increment('balance', $donation->amount);

                if ($donation->email != null)
                    event(new DonateSuccesfull($donation));
                return redirect()->route('home.index')->with(compact('donation'));
            } elseif ($donation->status === 'canceled') {
                return view('error', [
                    'donation' => $donation,
                    'reason' => 'Платёж отменён',
                ]);
            } elseif (in_array($donation->status, ['pending', 'waiting_for_capture'])) {
                return view('pending', compact('donation'));
            }
        }

        return redirect()->route('donation.error');
    }

    public function webhook(Request $request)
    {

        $data = $request->all();
        $paymentId = $data['object']['id'];


        if ($paymentId) {
            $donation = Donations::where('payment_id', $paymentId)->first();

            if ($donation) {
                switch ($data['event']) {
                    case 'payment.succeeded':
                        $donation->markAsSucceeded();
                        break;

                    case 'payment.canceled':
                        $details = $data['object']['cancellation_details'] ?? [];

                        $donation->markAsCanceled();
                        $donation->cancellation_reason = $details['reason'] ?? null;
                        break;

                    case 'payment.waiting_for_capture':
                        $donation->markAsWaitingForCapture();
                        break;
                }
            }
        }

        return response()->json(['status' => 'ok']);
    }


    public function checkStatus($paymentId)
    {
        $donation = Donations::where('payment_id', $paymentId)->firstOrFail();
        $payment = $this->yooKassaService->checkPaymentStatus($paymentId);

        if ($payment) {
            $donation->update(['status' => $payment->getStatus()]);
        }

        return response()->json([
            'donation_status' => $donation->status,
            'payment_status' => $payment->getStatus(),
        ]);
    }


}
