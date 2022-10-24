<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginAdmin(Request $req)
    {
        $data = $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($req->only('email', 'password'))) {
            return response()->json([
                'status' => 404,
                'data' => 'The entered data was not found in our system'
            ]);
        }

        $user = User::where('email', $req->email)->first();
        $user->tokens()->where('name', 'API TOKEN')->delete();
        return response()->json([
            'status' => 200,
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ]);
    }
}
