@extends('layouts.manager')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex align-items-center">
        <i class="mdi mdi-home text-muted hover-cursor mr-2"></i>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-muted mb-0 hover-cursor mr-2">{{ __('Manager') }}</p>
        <p class="text-muted mb-0 hover-cursor mr-2"> / </p>
        <p class="text-primary mb-0 hover-cursor">{{ __('Reviews') }}</p>
      </div>
    </div>
    <div class="col-md-12 grid-margin">
      <h2>{{ __('Reviews list') }}</h2>
      <p class="mb-md-0">
        {{ __('List of all customer reviews') }}
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
                  <p class="card-description mb-1">
                    {{ $review->message }}
                  </p>
                  <address class="d-flex mb-3 text-warning">
                    @for($gradeMax = 1; $gradeMax <= 5; $gradeMax++)
                      @if($gradeMax <= $review->grade)
                        <i class="mdi mdi-star"></i>
                      @else
                        <i class="mdi mdi-star-outline"></i>
                      @endif
                    @endfor
                  </address>
                  <div class="d-flex justify-content-between">
                    <a class="text-primary text-uppercase text-small font-weight-bold" href="{{ route('manager.reviews.publish', ['id' => $review->id]) }}">
                      {{ __($review->published ? 'Remove from publication' : 'Publish') }}
                    </a>
                    <a class="text-danger text-uppercase text-small font-weight-bold" href="{{ route('manager.reviews.delete', ['id' => $review->id]) }}">
                      {{ __('Delete') }}
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
@endsection
