<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ManagerAuthenticated
{
  public function handle(Request $request, Closure $next)
  {
    if (auth('manager')->check()) {
      return $next($request);
    }

    return redirect()->route('manager.login');
  }
}
