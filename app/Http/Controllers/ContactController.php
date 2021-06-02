<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Http\Resources\SearchContactResource;
use App\Models\Contact;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;
use Throwable;

class ContactController extends Controller
{
    public function index()
    {

        return auth()->user();

        // return optional(auth(), function($contacts){
        //     return $contacts;
        // });
        
        // $contacts = auth()->user()->contacts;

        // dd($contacts);
        // return ContactResource::collection($contacts);
    }
    
    public function currentUser(){
        $user = "";
        $error = "";

        try{
            $user = auth()->user();
        } catch(Throwable $e){
           dd($e);
        }
        

        return response()->json([
            "log" => $error,
            'uid' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'isActive' => true,
            'isAuth' => true,
        ]);
    }

    public function add_contact(Request $request)
    {
    }

    public function search_contact($id)
    {
        return optional(User::find($id), function ($user) {
            return new SearchContactResource($user);
        });
    }
}
