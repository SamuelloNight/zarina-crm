<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/base/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/dashboard/images/favicon.png') }}" />
  </head>
  <body>

    <div class="container-scroller">
      <x-customer-navbar></x-customer-navbar>
      <div class="container-fluid page-body-wrapper">
        <x-customer-sidebar></x-customer-sidebar>
        <div class="main-panel">
          <div class="content-wrapper">
            @yield('content')
          </div>
          <x-customer-footer></x-customer-footer>
        </div>
      </div>
    </div>

    <script src="https://unpkg.com/imask"></script>
    <script src="{{ asset('assets/dashboard/vendors/base/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/template.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/dataTables.bootstrap4.js') }}"></script>
    @yield('script')
  </body>
</html>

