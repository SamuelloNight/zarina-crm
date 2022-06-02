@extends('layouts.default')

@section('content')
  <div class="content d-flex justify-content-center align-items-center">
    <div class="container d-flex justify-content-center">
      <form class="auth-form" method="post" action="{{ route('customer.register.form') }}">
        <h3 class="auth-title mb-5">Регистрация</h3>
        {{ csrf_field() }}

        <div class="row">
          <div class="form-group col-md-6 mb-3">
            <label class="mb-1">Ваше имя</label>
            <input class="form-control" type="text" name="first_name" required placeholder="Введите имя">
          </div>
          <div class="form-group col-md-6 mb-3">
            <label class="mb-1">Ваша фамилия</label>
            <input class="form-control" type="text" name="last_name" required placeholder="Введите фамилию">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6 mb-3">
            <label class="mb-1">Электронная почта</label>
            <input class="form-control" type="email" name="email" required placeholder="Введите почту">
          </div>
          <div class="form-group col-md-6 mb-3">
            <label class="mb-1">Номер телефона</label>
            <input class="form-control" type="text" name="phone_number" required placeholder="Введите номер телефона">
          </div>
        </div>

        <div class="form-group mb-3">
          <label class="mb-1">Пароль для аккаунта</label>
          <input class="form-control" type="password" name="password" required placeholder="Придумайте пароль для аккаунта">
        </div>

        <div class="form-group mb-5">
          <label class="mb-1">Выберите сферу Вашего бизнеса</label>
          <select class="form-control" name="business_area">
            <option>Фитнес и здоровье</option>
            <option>Строительство и ремонт</option>
            <option>Юридические услуги</option>
            <option>Дизайн и рисование</option>
            <option>Транспортные компании</option>
            <option>Ресторан и кафе</option>
            <option>Ночные клубы и бары</option>
            <option>Маркетинговые услуги</option>
            <option>Веб-студия</option>
            <option>Реализация или продажа товара</option>
            <option>Другое...</option>
          </select>
        </div>

        @if($errors->any())
          <div class="alert alert-danger mb-5" role="alert">
            {{ $errors->first() }}
          </div>
        @endif

        <button class="btn btn-primary w-100">Зарегистрироваться</button>
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
