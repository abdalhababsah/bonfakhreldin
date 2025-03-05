<?php

namespace App\Http\Controllers;
use App\Http\Requests\CartAddRequest;
use App\Services\CartService;
use Exception;
use Illuminate\Http\Request;

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
}
