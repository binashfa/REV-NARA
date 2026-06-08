<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function checkForgotPassword(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'nama' => 'required'
        ]);

        $user = User::where('username', $request->username)
            ->where(function ($query) use ($request) {

                $query->whereHas('guru', function ($q) use ($request) {
                    $q->where('nama', $request->nama);
                });

                $query->orWhereHas('operator', function ($q) use ($request) {
                    $q->where('nama', $request->nama);
                });
            })
            ->first();

        if (!$user) {

            return back()->with(
                'error',
                'Username atau Nama tidak sesuai'
            );
        }

        return redirect(
            '/reset-password/' . $user->id
        );
    }


    public function resetPassword($id)
    {
        $user = User::findOrFail($id);

        return view(
            'auth.reset-password',
            compact('user')
        );
    }


    public function updatePassword(
        Request $request,
        $id
    ) {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::findOrFail($id);

        $user->password = Hash::make(
            $request->password
        );

        $user->save();

        return redirect('/login')
            ->with(
                'success',
                'Password berhasil diganti'
            );
    }
}
