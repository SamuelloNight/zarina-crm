<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/base/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/dashboard/images/favicon.png') }}">
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          @yield('content')
        </div>
      </div>
    </div>

    <script src="{{ asset('assets/dashboard/vendors/base/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/template.js') }}"></script>
    @yield('script')
  </body>
</html>
