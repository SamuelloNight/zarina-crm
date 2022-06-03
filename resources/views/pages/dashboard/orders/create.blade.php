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
        <p class="text-primary mb-0 hover-cursor">{{ __('Create order') }}</p>
      </div>
    </div>
    <div class="col-md-12 grid-margin">
      <h2>{{ __('Create a new order') }}</h2>
      <p class="mb-md-0">
        {{ __('Leave a request and we will contact you to discuss the details and start work') }}
      </p>
    </div>

    <div class="col-12 col-md-8">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">{{ __('Request') }}</h4>
          <p class="card-description mb-4">{{ __('Please fill out the form to clarify the order') }}</p>
          <form class="forms-sample" method="post" action="{{ route('customer.dashboard.order') }}">
            {{ csrf_field() }}

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">{{ __('Customer name') }}</label>
              <div class="col-sm-10">
                <input
                  class="form-control"
                  type="text"
                  name="name"
                  placeholder="{{ __('Customer name') }}"
                  value="{{ $customer->full_name }}"
                />
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">{{ __('Contact phone number') }}</label>
              <div class="col-sm-10">
                <input
                  class="form-control"
                  type="text"
                  name="phone_number"
                  placeholder="{{ __('Contact phone number') }}"
                  value="{{ $customer->phone_number }}"
                />
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">{{ __('Contact email') }}</label>
              <div class="col-sm-10">
                <input
                  class="form-control"
                  type="email"
                  name="email"
                  placeholder="{{ __('Contact email') }}"
                  value="{{ $customer->email }}"
                />
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">{{ __('Company name') }}</label>
              <div class="col-sm-10">
                <input
                  class="form-control"
                  type="text"
                  name="company_name"
                  placeholder="{{ __('example: ООО "Alfa"') }}"
                />
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">{{ __('Project description') }}</label>
              <div class="col-sm-10">
                <textarea
                  class="form-control"
                  rows="4"
                  name="description"
                  placeholder="{{ __('Describe the project you need') }}"
                  required
                  style="height:150px"
                ></textarea>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label p-0">{{ __('Choose the services you need') }}</label>
              <div class="col-sm-10">
                @foreach($services as $serviceName => $serviceGroup)
                  <div>
                    <label class="text-muted font-weight-bold mb-0">{{ __($serviceName) }}</label>
                    <div class="form-group row">
                      @foreach($serviceGroup as $serviceGroupItem)
                        <div class="col-12 col-md-6">
                          <div class="form-check">
                            <label class="form-check-label mb-0">
                              <input type="checkbox" name="services[]" class="form-check-input" value="{{ $serviceGroupItem }}">
                              {{ __($serviceGroupItem) }}
                              <i class="input-helper"></i></label>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                @endforeach
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
              <button type="submit" class="btn btn-primary mr-2">{{ __('Submit') }}</button>
              <button class="btn btn-danger">{{ __('Cancel') }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    let maskElement = document.querySelector('input[name="phone_number"]')
    let mask = IMask(maskElement, {
      mask: '+{7} (000) 000 00 00'
    })
  </script>
@endsection
