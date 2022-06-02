<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerAuthenticated
{
  public function handle(Request $request, Closure $next)
  {
    if (auth('customer')->check()) {
      return $next($request);
    }

    return redirect()->route('customer.login');
  }
}
