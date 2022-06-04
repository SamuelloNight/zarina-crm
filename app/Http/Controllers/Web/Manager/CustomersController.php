<?php

namespace App\Http\Controllers\Web\Manager;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
  public function show()
  {
    return view('pages.manager.customers.list', [
      'customers' => Customer::all()
    ]);
  }

  public function showEdit($id)
  {
    return view('pages.manager.customers.edit', [
      'customer' => Customer::find($id)
    ]);
  }
}
