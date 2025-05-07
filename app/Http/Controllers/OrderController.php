<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnums;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderMail;
use App\Mail\AdminOrderMail;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Services\CartService;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function show($number)
    {
        $order = Order::where('order_number', $number)->firstOrFail();

        // return view('pages.orders.show', compact('order'));//need to build this view
    }

    public function store(OrderRequest $request)
    {
        try {
            $cart = $this->cartService->getCartDetails();

            if (empty($cart['items'])) {
            return redirect()->back()->withErrors(['cart' => 'Your cart is empty.']);
            }

            $deliveryFee = City::find($request->city_id)?->delivery_fee ?? 0;

            DB::beginTransaction();

            $orderData = [
            'order_number' => uniqid('ORD-'),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => OrderStatusEnums::Pending,
            'notes' => $request->notes,
            'total_price' => $cart['totalPrice'],
            'deliverable' => $request->deliverable,
            'lang' => app()->getLocale(),
            ];

            $order = Order::create($orderData);

            $deliverableData = $request->only('branch', 'area_id', 'address', 'longitude', 'latitude');
            $deliverableData['delivery_fee'] = $deliveryFee;

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

            DB::commit();

            // Dispatch email jobs to the queue
            dispatch(function () use ($order) {
            Mail::to($order->email)->send(new OrderMail($order));
            Mail::to(config('mail.admin_email'))->send(new AdminOrderMail($order));
            })->onQueue('emails');

            // Run a server-side command when the order is created
            Artisan::call('queue:work', [
                '--queue' => 'emails',
                '--once' => true,
            ]);

            return redirect()->route('home')
            ->with('success', 'Order created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            return redirect()->back()->withErrors(['error' => 'An error occurred while processing your order. Please try again later.']);
        }
    }

}
