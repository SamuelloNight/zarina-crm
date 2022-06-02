<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\NoReturn;

class AuthenticateController extends Controller
{
  public function show(Request $request)
  {
    return view(
      'pages.'.str_replace('/', '.', $request->route()->uri())
    );
  }

  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'first_name' => 'required',
      'last_name' => 'required',
      'email' => 'required|email|unique:customers',
      'phone_number' => 'required|unique:customers',
      'password' => 'required|min:5|max:128',
      'business_area' => 'required',
    ], [
      'first_name.required' => 'Укажите Ваше имя',
      'last_name.required' => 'Укажите Вашу фамилию',
      'email.required' => 'Укажите адрес Вашей электронной почты',
      'email.email' => 'Указанный адрес электронной почты имеет неверный формат',
      'email.unique' => 'Указанный почта уже зарегистрирована',
      'phone_number.required' => 'Укажите Ваш номер телефона',
      'phone_number.unique' => 'Указанный номер телефона уже зарегистрирован',
      'password.required' => 'Укажите пароль для аккаунта',
      'password.min' => 'Пароль должен состоять минимум из 5 символов',
      'password.max' => 'Пароль должен состоять максимум из 128 символов',
      'business_area.required' => 'Выберите сферу Вашего бизнеса',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }

    $validated = $validator->validated();
    $validated['password'] = bcrypt($validated['password']);
    $customer = Customer::create($validated);

    auth('customer')->login($customer);

    return redirect()->route('customer.dashboard.main');
  }

  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'phone_number' => 'required|exists:customers',
      'password' => 'required',
    ], [
      'phone_number.required' => 'Укажите Ваш номер телефона',
      'phone_number.exists' => 'Пользователь с указанным номером телефона не найден',
      'password.required' => 'Укажите пароль для аккаунта',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }

    $validated = $validator->validated();
    $customer = Customer::wherePhoneNumber($validated['phone_number'])->first();

    if (!Hash::check($validated['password'], $customer->password)) {
      return redirect()->back()->withErrors([
        'password' => 'Введённый пароль неверный'
      ]);
    }

    auth('customer')->login($customer);

    return redirect()->route('customer.dashboard.main');
  }

  public function logout()
  {
    auth('customer')?->logout();
    return redirect()->route('customer.login');
  }
}
