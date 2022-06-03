@extends('layouts.customer')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex align-items-center">
        <i class="mdi mdi-home text-muted hover-cursor mr-2"></i>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-muted mb-0 hover-cursor mr-2">{{ __('Customer') }}</p>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-primary mb-0 hover-cursor">{{ __('Settings') }}</p>
      </div>
    </div>
    <div class="col-md-12 grid-margin">
      <h2>{{ __('Settings for Your profile') }}</h2>
      <p class="mb-md-0">
        {{ __('On this page you can change the password and other data for this account. Be careful when filling out the form') }}
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
          <h4 class="card-title">{{ __('Profile') }}</h4>
          <p class="card-description">
            {{ __('Form for editing basic profile data') }}
          </p>
          <form class="forms-sample" method="post" action="{{ route('customer.dashboard.settings.profile') }}">
            {{ csrf_field() }}
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">{{ __('Your first name') }}</label>
              <div class="col-sm-10">
                <input
                  class="form-control"
                  type="text"
                  name="first_name"
                  placeholder="{{ __('Your first name') }}"
                  value="{{ $customer->first_name }}"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">{{ __('Your last name') }}</label>
              <div class="col-sm-10">
                <input
                  class="form-control"
                  type="text"
                  name="last_name"
                  placeholder="{{ __('Your last name') }}"
                  value="{{ $customer->last_name }}"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">{{ __('Your email') }}</label>
              <div class="col-sm-10">
                <input
                  class="form-control"
                  type="email"
                  name="email"
                  placeholder="{{ __('Your email') }}"
                  value="{{ $customer->email }}"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">{{ __('Your phone number') }}</label>
              <div class="col-sm-10">
                <input
                  class="form-control"
                  type="text"
                  name="phone_number"
                  placeholder="{{ __('Your phone number') }}"
                  value="{{ $customer->phone_number }}"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label py-0">{{ __('Your business type') }}</label>
              <div class="col-sm-10">
                <select class="form-control" name="business_area">
                  @foreach($businessAreaTypes as $businessAreaType)
                    <option {{ $businessAreaType === $customer->business_area ? 'selected' : '' }}>
                      {{ $businessAreaType }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            @if($errors->any() && (
              array_key_exists('first_name', $errors->toArray()) ||
              array_key_exists('last_name', $errors->toArray()) ||
              array_key_exists('email', $errors->toArray()) ||
              array_key_exists('phone_number', $errors->toArray()) ||
              array_key_exists('business_area', $errors->toArray())
            ))
              <div class="alert alert-danger mb-5" role="alert">
                {{ $errors->first() }}
              </div>
            @endif

            <button type="submit" class="btn btn-primary mr-2">{{ __('Submit') }}</button>
            <button class="btn btn-danger">{{ __('Cancel') }}</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 grid-margin">
      <div class="card {{ in_array('pwd', $selected) ? 'selected' : '' }}">
        <div class="card-body">
          <h4 class="card-title">{{ __('Password') }}</h4>
          <p class="card-description">
            {{ __('Form for edit account password') }}
          </p>
          <form class="forms-sample" method="post" action="{{ route('customer.dashboard.settings.password') }}">
            {{ csrf_field() }}
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">{{ __('Current password') }}</label>
              <div class="col-sm-9">
                <input
                  class="form-control"
                  type="password"
                  name="current_password"
                  placeholder="{{ __('Current password') }}"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">{{ __('New password') }}</label>
              <div class="col-sm-9">
                <input
                  class="form-control"
                  type="password"
                  name="new_password"
                  placeholder="{{ __('New password') }}"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">{{ __('Confirm new password') }}</label>
              <div class="col-sm-9">
                <input
                  class="form-control"
                  type="password"
                  name="new_password_confirm"
                  placeholder="{{ __('Confirm new password') }}"
                />
              </div>
            </div>

            @if($errors->any() && (
              array_key_exists('current_password', $errors->toArray()) ||
              array_key_exists('new_password', $errors->toArray()) ||
              array_key_exists('new_password_confirm', $errors->toArray())
            ))
              <div class="alert alert-danger mb-5" role="alert">
                {{ $errors->first() }}
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
