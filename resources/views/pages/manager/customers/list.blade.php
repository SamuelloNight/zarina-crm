@extends('layouts.manager')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex align-items-center">
        <i class="mdi mdi-home text-muted hover-cursor mr-2"></i>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-muted mb-0 hover-cursor mr-2">{{ __('Manager') }}</p>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-primary mb-0 hover-cursor">{{ __('Customers') }}</p>
      </div>
    </div>
    <div class="col-md-12 grid-margin">
      <h2>{{ __('Customers list') }}</h2>
      <p class="mb-md-0">
        {{ __('Here you can see a list of all customers') }}
      </p>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">{{ __('Customers table') }}</h4>
          <div class="table-responsive pt-3">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-center">ID</th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Email') }}</th>
                  <th>{{ __('Phone number') }}</th>
                  <th>{{ __('Business category') }}</th>
                  <th>{{ __('Orders count') }}</th>
                  <th>{{ __('Register date') }}</th>
                  <th class="text-center">{{ __('Tools') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($customers as $customer)
                  <tr>
                    <td class="text-center">{{ $customer->id }}</td>
                    <td>{{ $customer->full_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ substr_replace($customer->phone_number, '** **', -5) }}</td>
                    <td>{{ $customer->business_area }}</td>
                    <td>{{ $customer->getOrdersCount() }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td class="text-center">
                      <a class="btn btn-outline-primary btn-sm border-0" href="{{ route('manager.customers.edit', ['id' => $customer->id]) }}">
                        <i class="mdi mdi-dots-horizontal"></i>
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <span class="d-block mt-4 text-muted text-small text-uppercase">
            {{ sprintf(__('There are %s customers in the system'), $customers->count()) }}
          </span>
        </div>
      </div>
    </div>
  </div>
@endsection
