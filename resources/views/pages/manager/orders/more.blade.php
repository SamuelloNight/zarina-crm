@extends('layouts.manager')

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
        @if(!$order->manager)
          @if($order->status !== App\Models\Order::STATUS_DELETED_BY_CUSTOMER &&
          $order->status !== App\Models\Order::STATUS_DELETED_BY_MANAGER)
            <a class="btn btn-outline-primary mt-2 mt-xl-0" href="{{ route('manager.orders.accept', ['id' => $order->id]) }}">
              {{ __('Accept order') }}
            </a>
          @endif
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
                @if ($order->manager && $order->manager->id === $manager->id)
                  <p>{{ $order->phone_number }}</p>
                @else
                  <p>{{ substr_replace($order->phone_number, '** **', -5) }}</p>
                @endif
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
            @if ($order->manager && $order->manager->id === $manager->id)
              <div class="col-12">
                <form class="mb-3" action="{{ route('manager.orders.status', ['id' => $order->id]) }}">
                  <div class="form-group my-3">
                    <label>{{ __('Change order status') }}</label>
                    <select class="form-control form-control-sm" name="status">
                      @foreach(App\Models\Order::statuses() as $status)
                        <option>{{ __($status) }}</option>
                      @endforeach
                    </select>
                  </div>
                  @if ($order->status !== App\Models\Order::STATUS_DELETED_BY_MANAGER && $order->status !== App\Models\Order::STATUS_DELETED_BY_CUSTOMER)
                    <button type="submit" class="btn btn-primary btn-sm">
                      {{ __('Submit') }}
                    </button>
                  @else
                    <button type="submit" class="btn btn-primary btn-sm" disabled>
                      {{ __('Submit') }}
                    </button>
                    <span class="">{{ __('Can`t change status because it`s deleted') }}</span>
                  @endif
                </form>
              </div>
            @endif
            <div class="col-12 mt-3">
              <div class="w-100 d-flex justify-content-between align-items-end">
                <span class="text-muted text-small" title="{{ __('Date of last action on the order') }}">
                {{ $order->updated_at }}
                </span>
                @if(!$order->manager)
                  @if($order->status !== App\Models\Order::STATUS_DELETED_BY_CUSTOMER &&
                      $order->status !== App\Models\Order::STATUS_DELETED_BY_MANAGER)
                    <a
                      class="opacity-25 text-primary text-small text-uppercase font-weight-bold"
                      href="{{ route('manager.orders.accept', ['id' => $order->id]) }}">
                      {{ __('Accept order') }}
                    </a>
                  @endif
                @elseif ($order->manager->id === $manager->id)
                  <a
                    class="text-success text-small text-uppercase font-weight-bold"
                    href="https://api.whatsapp.com/send?phone={{ $order->cleared_phone_number }}"
                    target="_blank">
                    {{ __('Go to whatsapp') }}
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
          @if($order->manager)
            <h1 class="display-4 mb-3">{{ $order->manager->full_name }}</h1>
            <address>
              <p class="font-weight-bold">{{ __('Contact email address') }}</p>
              <p>{{ $order->manager->email }}</p>
            </address>
            <address>
              <p class="font-weight-bold">{{ __('Contact phone number') }}</p>
              <p>{{ $order->manager->phone_number }}</p>
            </address>
          @else
            <p class="text-center text-muted mb-4">
              <i>{{ __('The manager has not yet accepted order') }}</i>
            </p>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
