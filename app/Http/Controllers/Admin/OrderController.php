<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatusEnums;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate();

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $details = OrderProduct::where('order_id', $id)->get();

        return view('admin.orders.show', compact('order', 'details'));
    }

    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();

        return redirect()->back();
    }
}
