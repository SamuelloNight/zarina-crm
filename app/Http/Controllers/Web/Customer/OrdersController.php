<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
  public function show(Request $request)
  {
    $services = [
      'Web Site' => [
        'Website development',
        'Development of an online store',
        'CMS system development',
        'Turnkey website development',
        'Online payment integration',
        'Website maintenance',
        'Web Hosting Services',
        'Registering or linking a domain',
        'SEO website optimization',
      ],

      'Design' => [
        'Static site design',
        'Dynamic site design',
        'Email design',
        'Animation design',
        'Logo design',
      ],

      'Common' => [
        'I want to order another service',
      ],
    ];

    return view(
      'pages.'.str_replace(['/', '.{id}'], ['.', ''], $request->route()->uri()), [
        'customer' => auth('customer')->user(),
        'services' => $services,
      ]
    );
  }

  public function more($id)
  {
    $order = Order::whereId($id)->whereCustomerId(auth('customer')->id())->first();

    if (!$order) {
      return abort(404);
    }

    return view('pages.dashboard.orders.more', [
      'order' => $order
    ]);
  }

  public function create(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'phone_number' => 'required',
      'email' => 'required',
      'company_name' => '',
      'description' => '',
      'services' => 'required',
      'services.*' => 'required',
    ], [
      'name.required' => 'Enter customer name',
      'phone_number.required' => 'Enter your contact phone number',
      'email.required' => 'Please enter a contact email address',
      'services.required' => 'Please select at least one service',
      'services.*.required' => 'Please select at least one service',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }

    $validated = $validator->validated();
    $validated['customer_id'] = auth('customer')->id();
    $validated['company'] = $validated['company_name'] ?? 'Not specified';
    $validated['services'] = json_encode($validated['services']);

    Order::create($validated);

    return redirect()->route('customer.dashboard.orders')->with(
      'successMessage', __('The application has been created, in the near future the manager will contact you. Thank you!!')
    );
  }

  public function delete($id)
  {
    $order = Order::whereId($id)->whereCustomerId(auth('customer')->id())->first();

    if (!$order) {
      return abort(404);
    }

    $order->update([
      'status' => Order::STATUS_DELETED_BY_CUSTOMER
    ]);

    return redirect()->route('customer.dashboard.orders')->with('successMessage', __('Order successfully deleted'));
  }
}
