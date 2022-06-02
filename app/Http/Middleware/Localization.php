<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Localization
{
  public function handle(Request $request, Closure $next)
  {
    App::setLocale(Session::get('locale', 'ru'));
    return $next($request);
  }
}
