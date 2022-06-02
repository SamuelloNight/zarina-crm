@extends('layouts.default')

@section('content')
  <div class="content d-flex justify-content-center align-items-center">
    <div class="container d-flex justify-content-center">
      <form class="auth-form" method="post" action="{{ route('customer.login.form') }}" style="max-width:425px;">
        <h3 class="auth-title mb-5">Вход</h3>
        {{ csrf_field() }}

        <div class="form-group mb-3">
          <label class="mb-1">Номер телефона</label>
          <input class="form-control" type="text" name="phone_number" required placeholder="Введите номер телефона">
        </div>
        <div class="form-group mb-5">
          <label class="mb-1">Пароль от аккаунта</label>
          <input class="form-control" type="password" name="password" required placeholder="Введите пароль от аккаунта">
        </div>

        @if($errors->any())
          <div class="alert alert-danger mb-5" role="alert">
            {{ $errors->first() }}
          </div>
        @endif

        <button class="btn btn-primary w-100">Войти</button>
      </form>
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
