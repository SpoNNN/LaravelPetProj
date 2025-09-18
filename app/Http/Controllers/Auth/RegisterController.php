<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UserRequest;

class RegisterController extends Controller
{
    public function create(UserRequest $r)
    {
        $user = User::create([
            'login' => $r->login,
            'email' => $r->email,
            'password' => Hash::make($r->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home.index');
    }
}
