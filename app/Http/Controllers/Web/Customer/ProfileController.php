<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
  public function show()
  {
    return view('pages.dashboard.profile', [
      'customer' => auth('customer')->user(),
    ]);
  }
}
