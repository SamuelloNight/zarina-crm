<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex justify-content-center">
    <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
      <a class="navbar-brand brand-logo" href="{{ route('customer.dashboard.main') }}">
        <span class="logo">{{ config('app.name') }}</span>
      </a>
      <a class="navbar-brand brand-logo-mini" href="{{ route('customer.dashboard.main') }}">
        <span class="logo-mini">CRM</span>
      </a>
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-sort-variant"></span>
      </button>
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
{{--    <ul class="navbar-nav mr-lg-4 w-100">--}}
{{--      <li class="nav-item nav-search d-none d-lg-block w-100">--}}
{{--        <div class="input-group">--}}
{{--          <div class="input-group-prepend">--}}
{{--            <span class="input-group-text" id="search">--}}
{{--              <i class="mdi mdi-magnify"></i>--}}
{{--            </span>--}}
{{--          </div>--}}
{{--          <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">--}}
{{--        </div>--}}
{{--      </li>--}}
{{--    </ul>--}}
    <ul class="navbar-nav navbar-nav-right">

      <li class="nav-item dropdown mr-4">
        <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center nav-locale text-primary" id="languageDropdown" href="#" data-toggle="dropdown">
          {{ app()->getLocale() }}
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="languageDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">{{ __('Select language') }}</p>
          <a class="dropdown-item" href="{{ route('sys.changeLanguage', ['locale' => 'kz']) }}">
            <div class="item-content d-flex align-items-center p-0">
              <p class="font-weight-light small-text text-muted mb-0 mr-2">KZ</p>
              <h6 class="ellipsis font-weight-normal mb-0">Қазақша</h6>
            </div>
          </a>
          <a class="dropdown-item" href="{{ route('sys.changeLanguage', ['locale' => 'ru']) }}">
            <div class="item-content d-flex align-items-center p-0">
              <p class="font-weight-light small-text text-muted mb-0 mr-2">RU</p>
              <h6 class="ellipsis font-weight-normal mb-0">Русский</h6>
            </div>
          </a>
          <a class="dropdown-item" href="{{ route('sys.changeLanguage', ['locale' => 'en']) }}">
            <div class="item-content d-flex align-items-center p-0">
              <p class="font-weight-light small-text text-muted mb-0 mr-2">EN</p>
              <h6 class="ellipsis font-weight-normal mb-0">English</h6>
            </div>
          </a>
        </div>
      </li>

      <li class="nav-item dropdown mr-1">
        <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
          <i class="mdi mdi-message-text mx-0"></i>
          {{--<span class="count"></span>--}}
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">{{ __('Messages') }}</p>
          <div class="dropdown-item">
            <p class="text-center text-muted">
              <i>{{ __('No messages') }}</i>
            </p>
          </div>
        </div>
      </li>
      <li class="nav-item dropdown mr-4">
        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-toggle="dropdown">
          <i class="mdi mdi-bell mx-0"></i>
          {{--<span class="count"></span>--}}
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">{{ __('Notifications') }}</p>
          <div class="dropdown-item">
            <p class="text-center text-muted">
              <i>{{ __('No notifications') }}</i>
            </p>
          </div>
        </div>
      </li>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
          <img src="{{ $customer?->avatar ?? 'https://i.pravatar.cc/64' }}" alt="profile"/>
          <span class="nav-profile-name">{{ $customer->full_name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="{{ route('customer.dashboard.settings') }}">
            <i class="mdi mdi-settings text-primary"></i>
            {{ __('Settings') }}
          </a>
          <a class="dropdown-item" href="{{ route('customer.logout') }}">
            <i class="mdi mdi-logout text-primary"></i>
            {{ __('Logout') }}
          </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
