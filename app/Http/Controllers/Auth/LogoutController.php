<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
      $this->authService = $authService;      
    }

    public function __invoke(Request $request)
    {
        $logout = $this->authService->logout($request);
        
        if($logout) {
            return redirect()->route('login.get')->withSuccess('You have logged out successfully!');
        }
    }
}
