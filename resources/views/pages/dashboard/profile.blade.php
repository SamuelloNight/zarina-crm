@extends('layouts.customer')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex align-items-center">
        <i class="mdi mdi-home text-muted hover-cursor mr-2"></i>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-muted mb-0 hover-cursor mr-2">{{ __('Customer') }}</p>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-primary mb-0 hover-cursor">{{ __('Profile') }}</p>
      </div>
    </div>
    <div class="col-md-12 grid-margin">
      <h2>{{ __('Your profile') }}</h2>
      <p class="mb-md-0">
        {{ __('Here you can see your profile data that we know about') }}
      </p>
    </div>
    <div class="col-12 col-md-6 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-2">{{ __('Profile') }}</h4>
          <p class="card-description mb-4">
            {{ __('Form for editing basic profile data') }}
          </p>
          <div class="row">
            <div class="col-md-6">
              <address>
                <p class="font-weight-bold">{{ __('First name') }}</p>
                <p>{{ $customer->first_name }}</p>
              </address>
              <address>
                <p class="font-weight-bold">{{ __('Last name') }}</p>
                <p>{{ $customer->last_name }}</p>
              </address>
              <address>
                <p class="font-weight-bold">{{ __('Business category') }}</p>
                <p>{{ $customer->business_area }}</p>
              </address>
            </div>
            <div class="col-md-6">
              <address>
                <p class="font-weight-bold">{{ __('Email') }}</p>
                <p>{{ $customer->email }}</p>
              </address>
              <address>
                <p class="font-weight-bold">{{ __('Phone number') }}</p>
                <p>{{ $customer->phone_number }}</p>
              </address>
            </div>
            <div class="col-12">
              <a href="{{ route('customer.dashboard.settings') }}">{{ __('Go to settings') }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">{{ __('Your review') }}</h4>
          @if ($customer->review)
            <p class="mb-3">
              {{ $customer->review->message }}
            </p>
            <address class="d-flex mb-0 text-warning">
              @for($gradeMax = 1; $gradeMax <= 5; $gradeMax++)
                @if($gradeMax <= $customer->review->grade)
                  <i class="mdi mdi-star"></i>
                @else
                  <i class="mdi mdi-star-outline"></i>
                @endif
              @endfor
            </address>
          @else
            <p class="card-description my-4 text-center">
              <i>{{ __('You don`t have a review') }}</i>
            </p>
            <p class="card-description">
              {{ __('Please leave about our work. This will help us improve our service.') }}<br>
              <a href="{{ route('customer.dashboard.review') }}">{{ __('Write a feedback') }}</a>
            </p>
          @endif
        </div>
      </div>
    </div>

    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-2">{{ __('Orders history') }}</h4>
          <p class="card-description mb-4">
            {{ __('Here you can see the history of your orders and contacts with us') }}
          </p>
          <div class="row">
            <div class="col-12">
              <p class="card-description my-4 text-center">
                <i>{{ __('The history of orders and requests is empty') }}</i>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
