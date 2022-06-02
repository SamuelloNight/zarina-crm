<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomerNavbar extends Component
{
  public function __construct()
  {
    //
  }

  public function render(): View|Factory|Htmlable|Closure|string|Application
  {
    return view('components.customer-navbar', [
      'customer' => auth('customer')?->user()
    ]);
  }
}
