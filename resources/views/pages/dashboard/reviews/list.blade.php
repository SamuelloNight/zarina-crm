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
        <p class="text-primary mb-0 hover-cursor">{{ __('Reviews list') }}</p>
      </div>
    </div>
    <div class="col-md-12 grid-margin d-flex justify-content-between">
      <div>
        <h2>{{ __('Reviews list') }}</h2>
        <p class="mb-md-0">
          {{ __('Reviews of our valued clients about our work') }}
        </p>
      </div>
      <div>
        <a class="btn btn-primary mt-2 mt-xl-0" href="{{ route('customer.dashboard.review') }}">
          {{ __($customer->review ? 'My review' : 'Add review') }}
        </a>
      </div>
    </div>
    <div class="col-12 grid-margin">
      <div class="row">
        @if(empty($reviews->toArray()))
          <div class="col-12">
            <p class="text-muted">
              <i>{{ __('No reviews') }}</i>
            </p>
          </div>
        @else
          @foreach($reviews as $review)
            <div class="col-12 col-md-3 mb-3">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title mb-3">{{ $review->customer->full_name }}</h4>
                  <p class="card-description mb-3">
                    {{ $review->message }}
                  </p>
                  <address class="d-flex mb-0 text-warning">
                    @for($gradeMax = 1; $gradeMax <= 5; $gradeMax++)
                      @if($gradeMax <= $review->grade)
                        <i class="mdi mdi-star"></i>
                      @else
                        <i class="mdi mdi-star-outline"></i>
                      @endif
                    @endfor
                  </address>
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
@endsection
