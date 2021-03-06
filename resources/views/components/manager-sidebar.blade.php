<nav class="sidebar sidebar-offcanvas pt-5" id="sidebar">
  <span class="text-primary text-uppercase small font-weight-bold d-block pl-3">{{ __('Menu') }}</span>
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('manager.orders.fresh') }}">
        <i class="mdi mdi-new-box menu-icon"></i>
        <span class="menu-title">{{ __('Fresh orders') }}</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('manager.orders.processing') }}">
        <i class="mdi mdi-circle-outline menu-icon"></i>
        <span class="menu-title">{{ __('My Orders') }}</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('manager.customers') }}">
        <i class="mdi mdi-account-multiple-outline menu-icon"></i>
        <span class="menu-title">{{ __('Customers') }}</span>
      </a>
    </li>

    <li class="nav-item" style="{{ $manager->is_root ? '' : 'opacity:.5;pointer-events:none;' }}">
      <a class="nav-link" href="{{ route('manager.root.managers') }}">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">{{ __('Managers') }}</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('manager.reviews') }}">
        <i class="mdi mdi mdi mdi-star-outline menu-icon"></i>
        <span class="menu-title">{{ __('Reviews') }}</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('manager.logout') }}">
        <i class="mdi mdi mdi-logout-variant menu-icon"></i>
        <span class="menu-title">{{ __('Logout') }}</span>
      </a>
    </li>
{{--    <li class="nav-item">--}}
{{--      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">--}}
{{--        <i class="mdi mdi mdi-face-profile menu-icon"></i>--}}
{{--        <span class="menu-title">{{ __('My Profile') }}</span>--}}
{{--        <i class="menu-arrow"></i>--}}
{{--      </a>--}}
{{--      <div class="collapse show" id="ui-basic">--}}
{{--        <ul class="nav flex-column sub-menu">--}}
{{--          <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{ route('customer.dashboard.profile') }}">{{ __('Profile') }}</a>--}}
{{--          </li>--}}
{{--          <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{ route('customer.dashboard.settings', ['_s' => ['pwd']]) }}">{{ __('Change Password') }}</a>--}}
{{--          </li>--}}
{{--          <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{ route('customer.dashboard.settings') }}">{{ __('Settings') }}</a>--}}
{{--          </li>--}}
{{--        </ul>--}}
{{--      </div>--}}
{{--    </li>--}}
  </ul>
</nav>
