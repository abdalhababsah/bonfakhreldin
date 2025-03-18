<?php

namespace App\Http\Controllers;
use App\Http\Requests\CartAddRequest;
use App\Models\City;
use App\Services\CartService;
use Exception;
use Illuminate\Http\Request;
use Log;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function index()
    {
        $cart = $this->cartService->getCartDetails();

        return view('pages.cart.index', compact('cart'));
    }

    public function checkout()
    {
        $cart = $this->cartService->getCartDetails();
        $cities = City::all();

        return view('pages.checkout.index', compact('cart', 'cities'));
    }

    public function add(CartAddRequest $request, $id)
    {
        try {
            $msg = $this->cartService->add($id, $request->quantity, $request->size_id);
        } catch (Exception $e) {
            $msg = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
        return $msg;
    }
    public function update(CartAddRequest $request, $id)
    {
        try {
            $msg = $this->cartService->updateQuantity($id, $request->quantity, $request->size_id);
        } catch (Exception $e) {
            $msg = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
        return $msg;
    }
    public function delete($key)
    {
        try {
            $msg = $this->cartService->removeItem($key);
        } catch (Exception $e) {
            $msg = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
        return $msg;
    }

    public function clear()
    {
        try {
            $this->cartService->clear();
            $msg = [
                'status' => 'success',
                'message' => __('Cart cleared successfully')
            ];
        } catch (Exception $e) {
            $msg = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
        return $msg;
    }

    public function countItem()
    {
        try {
            $count = $this->cartService->getTotalQuantity();
            $msg = [
                'status' => 'success',
                'count' => $count
            ];
        } catch (Exception $e) {
            $msg = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
        return $msg;
    }
}
