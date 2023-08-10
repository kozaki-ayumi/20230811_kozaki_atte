<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stamp;
use App\Models\Rest;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    public function index ()
    {
        $auth=auth()->user()->id;
        $user=User::find($auth);

        $stamp = Stamp::where('user_id',$auth)->latest()->first();
        $rest = Rest::where('user_id',$auth)->latest()->first();

        return view('stamp',compact('user','stamp','rest'));
    }
}
