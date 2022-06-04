@extends('layouts.manager')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex align-items-center">
        <i class="mdi mdi-home text-muted hover-cursor mr-2"></i>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-muted mb-0 hover-cursor mr-2">{{ __('Orders') }}</p>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-primary mb-0 hover-cursor">{{ __('Fresh') }}</p>
      </div>
    </div>
    <div class="col-md-12 grid-margin d-flex justify-content-between">
      <div>
        <h2>{{ __('Fresh orders list') }}</h2>
        <p class="mb-md-0">
          {{ __('List of new orders from customers. You can pick them up while they`re free') }}
        </p>
      </div>
      <div>
        <a class="btn btn-primary mt-2 mt-xl-0" href="{{ route('manager.orders.processing') }}">
          {{ __('Orders in my processing') }}
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

    @if (!empty($orders->toArray()))
      <div class="col-12 grid-margin">
        <div class="row">
          @foreach($orders as $order)
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
                  <a
                    class="text-uppercase text-small text-primary font-weight-bold"
                    href="{{ route('manager.orders.more', ['id' => $order->id]) }}">
                    {{ __('Details') }}
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @else
      <div class="col-12">
        <p class="text-muted">
          <i class="d-block pb-4">{{ __('No new orders') }}</i>
        </p>
        <a class="btn btn-sm btn-outline-primary" href="{{ route('manager.orders.processing') }}">
          {{ __('Orders in my processing') }}
        </a>
      </div>
    @endif
  </div>
@endsection
