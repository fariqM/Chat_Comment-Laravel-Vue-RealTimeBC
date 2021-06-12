<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthAPI extends Controller
{
    public function register(Request $req)
    {
        $field = $req->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);
        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => \bcrypt($field['password']),
        ]);
        $token = $user->createToken("$user->name _token")->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];
        return \response($response, 201); //message 201 => this success but something was created
    }
    public function login(Request $req)
    {
        $field = $req->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        //Check user
        $user = User::where('email', $field['email'])->first();
        if (!$user || !Hash::check($field['password'], $user->password)) {
            return \response([
                'message' => 'Bad creds',
            ], 401); //401 for unauthorization
        }
        $token = $user->createToken("$user->name _token")->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];
        return \response($response, 201); //message 201 => this success but something was created
    }
    public function logout(Request $req)
    {
        \auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged Out',
        ];
    }
}
