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
        // dd(session('cart'));

        $cart = $this->cartService->getCartDetails();

        return view('pages.cart.index', compact('cart'));
    }

    public function checkout()
    {
        $cart = $this->cartService->getCartDetails();
        $cities = City::all();

        return view('pages.checkout.index', compact('cart', 'cities'));
    }

    public function add(Request $request)
    {
        $item = $request->all();
        $cart = session()->get('cart', ['items' => [], 'totalPrice' => 0]);
    
        $key = $item['product_id'] . '-' . $item['size_id'];
    
        if (isset($cart['items'][$key])) {
            $cart['items'][$key]['quantity'] += $item['quantity'];
            $cart['items'][$key]['total'] += $item['price'] * $item['quantity'];
        } else {
            $cart['items'][$key] = [
                'product_id' => $item['product_id'],
                'name' => $item['name'],
                'image_url' => $item['image_url'],
                'size_id' => $item['size_id'],
                'size' => $item['size'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
                'option' => $item['option']
            ];
        }
    
        // Recalculate total
        $cart['totalPrice'] = collect($cart['items'])->sum('total');
    
        session()->put('cart', $cart);
    
        return response()->json(['message' => 'Added to cart', 'cart' => $cart]);
    }
    
    public function update(CartAddRequest $request, $id)
{
    $cart = session()->get('cart', ['items' => [], 'totalPrice' => 0]);

    if (isset($cart['items'][$id])) {
        $cart['items'][$id]['quantity'] = $request->quantity;
        $cart['items'][$id]['total'] = $cart['items'][$id]['price'] * $request->quantity;
        
        // Recalculate total cart price
        $cart['totalPrice'] = collect($cart['items'])->sum('total');

        session()->put('cart', $cart);

        return response()->json(['status' => 'success', 'message' => 'Quantity updated!', 'cart' => $cart]);
    }

    return response()->json(['status' => 'error', 'message' => 'Item not found in cart']);
}

    // Example in your CartController delete method:
    public function delete($key)
{
    $cart = session()->get('cart', ['items' => [], 'totalPrice' => 0]);

    if(isset($cart['items'][$key])){
        unset($cart['items'][$key]);
        $cart['totalPrice'] = array_sum(array_column($cart['items'], 'total'));
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('message', __('Item removed successfully'));
    }

    return redirect()->route('cart.index')->with('error', __('Item not found in cart'));
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
        $cart = session()->get('cart', ['items' => []]);
        $count = count($cart['items']);
    
        return response()->json(['count' => $count]);
    }
    
}
