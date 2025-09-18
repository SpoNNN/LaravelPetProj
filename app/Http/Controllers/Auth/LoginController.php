<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
class LoginController extends Controller
{
    public function login(Request $r)
    {
        if (Auth::attempt(['email' => $r->email, 'password' => $r->password])) {

            return redirect('/profile');

        } else {

            return response()->json(['errors' => ['emailpassword' => ['Неверная почта или пароль']]], 400);

        }
    }
    public function logout(Request $r)
    {
        Auth::logout();

        $r->session()->invalidate();

        $r->session()->regenerateToken();
        return redirect('/');
    }
}

