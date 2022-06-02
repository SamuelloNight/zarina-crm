<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
  public function show(Request $request)
  {
    $businessAreaTypes = [
      'Фитнес и здоровье',
      'Строительство и ремонт',
      'Юридические услуги',
      'Дизайн и рисование',
      'Транспортные компании',
      'Ресторан и кафе',
      'Ночные клубы и бары',
      'Маркетинговые услуги',
      'Веб-студия',
      'Реализация или продажа товара',
      'Другое...',
    ];

    return view('pages.dashboard.settings', [
      'customer' => auth('customer')->user(),
      'selected' => $request->get('_s', []),
      'businessAreaTypes' => $businessAreaTypes,
    ]);
  }

  public function profile(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'first_name' => 'required',
      'last_name' => 'required',
      'email' => 'required|email',
      'phone_number' => 'required',
      'business_area' => 'required',
    ], [
      'first_name.required' => __('Enter a first name'),
      'last_name.required' => __('Enter a last name'),
      'email.required' => __('Enter email address'),
      'email.email' => __('Invalid email format specified'),
      'phone_number.required' => __('Enter a phone number'),
      'business_area.required' => __('Select business category'),
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }

    $validated = $validator->validated();
    $customer = auth('customer')->user();

    $customer->update($validated);

    return redirect()->back()->with('successMessage', __('Data successfully changed!'));
  }

  public function password(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'current_password' => 'required',
      'new_password' => 'required|min:5|max:128',
      'new_password_confirm' => 'required|same:new_password',
    ], [
      'current_password.required' => __('Enter your current password'),
      'new_password.required' => __('Enter your new password'),
      'new_password.min' => __('Password must be at least 5 characters long'),
      'new_password.max' => __('The password must be a maximum of 128 characters'),
      'new_password_confirm.required' => __('Enter confirmation of the new password'),
      'new_password_confirm.same' => __('Passwords do not match'),
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }

    $validated = $validator->validated();
    $customer = auth('customer')->user();

    if (!Hash::check($validated['current_password'], $customer->password)) {
      return redirect()->back()->withErrors([
        'current_password' => __('Wrong current password specified')
      ]);
    }

    $customer->update([
      'password' => bcrypt($validated['new_password'])
    ]);

    auth('customer')->logout();
    auth('customer')->login($customer);

    return redirect()->back()->with('successMessage', __('Password successfully changed'));
  }
}
