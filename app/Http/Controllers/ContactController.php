<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index (){

        $contacts = auth()->user()->contacts;

        // dd($contacts);
        return ContactResource::collection($contacts);
    }
}
