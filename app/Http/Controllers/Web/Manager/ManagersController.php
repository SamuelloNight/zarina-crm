<?php

namespace App\Http\Controllers\Web\Manager;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManagersController extends Controller
{
  public function show()
  {
    return view('pages.manager.managers.list', [
      'managers' => Manager::all()
    ]);
  }

  public function showCreate()
  {
    return view('pages.manager.managers.create');
  }

  public function showEdit($id)
  {
    return view('pages.manager.managers.edit', [
      'manager' => Manager::find($id)
    ]);
  }

  public function create(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'first_name' => 'required',
      'last_name' => 'required',
      'email' => 'required|email|unique:managers',
      'phone_number' => 'required|unique:managers',
      'password' => 'required',
      'password_confirm' => 'required|same:password',
    ], [
      'first_name.required' => __('Enter manager first name'),
      'last_name.required' => __('Enter manager last name'),
      'email.required' => __('Enter manager email'),
      'email.email' => __('Invalid email format'),
      'email.unique' => __('Email already used'),
      'phone_number.required' => __('Enter manager phone number'),
      'phone_number.unique' => __('Phone number already used'),
      'password.required' => __('Enter manager password'),
      'password_confirm.required' => __('Enter manager password confirm'),
      'password_confirm.same' => __('Passwords do not match'),
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }

    $validated = $validator->validated();
    $validated['password'] = bcrypt($validated['password']);
    $manager = Manager::create($validated);
    $manager = $manager->toArray();
    $manager['password'] = $request->post('password');

    return redirect()->back()->with('successMessage', __('Manager successfully created'))
      ->with('newManager', $manager);
  }
}
