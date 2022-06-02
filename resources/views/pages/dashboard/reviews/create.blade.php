@extends('layouts.customer')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex align-items-center">
        <i class="mdi mdi-home text-muted hover-cursor mr-2"></i>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-muted mb-0 hover-cursor mr-2">{{ __('Customer') }}</p>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-muted mb-0 hover-cursor mr-2">{{ __('Reviews') }}</p>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-primary mb-0 hover-cursor">{{ __('Write review') }}</p>
      </div>
    </div>
    <div class="col-md-12 grid-margin">
      <h2>{{ __('Write new review') }}</h2>
      <p class="mb-md-0">
        {{ __('Please write a review about our work. This will help us improve our service. And also it will be seen by our users') }}
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

    <div class="col-12 col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">{{ __('Review') }}</h4>
          <form class="forms-sample row" method="post" action="{{ route('customer.dashboard.review') }}">
            {{ csrf_field() }}
            <div class="form-group col-12">
              <label>Message</label>
              <textarea
                class="form-control"
                rows="4"
                name="message"
                placeholder="{{ __('Write Your review') }}"
                required
                style="height:200px"
              >{{ $customer->review?->message }}</textarea>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label>{{ __('How many points give us he 1 to 5?') }}</label>
                <select class="form-control form-control-sm" name="grade" required>
                  @for($grade = 1; $grade <= ($customer->review->grade ?? 5); $grade++)
                    <option {{ $grade === $customer->review?->grade ? 'selected' : '' }}>{{ $grade }}</option>
                  @endfor
                </select>
              </div>
            </div>

            @if($errors->any())
              <div class="col-12">
                <div class="alert alert-danger mb-5" role="alert">
                  {{ $errors->first() }}
                </div>
              </div>
            @endif

            <div class="col-12">
              <button type="submit" class="btn btn-primary mr-2" {{ $customer->review ? 'disabled' : '' }}>{{ __('Submit') }}</button>
              <button class="btn btn-danger" {{ $customer->review ? 'disabled' : '' }}>{{ __('Cancel') }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
