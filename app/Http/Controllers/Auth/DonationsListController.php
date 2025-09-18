<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donations;
use App\Models\User;
class DonationsListController extends Controller
{
    public function index(Request $request)
    {
        $balance = User::select('balance')->where("id", auth()->user()->id)->first();

        $donateList = Donations::where('user_id', auth()->user()->id)
            ->where('status', 'succeeded')
            ->orderBy('updated_at', 'desc')->get();

        return view("pages.auth.donationsList", compact("donateList"), compact("balance"));
    }
}
