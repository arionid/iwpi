@extends('layouts.authentication.master')
@section('title', 'Sign Up')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid p-0">
  <div class="row m-0">
    <div class="col-xl-7 p-0"><img class="bg-img-cover bg-center" src="{{asset('adm-assets/images/login/1.jpg')}}" alt="looginpage"></div>
    <div class="col-xl-5 p-0">
      <div class="login-card">
        <div>
          <div><a class="logo" href="{{ route('home') }}"><img class="img-fluid for-light" src="{{asset('adm-assets/images/logo/logo.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('adm-assets/images/logo/logo_dark.png')}}" alt="looginpage"></a></div>
          <div class="login-main">
            <form class="theme-form" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                @csrf
              <h4>Create your account</h4>
              <p>Enter your personal details to create account</p>
              <div class="form-group">
                <label class="col-form-label pt-0">Your Name</label>
                <div class="row g-2">
                  <div class="col-6">
                    <input name="fName" class="form-control @error('fName') is-invalid @enderror" type="text" required="" placeholder="First name">
                    @error('fName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="col-6">
                    <input name="lName" class="form-control @error('lName') is-invalid @enderror" type="text" required="" placeholder="Last name">
                    @error('lName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-form-label">Email Address</label>
                <input name="email" class="form-control @error('password') is-invalid @enderror" type="email" required="" placeholder="user@gmail.com">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label class="col-form-label">Password</label>
                <input name="password" class="form-control @error('password') is-invalid @enderror" type="password" required="" placeholder="*********">
                <div class="show-hide"><span class="show"></span></div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label class="col-form-label">Confirm Password</label>
                <input name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" type="password" required="" placeholder="*********">
                <div class="show-hide"><span class="show"></span></div>
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group mb-0">
                <div class="checkbox p-0">
                  <input name="policy" id="checkbox1" type="checkbox" required>
                  <label class="text-muted" for="checkbox1">Agree with<a class="ms-2" href="#">Privacy Policy</a></label>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Create Account</button>
              </div>
              <p class="mt-4 mb-0">Already have an account?<a class="ms-2" href="{{ route('login') }}">Sign in</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
@endsection
