@extends('layouts.auth')

@section('content')
  <div class="row w-100 mx-0">
    <div class="col-lg-4 mx-auto">
      <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo mb-5">
          <h1 class="text-primary text-center font-weight-bold">
            {{ config('app.name') }}
            <span class="text-muted">| Manager</span>
          </h1>
        </div>
        <h4>{{ __('Hello! let`s get started') }}</h4>
        <h6 class="font-weight-light">{{ __('Sign in to continue') }}</h6>
        <form class="pt-3" method="post" action="{{ route('manager.login') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <input type="email" class="form-control form-control-lg" name="email" placeholder="{{ __('Email') }}">
          </div>
          <div class="form-group">
            <input type="password" class="form-control form-control-lg" name="password" placeholder="{{ __('Password') }}">
          </div>
          <div class="mt-3">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn text-uppercase" type="submit">
              {{ __('Login') }}
            </button>
          </div>
          <span class="d-block mt-4 text-center text-muted">{{ __('Have a nice work!') }}</span>
        </form>
      </div>
    </div>
  </div>
@endsection
