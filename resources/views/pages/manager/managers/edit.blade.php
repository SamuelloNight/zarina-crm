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
        <p class="text-primary mb-0 hover-cursor">{{ __('Edit') }}</p>
      </div>
    </div>
    <div class="col-md-12 grid-margin">
      <h2>
        <span class="text-primary">{{ $manager->full_name }}</span>
        <span class="text-muted">{{ __('Manager') }}</span>
      </h2>
      <p class="mb-md-0">
        {{ __('Data, history and manager information') }}
      </p>
    </div>

    <div class="col-12 col-md-6 grid-margin">
      <div class="card h-100">
        <div class="card-body">
          <h4 class="card-title mb-2">{{ __('Profile') }}</h4>
          <p class="card-description mb-4">
            {{ __('Manager profile data') }}
          </p>
          <div class="row">
            <div class="col-md-6">
              <address>
                <p class="font-weight-bold">{{ __('First name') }}</p>
                <p>{{ $manager->first_name }}</p>
              </address>
              <address>
                <p class="font-weight-bold">{{ __('Last name') }}</p>
                <p>{{ $manager->last_name }}</p>
              </address>
            </div>
            <div class="col-md-6">
              <address>
                <p class="font-weight-bold">{{ __('Email') }}</p>
                <p>{{ $manager->email }}</p>
              </address>
              <address>
                <p class="font-weight-bold">{{ __('Phone number') }}</p>
                <p>{{ $manager->phone_number }}</p>
              </address>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-3 grid-margin">
      <div class="card h-100">
        <div class="card-body">
          <h4 class="card-title mb-2">{{ __('Order statistics') }}</h4>
          <p class="card-description mb-4">
            {{ __('Basic order statistics') }}
          </p>
          @foreach(App\Models\Order::statuses() as $status)
            <address class="d-flex mb-1">
              <p class="mr-1">{{ __($status) }}:</p>
              <p class="text-info font-weight-bold">{{ $manager->getOrdersCount($status) }}</p>
            </address>
          @endforeach
          <span class="d-block mt-4 text-muted text-small text-uppercase">
            {{ sprintf(__('Total %s orders'), $manager->getOrdersCount()) }}
          </span>
        </div>
      </div>
    </div>

    <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-2">{{ __('Orders history') }}</h4>
        <p class="card-description mb-4">
          {{ __('Here you can see the orders history of manager') }}
        </p>
        <div class="row">
          @if(empty($manager->orders->toArray()))
            <div class="col-12">
              <p class="card-description my-4 text-center">
                <i>{{ __('The history of orders and requests is empty') }}</i>
              </p>
            </div>
          @else
            @foreach($manager->orders as $order)
              <div class="col-12 col-md-3">
                <div class="card h-100">
                  <div class="card-body">
                    <span class="font-weight-bold text-small d-block mb-2">{{ __($order->company) }}</span>
                    <p class="text-muted text-small mb-3">
                      {{ $order->description }}
                    </p>
                    <address class="d-flex mb-0">
                      <p class="text-muted mr-1">{{ __('Status') }}:</p>
                      <p>{{ __($order->status) }}</p>
                    </address>
                    <address class="d-flex mb-3">
                      <p class="text-muted mr-1">{{ __('Manager') }}:</p>
                      @if($order->manager)
                        <p class="text-info">{{ $order->manager->full_name }}</p>
                      @else
                        <p class="text-info">
                          <i>{{ __('Missing') }}</i>
                        </p>
                      @endif
                    </address>
                    <address>
                      <p class="font-weight-bold mb-1">{{ __('Required services') }}:</p>
                      <ol>
                        @foreach(json_decode($order->services) as $service)
                          <li>{{ __($service) }}</li>
                        @endforeach
                      </ol>
                    </address>
                    <span class="d-block mt-4 text-muted text-small text-uppercase">
                      {{ $order->created_at }}
                    </span>
                  </div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>

  </div>
@endsection
