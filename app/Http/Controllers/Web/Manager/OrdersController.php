<?php

namespace App\Http\Controllers\Web\Manager;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
  public function showFresh()
  {
    $orders = Order::whereManagerId(null)->with([
      'customer'
    ])->whereStatus(Order::REQUEST_FROM_CLIENT)->get();

    return view('pages.manager.orders.fresh', [
      'orders' => $orders
    ]);
  }

  public function showProcessing()
  {
    $manager = auth('manager')->user();
    $orders = Order::whereManagerId($manager->id)->with([
      'customer'
    ])->get();

    return view('pages.manager.orders.processing', [
      'manager' => $manager,
      'orders' => $orders,
    ]);
  }

  public function showMore($id)
  {
    return view('pages.manager.orders.more', [
      'manager' => auth('manager')->user(),
      'order' => Order::find($id),
    ]);
  }

  public function accept($id)
  {
    $order = Order::find($id);

    if (!$order) {
      abort(404);
    } else if ($order->manager) {
      return redirect()->back()->with('successMessage', __('This order has already been accepted by the manager'));
    }

    $order->update([
      'manager_id' => auth('manager')->id(),
      'status' => Order::ACCEPTED_BY_MANAGER
    ]);

    return redirect()->back()->with('successMessage', __('You have successfully accepted the order for processing'));
  }

  public function status($id, Request $request)
  {
    $order = Order::find($id);

    if (!$order) {
      abort(404);
    }

    $order->update([
      'status' => $request->get('status', $order->status)
    ]);

    return redirect()->back()->with('successMessage', __('Order status successfully changed'));
  }
}
