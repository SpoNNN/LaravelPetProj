<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Laravel\Pail\ValueObjects\Origin\Console;
class HomeController extends Controller
{
    public function index()
    {
        $donate_card = Profile::all();
       
        $users = User::select('id', 'login')
            ->orderBy('id')
            ->get();
           // echo($donate_card);
        return view('pages.home', compact('users'), compact('donate_card'));

    }




}
