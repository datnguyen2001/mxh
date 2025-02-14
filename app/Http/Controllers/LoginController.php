<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    public function login_callback(){
        return view('login.login-callback');
    }

    public function callback_signout(){
        return view('login.callback-signout');
    }
    public function sample_silent(){
        return view('login.sample-silent');
    }


}
