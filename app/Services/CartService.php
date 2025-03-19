<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Cookie;
use Log;

class CartService
{
    protected $cart;
    protected $cookieName = 'cart';

    public function __construct()
    {
        $this->cart = null;
    }

    /**
     * Add a product to the cart.
     *
     * @param int $productId
     * @param int $quantity
     * @param int $sizeId
     * @return array
     */
    public function add($productId, $quantity = 1, $sizeId = null)
    {
        $product = Product::find($productId);

        if (!$product || $product->status != 'active') {
            Log::error('Product not found or not active');
            return ['status' => 'error', 'message' => __('cart.product_not_found')];
        }

        $cart = $this->getCookieCart();
        $cartItemKey = $productId . '-' . $sizeId;
        $existingQty = isset($cart[$cartItemKey]) ? $cart[$cartItemKey] : 0;
        $newQuantity = $existingQty + $quantity;

        $cart[$cartItemKey] = $newQuantity;
        $this->save($cart);
        Log::info('Cart: ' . json_encode($cart));

        return ['status' => 'success', 'message' => __('Product added to cart'), 'response' => $cart];
    }

    /**
     * Remove a product from the cart.
     *
     * @param int $productId
     * @param int $sizeId
     * @return array
     */
    public function removeItem($key)
    {
        $cart = $this->getCookieCart();

        if (isset($cart[$key])) {
            unset($cart[$key]);
            $this->save($cart);
            return ['status' => 'success', 'message' => __('Product removed from cart'), 'cart' => $cart];
        } else {
            return ['status' => 'error', 'message' => __('Product not in cart')];
        }
    }

    /**
     * Update the quantity of a product in the cart.
     *
     * If requested quantity exceeds available stock, it is automatically adjusted to the maximum available quantity.
     *
     * @param int $productId
     * @param int $quantity
     * @param int $sizeId
     * @return array
     */
    public function updateQuantity($productId, $quantity, $sizeId = null)
    {
        if ($quantity < 1) {
            return ['status' => 'error', 'message' => __('cart.invalid_quantity')];
        }

        $product = Product::find($productId);

        if (!$product || !$product->is_active) {
            return ['status' => 'error', 'message' => __('cart.product_not_found')];
        }

        $cart = $this->getCookieCart();

        if (!isset($cart[$productId. '-' . $sizeId])) {
            return ['status' => 'error', 'message' => __('cart.product_not_in_cart')];
        }

        // Update the quantity in the guest cart
        $cart[$productId. '-' . $sizeId] = $quantity;
        $this->save($cart);

        return ['status' => 'success', 'message' => __('cart.cart_updated')];
    }

    /**
     * Get all cart items.
     *
     * @return array
     */
    public function getItems($cart)
    {
        // $cart = $this->getGuestCart();
        $items = [];

        foreach ($cart as $key => $quantity) {
            $keyParts = explode('-', $key);
            $productId = $keyParts[0];
            $productSize = isset($keyParts[1]) ? ProductSize::find($keyParts[1]) : null;
            $product = Product::find($productId);

            if ($product && $product->status == 'active') {
                $items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $productSize?->price,
                    'size_id' => $productSize?->id,
                    'size' => $productSize?->value,
                    'option' => '',
                    'quantity' => $quantity,
                    'total' => $quantity * $productSize->price,
                    'image_url' => $product->primaryImage ? asset('storage/' . $product->primaryImage->image_url) : 'https://via.placeholder.com/262x370',
                ];
            }
        }
        return $items;
    }

    /**
     * Get total price of the cart.
     *
     * @return float
     */
    public function getTotalPrice($items)
    {
        $total = 0;

        foreach ($items as $item) {
            $productTotal = $item['price'] * $item['quantity'];//discounted_
            $total += $productTotal;
        }

        return round($total, 2); // Ensure consistent rounding
    }

    /**
     * Get the guest cart from cookies.
     *
     * @return array
     */
    protected function getCookieCart()
    {
        $cart = Cookie::get($this->cookieName);

        return $cart ? json_decode($cart, true) : [];
    }

    /**
     * Save the guest cart to cookies.
     *
     * @param array $cart
     * @return void
     */
    protected function save($cart)
    {
        Cookie::queue($this->cookieName, json_encode($cart), 60 * 24 * 7); // 7 days
    }

    public function getCartDetails()
    {
        $cart = $this->getCookieCart();
        $items = $this->getItems($cart); // Fetch cart items
        $totalPrice = $this->getTotalPrice($items); // Calculate total price

        $sessionCart = session()->get('cart', ['items' => [], 'totalPrice' => 0]);
        return $sessionCart;
    }

    public function clear()
    {
        Cookie::queue(Cookie::forget($this->cookieName));
    }

    /**
     * Get the total quantity of items in the cart.
     *
     * @return int
     */
    public function getTotalQuantity()
    {
        $cart = $this->getCookieCart();
        $totalQuantity = 0;

        foreach ($cart as $quantity) {
            $totalQuantity += $quantity;
        }

        return $totalQuantity;
    }
}
