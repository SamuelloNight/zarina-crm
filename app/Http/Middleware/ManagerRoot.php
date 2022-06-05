<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ManagerRoot
{
  public function handle(Request $request, Closure $next)
  {
    $manager = auth('manager')?->user();

    if ($manager && $manager->is_root) {
      return $next($request);
    }

    return redirect()->route('manager');
  }
}
