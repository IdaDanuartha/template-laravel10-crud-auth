<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthService
{
  public function login($credentials)
  {
    try {
      if(Auth::attempt($credentials)) return true;
    } catch (\Exception $e) {
      Log::info($e->getMessage());
      throw $e;
    }            
  } 
  
  public function createUser($data): User
  {
    DB::beginTransaction();     
    try {
      $user = User::create($data);
      DB::commit();

      return $user;
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      
      throw $e;
    } 
  }

  public function logout($request): bool
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return true;
  }
}