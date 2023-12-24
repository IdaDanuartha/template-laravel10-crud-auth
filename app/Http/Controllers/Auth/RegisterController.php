<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
      $this->authService = $authService;      
    }

    public function signupView()
    {
        return view('auth.signup');
    }
    
    public function handleSignup(RegisterRequest $request)
    {
        try {
            $signup = $this->authService->createUser($request->except("confirm_password"));
            if($signup) return redirect()->route("login.get")->with('success', 'Account created successfully. Please login!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create account');
        }
    }
}
