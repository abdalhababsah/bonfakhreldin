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

    public function add(CartAddRequest $request)
    {
        try {
            $msg = $this->cartService->add($request->all());
        } catch (Exception $e) {
            $msg = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
        return response()->json($msg);
    }
    public function update(Request $request, $key)
    {
        try {
            $msg = $this->cartService->updateQuantity($key, $request->quantity);
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
                'count' => $count ?? 0
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