<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index (){

        $contacts = auth()->user()->contacts;

        // dd($contacts);
        return ContactResource::collection($contacts);
    }

    public function add_contact(Request $request){

    }

    public function search_contact(Contact $contact){
        return $contact;
    }

    

}
