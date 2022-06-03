@extends('layouts.customer')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex align-items-center">
        <i class="mdi mdi-home text-muted hover-cursor mr-2"></i>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-muted mb-0 hover-cursor mr-2">{{ __('Customer') }}</p>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-muted mb-0 hover-cursor mr-2">{{ __('Orders') }}</p>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-primary mb-0 hover-cursor">{{ __('Orders list') }}</p>
      </div>
    </div>
    <div class="col-md-12 grid-margin d-flex justify-content-between">
      <div>
        <h2>{{ __('Orders list') }}</h2>
        <p class="mb-md-0">
          {{ __('List of applications that you left') }}
        </p>
      </div>
      <div>
        <a class="btn btn-primary mt-2 mt-xl-0" href="{{ route('customer.dashboard.order') }}">
          {{ __('Create an order') }}
        </a>
      </div>
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

    <div class="col-12 grid-margin">
      <div class="row">
        @foreach($customer->orders as $order)
          <div class="col-12 col-md-3 mb-3">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title mb-3">{{ $order->name }}</h4>
                <p class="card-description mb-3" title="{{ $order->description }}">
                  {{ Illuminate\Support\Str::limit($order->description, 32) }}
                </p>
                <div class="row mb-3">
                  <div class="col-12 col-md-6">
                    <address class="mb-0">
                      <p class="font-weight-bold">{{ __('Date') }}</p>
                      <p>{{ $order->created_at }}</p>
                    </address>
                  </div>
                  <div class="col-12 col-md-6">
                    <address class="mb-0">
                      <p class="font-weight-bold">{{ __('Status') }}</p>
                      <p>{{ __($order->status) }}</p>
                    </address>
                  </div>
                </div>
                <a href="{{ route('customer.dashboard.orders.more', ['id' => $order->id]) }}">{{ __('Details') }}</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
