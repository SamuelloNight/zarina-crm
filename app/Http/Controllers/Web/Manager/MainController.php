<?php

namespace App\Http\Controllers\Web\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
  public function show()
  {
    return view('pages.manager.dashboard.main');
  }
}
