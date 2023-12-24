@extends('layouts.auth')
@section('title') Signup Page @endsection

@section('main')
<form id="formAuthentication" class="mb-3" action="{{ route('signup.post') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input
      type="text"
      class="form-control"
      id="username"
      name="username"
      placeholder="Enter your username"
      value="{{ old('username') }}"
      required
      autofocus />
      @error('username')
        <div class="text-danger mt-1">{{ $message }}</div>
      @enderror
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input
      type="email"
      class="form-control"
      id="email"
      name="email"
      placeholder="Enter your email"
      value="{{ old('email') }}"
      required
      autofocus />
      @error('email')
        <div class="text-danger mt-1">{{ $message }}</div>
      @enderror
  </div>
  <div class="mb-3 form-password-toggle">
    <div class="d-flex justify-content-between">
      <label class="form-label" for="password">Password</label>
    </div>
    <div class="input-group input-group-merge">
      <input
        type="password"
        id="password"
        class="form-control"
        name="password"
        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
        required
        aria-describedby="password" />
      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
    </div>
    @error('password')
      <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3 form-password-toggle">
    <div class="d-flex justify-content-between">
      <label class="form-label" for="confirm_password">Confirm Password</label>
    </div>
    <div class="input-group input-group-merge">
      <input
        type="password"
        id="confirm_password"
        class="form-control"
        name="confirm_password"
        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
        required
        aria-describedby="confirm_password" />
      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
    </div>
  </div>
  <div class="mb-3">
    <button class="btn btn-primary d-grid w-100" type="submit">Create Account</button>
  </div>
</form>
<p class="text-center">
  <span>Already have an account?</span>
  <a href="{{ route('login.get') }}">
    <span>Sign in instead</span>
  </a>
</p>
@endsection