<?php

namespace App\Http\Controllers\Api\SecurityReport\Vurnerable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

//kode yang salah
class AuthController extends Controller
{
    // BUG REGISTER BYPASS
    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // BUG: menyimpan password tanpa hashing
            'password' => $request->password,
            'role' => 'user'
        ]);
        return response()->json([
            'message' => 'Register berhasil'
        ]);
    }

    // BUG LOGIN BYPASS
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        // BUG
        if ($user) {
            //sistem login tanpa verifikasi password
            Auth::login($user);
            return response()->json([
                'message' => 'Login berhasil'
            ]);
        }
        return response()->json([
            'message' => 'User tidak ditemukan'
        ]);
    }
}
