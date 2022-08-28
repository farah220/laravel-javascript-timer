<?php

namespace App\Http\Controllers\auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function Login(Request $request)
    {

        $credentials = $request->validate([
            'email' => [ 'required', 'email' , 'max:255','exists:users'],
            'password' => [ 'required', 'min:8'],
        ]);

        if (auth('web')->attempt($credentials))

          return redirect()->route('timers.index');

        throw ValidationException::withMessages(['password' => 'invalid password']);
    }

    public function register()
    {

        $attributes = request()->validate([
            'name' => ['required','max:255','min:3'],
            'email' => ['required','max:255','email'],
            'password' => ['required','min:6','max:255','confirmed'],
            'password_confirmation' => ['required','min:6','max:255','same:password']
        ]);

        $user= User::create($attributes);
        auth('web')->login($user);
        return redirect()->route('timers.index');
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('web.login-form');
    }

}
