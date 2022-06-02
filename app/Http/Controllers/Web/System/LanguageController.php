<?php

namespace App\Http\Controllers\Web\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
  public function change(Request $request)
  {
    Session::put('locale', $request->get('locale'));
    return redirect()->back();
  }
}
