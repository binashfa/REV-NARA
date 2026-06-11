<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(
            'username',
            'password'
        );

        if (!Auth::attempt($credentials)) {

            return response()->json([
                'success' => false,
                'message' => 'Username atau Password salah'
            ], 401);
        }

        $user = Auth::user();

        $token = $user
            ->createToken('flutter')
            ->plainTextToken;

        $role = null;

        if ($user->guru) {
            $role = 'guru';
        }

        if ($user->operator) {
            $role = 'operator';
        }

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user,
            'role' => $role
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }

    public function me()
    {
        return response()->json([
            'success' => true,
            'data' => Auth::user()
        ]);
    }
}
