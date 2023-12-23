<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function signupView()
    {
        return view('auth.signup');
    }
    
    public function handleSignup()
    {
        return true;
    }
}
