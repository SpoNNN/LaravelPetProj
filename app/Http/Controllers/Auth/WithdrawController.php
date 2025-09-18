<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class WithdrawController extends Controller
{
   public function index()
   {
      $balance = User::select('balance')->where("id", auth()->user()->id)->first();
      return view("pages.auth.withdraw", compact("balance"));

   }
}
