<!doctype html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="{{ mix('assets/mix.default.bundle.css') }}">
  </head>
  <body>
    <div class="default-wrapper">
      <div class="default-header">
        <div class="container">
          <div class="header d-flex justify-content-between align-items-center py-4">
            <a class="header-logo" href="{{ route('home') }}">{{ config('app.name') }}</a>
            <div class="header-action">
              <a href="{{ route('customer.login') }}" class="btn btn-outline-primary me-2">Войти</a>
              <a href="{{ route('customer.register') }}" class="btn btn-primary">Зарегистрироваться</a>
            </div>
          </div>
        </div>
      </div>
      <div class="default-content">
        @yield('content')
      </div>
      <div class="default-footer">
        <div class="container">
          <div class="footer d-flex justify-content-between py-4">
            <span class="footer-text">&copy; Все права защищены | {{ date('Y') }}</span>
            <span class="footer-text">Дипломная работа</span>
          </div>
        </div>
      </div>
    </div>
    <script src="https://unpkg.com/imask"></script>
    @yield('script')
  </body>
</html>
