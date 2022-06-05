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
        <p class="text-primary mb-0 hover-cursor">{{ __('Order detail') }}</p>
      </div>
    </div>
    <div class="col-md-12 grid-margin d-flex justify-content-between">
      <div>
        <h2>{{ __('Order detail') }}</h2>
        <p class="mb-md-0">
          {{ __('All information about your application is displayed here') }}
        </p>
      </div>
      <div>
        @if($order->status !== App\Models\Order::STATUS_DELETED_BY_CUSTOMER &&
            $order->status !== App\Models\Order::STATUS_DELETED_BY_MANAGER)
          <a class="btn btn-outline-danger mt-2 mt-xl-0" href="{{ route('customer.dashboard.orders.delete', ['id' => $order->id]) }}">
            {{ __('Delete order') }}
          </a>
        @endif
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

    <div class="col-12 col-md-6 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-2">{{ __('Order') }}</h4>
          <p class="card-description mb-4">{{ __('Basic order information') }}</p>
          <div class="row">
            <div class="col-12">
              <address class="pb-2">
                <p class="font-weight-bold">{{ __('Order status') }}</p>
                <p class="text-uppercase">{{ __($order->status) }}</p>
              </address>
            </div>
            <div class="col-md-6">
              <address>
                <p class="font-weight-bold">{{ __('Customer name') }}</p>
                <p>{{ $order->name }}</p>
              </address>
              <address>
                <p class="font-weight-bold">{{ __('Company name') }}</p>
                <p>{{ $order->company }}</p>
              </address>
            </div>
            <div class="col-md-6">
              <address>
                <p class="font-weight-bold">{{ __('Contact phone number') }}</p>
                <p>{{ $order->phone_number }}</p>
              </address>
              <address>
                <p class="font-weight-bold">{{ __('Contact email address') }}</p>
                <p>{{ $order->email }}</p>
              </address>
            </div>
            <div class="col-12">
              <address>
                <p class="font-weight-bold text-muted">{{ __('Project description') }}</p>
                <p class="text-muted">{{ $order->description }}</p>
              </address>
            </div>
            <div class="col-12">
              <address>
                <p class="font-weight-bold">{{ __('Required services') }}</p>
                <ul class="list-ticked">
                  @foreach(json_decode($order->services) as $service)
                    <li>{{ __($service) }}</li>
                  @endforeach
                </ul>
              </address>
            </div>
            <div class="col-12 mt-3">
              <div class="w-100 d-flex justify-content-between align-items-end">
                <span class="text-muted text-small" title="{{ __('Date of last action on the order') }}">
                {{ $order->updated_at }}
                </span>
                @if($order->status !== App\Models\Order::STATUS_DELETED_BY_CUSTOMER &&
                    $order->status !== App\Models\Order::STATUS_DELETED_BY_MANAGER)
                  <a
                    class="opacity-25 text-danger text-small text-uppercase font-weight-bold"
                    href="{{ route('customer.dashboard.orders.delete', ['id' => $order->id]) }}">
                    {{ __('Delete order') }}
                  </a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-2">{{ __('Manager') }}</h4>
          <p class="card-description mb-4">{{ __('This order manager') }}</p>
          @if(!$order->manager)
            <p class="text-center text-muted mb-4">
              <i>{{ __('The manager has not yet accepted your order') }}</i>
            </p>
          @else
            <h1 class="display-4 mb-3">{{ $order->manager->full_name }}</h1>
            <address>
              <p class="font-weight-bold">{{ __('Contact email address') }}</p>
              <p>{{ $order->manager->email }}</p>
            </address>
            <address>
              <p class="font-weight-bold">{{ __('Contact phone number') }}</p>
              <p>{{ $order->manager->phone_number }}</p>
            </address>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
