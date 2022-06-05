@extends('layouts.manager')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex align-items-center">
        <i class="mdi mdi-home text-muted hover-cursor mr-2"></i>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-muted mb-0 hover-cursor mr-2">{{ __('Manager') }}</p>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-muted mb-0 hover-cursor mr-2">{{ __('Managers') }}</p>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-primary mb-0 hover-cursor">{{ __('Create') }}</p>
      </div>
    </div>
    <div class="col-md-12 grid-margin">
      <h2>{{ __('Create new manager') }}</h2>
      <p class="mb-md-0">
        {{ __('Form for register new manager in system') }}
      </p>
    </div>

    @if(session('successMessage'))
      <div class="col-12 grid-margin">
        <div class="card bg-gradient-primary border-0">
          <div class="card-body py-3 px-4 d-flex align-items-center justify-content-between flex-wrap">
            <p class="mb-0 text-white font-weight-medium">{{ session('successMessage') }}</p>
          </div>
        </div>
      </div>
    @endif

    <div class="col-12 col-md-6 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">{{ __('Manager') }}</h4>
          <p class="card-description">
            {{ __('Form for register new manager') }}
          </p>
          <form class="forms-sample" method="post" action="{{ route('manager.root.managers.create') }}">
            {{ csrf_field() }}
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">{{ __('First name') }}</label>
              <div class="col-sm-10">
                <input
                  class="form-control"
                  type="text"
                  name="first_name"
                  placeholder="{{ __('First name') }}"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">{{ __('Last name') }}</label>
              <div class="col-sm-10">
                <input
                  class="form-control"
                  type="text"
                  name="last_name"
                  placeholder="{{ __('Last name') }}"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
              <div class="col-sm-10">
                <input
                  class="form-control"
                  type="email"
                  name="email"
                  placeholder="{{ __('Email') }}"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">{{ __('Phone number') }}</label>
              <div class="col-sm-10">
                <input
                  class="form-control"
                  type="text"
                  name="phone_number"
                  placeholder="{{ __('Phone number') }}"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">{{ __('Password') }}</label>
              <div class="col-sm-10">
                <input
                  class="form-control"
                  type="text"
                  name="password"
                  placeholder="{{ __('Password') }}"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">{{ __('Password confirm') }}</label>
              <div class="col-sm-10">
                <input
                  class="form-control"
                  type="text"
                  name="password_confirm"
                  placeholder="{{ __('Password confirm') }}"
                />
              </div>
            </div>

            @if($errors->any())
              <div class="alert alert-danger mb-5" role="alert">
                {{ $errors->first() }}
              </div>
            @endif

            @if(session('newManager'))
              <div class="card mb-3">
                <div class="card-body">
                  <span class="d-block">Login: {{ session('newManager')['email'] }}</span>
                  <span class="d-block">Password: {{ session('newManager')['password'] }}</span>
                </div>
              </div>
            @endif

            <button type="submit" class="btn btn-primary mr-2">{{ __('Submit') }}</button>
            <button class="btn btn-danger">{{ __('Cancel') }}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    let maskElement = document.querySelector('input[name="phone_number"]')
    let mask = IMask(maskElement, {
      mask: '+{7} (000) 000 00 00'
    })
  </script>
@endsection
