<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function show()
{
    $cartItems = Cart::with(['product', 'size'])->get(); // or session('cart')
    $total = $cartItems->sum(fn($item) => $item->size->price);
    return view('pages.checkout', compact('cartItems', 'total'));
}

public function addToCart(Request $request)
{
    $cart = session('cart', []);

    $cart[] = [
        'product_id' => $request->product_id,
        'product_name' => $request->product_name,
        'size' => $request->size_value,
        'price' => $request->price,
        'quantity' => 1
    ];

    session(['cart' => $cart]);

    return redirect()->route('checkout.show');
}

}
