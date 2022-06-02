<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewsController extends Controller
{
  public function show(Request $request)
  {
    $reviews = Review::wherePublished(true)->with([
      'customer'
    ])->get();

    $customer = Customer::whereId(auth('customer')->id())->with([
      'review'
    ])->first();

    return view(
      'pages.'.str_replace('/', '.', $request->route()->uri()), [
        'customer' => $customer,
        'reviews' => $reviews,
      ]
    );
  }

  public function create(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'message' => 'required|min:1|max:2048',
      'grade' => 'required|integer|min:1|max:5',
    ], [
      'message.required' => __('Specify a feedback message'),
      'message.min' => __('Feedback must be at least 1 character'),
      'message.max' => __('A review can have a maximum of 2048 characters'),
      'grade.required' => __('Select your grade'),
      'grade.integer' => __('Rating must be a number'),
      'grade.min' => __('The minimum score can be: 1'),
      'grade.max' => __('The maximum score can be: 5'),
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }

    $validated = $validator->validated();
    $validated['customer_id'] = auth('customer')->user()->id;
    $validated['published'] = false;

    Review::create($validated);

    return redirect()->back()->with('successMessage', __('Thanks for review!'));
  }
}
