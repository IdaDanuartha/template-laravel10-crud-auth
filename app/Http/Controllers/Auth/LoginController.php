<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
      $this->authService = $authService;      
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function handleLogin(LoginRequest $request)
    {
        try {
            $login = $this->authService->login($request->only("email", "password"));
            if($login) return redirect()->route("dashboard.index")->with('success', 'Login success! Welcome back ' . auth()->user()->username);
            
            throw new Exception();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Login failed! Check your credentials and try again');
        }
    }
}
