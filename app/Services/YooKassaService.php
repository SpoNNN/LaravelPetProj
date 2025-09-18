<?php

namespace App\Services;

use YooKassa\Client;
use Illuminate\Support\Facades\Log;

class YooKassaService
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();

        $this->client->setAuth(config('app.yookassa.shop_id'), config('app.yookassa.secret_key'));
    }

    public function createPayment($donation, $returnUrl)
    {
        try {
            $payment = $this->client->createPayment([
                'amount' => [
                    'value' => $donation->amount,
                    'currency' => 'RUB',
                ],
                'confirmation' => [
                    'type' => 'redirect',
                    'return_url' => $returnUrl,
                ],
                'capture' => true,
                'description' => "Донат от {$donation->donator_name}",
                'metadata' => [
                    'donation_id' => $donation->id,
                    'user_id' => $donation->user_id,
                ],
            ], uniqid('', true));

            return [
                'success' => true,
                'payment_url' => $payment->getConfirmation()->getConfirmationUrl(),
                'payment_id' => $payment->getId()
            ];

        } catch (\Exception $e) {
            Log::error('YooKassa payment creation failed: ' . $e->getMessage());

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function checkPaymentStatus($paymentId)
    {
        try {
            return $this->client->getPaymentInfo($paymentId);
        } catch (\Exception $e) {
            Log::error('YooKassa payment status check failed: ' . $e->getMessage());
            return null;
        }
    }
  
}