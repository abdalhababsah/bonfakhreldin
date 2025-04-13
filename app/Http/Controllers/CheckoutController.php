<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\City;
use App\Services\CartService;

class CheckoutController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCartDetails();
        $cities = City::all();

        return view('pages.checkout.index', compact('cart', 'cities'));
    }


}
