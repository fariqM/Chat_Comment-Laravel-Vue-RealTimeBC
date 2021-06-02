<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManualAuthController extends Controller
{
    public function getEmail($email){

        return optional(User::where('email', $email)->first(), function ($user) {
            return $user->email;
        });

        // $emailExist = User::where('email', $email)->firstOrFail();

        // return $emailExist;

    }
}
