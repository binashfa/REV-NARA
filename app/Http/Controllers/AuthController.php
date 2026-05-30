<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only(
            'username',
            'password'
        );

        if (Auth::attempt($credentials)) {

            if (Auth::user()->role == 'operator') {

                return redirect('/operator/dashboard');

            }

            return redirect('/guru');
        }

        return back()->with(
            'error',
            'Login gagal'
        );
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}