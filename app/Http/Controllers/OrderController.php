<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnums;
use App\Http\Requests\OrderRequest;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Services\CartService;
use Exception;

class OrderController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $orders = Order::all();

        return view('pages.admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('pages.admin.orders.show', compact('order'));
    }

    public function store(OrderRequest $request)
    {
        $cart = $this->cartService->getCartDetails();
        
        $order = Order::create([
            'order_number' => uniqid('ORD-'),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => OrderStatusEnums::Pending,
            'notes' => $request->notes,
            'total_price' => $cart['totalPrice'],
            'deliverable' => $request->deliverable,
        ]);
        
        $delivery_fee = City::find($request->city_id)?->delivery_fee ?? 0;
        $deliverableData = array_merge($request->only('branch', 'area_id', 'address', 'longitude', 'latitude'), [
            'delivery_fee' => $delivery_fee,
        ]);
        $order->{$request->deliverable}()->create($deliverableData);

        $orderProducts = [];
        foreach ($cart['items'] as $product) {
            $orderProducts[] = [
                'order_id' => $order->id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
                'size' => $product['size'],
                'option' => $product['option'] ?? null,
                'additions' => json_encode($product['additions'] ?? []),
                'price' => $product['price'],
                'total_price' => $product['total'],
            ];
        }
        OrderProduct::insert($orderProducts);

        $this->cartService->clear();

        return redirect()->route('cart.index') // redirect to checkout success page
            ->with('success', 'Order created successfully.');
    }
    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();

        return redirect()->back();
    }
}
