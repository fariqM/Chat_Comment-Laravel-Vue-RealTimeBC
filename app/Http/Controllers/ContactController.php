<?php

namespace App\Http\Controllers;


use App\Http\Resources\SearchContactResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ContactController extends Controller
{
    public function index()
    {
        //idk
    }

    public function currentUser()
    {
        return auth()->user();
    }

    public function add_contact(Request $request)
    {
    }

    public function search_contact($id)
    {
        if (is_numeric($id) == 1) {
            return optional(User::find($id), function ($user) {
                return new SearchContactResource($user);
            });
        } else {
            return null;
        }
    }
}
