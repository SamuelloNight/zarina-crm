@extends('layouts.default')

@section('content')
  <div class="home-wrapper">
    <div class="container">
      <div class="home-content row align-items-stretch">
        <div class="col-12 col-md-6 d-flex flex-column justify-content-center">
          <h1 class="home-title">Запустите проект вместе с нами</h1>
          <p class="home-description">
            Мы поможем запустить сайт для старта Вашего
            бизнеса онлайн и предлагаем Вам
            комплексное обслуживание в сфере
            Digital Development
          </p>
          <a class="home-start btn btn-primary" href="{{ route('customer.register') }}">Начать прямо сейчас</a>
        </div>
        <div class="col-12 col-md-6 d-flex align-items-center">
          <img class="w-100" src="/assets/images/home-managers.png" alt="managers">
        </div>
      </div>
    </div>
  </div>
@endsection
