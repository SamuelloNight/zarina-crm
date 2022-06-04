<?php

namespace App\Http\Controllers\Web\Manager;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticateController extends Controller
{
  public function show()
  {
    return view('pages.manager.auth.login');
  }

  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|exists:managers',
      'password' => 'required',
    ], [
      'email.required' => __('Please enter an email address'),
      'email.exists' => __('The manager with the specified email was not found'),
      'password.required' => __('Enter a password for your account'),
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }

    $validated = $validator->validated();
    $manager = Manager::whereEmail($validated['email'])->first();

    if (!Hash::check($validated['password'], $manager->password)) {
      return redirect()->back()->withErrors([
        'password' => __('The entered password is incorrect')
      ]);
    }

    auth('manager')->login($manager);

    return redirect()->route('manager.orders.fresh');
  }

  public function logout()
  {
    auth('manager')?->logout();
    return redirect()->route('manager.login');
  }
}
