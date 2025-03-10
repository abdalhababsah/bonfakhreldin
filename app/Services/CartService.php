<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductSize;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
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

        if (!$product || !$product->is_active) {
            return ['status' => 'error', 'message' => __('cart.product_not_found')];
        }

        $cart = $this->getGuestCart();
        $cartItemKey = $productId . '-' . $sizeId;
        $existingQty = isset($cart[$cartItemKey]) ? $cart[$cartItemKey] : 0;
        $newQuantity = $existingQty + $quantity;

        $cart[$cartItemKey] = $newQuantity;
        $this->save($cart);

        return ['status' => 'success', 'message' => __('cart.product_added'), 'response' => $cart];
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
        $cart = $this->getGuestCart();

        if (isset($cart[$key])) {
            unset($cart[$key]);
            $this->save($cart);
            return ['status' => 'success', 'message' => __('cart.product_removed')];
        } else {
            return ['status' => 'error', 'message' => __('cart.product_not_in_cart')];
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

        $cart = $this->getGuestCart();

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
    public function getItems()
    {
        $cart = $this->getGuestCart();
        $items = [];

        foreach ($cart as $key => $quantity) {
            $keyParts = explode('-', $key);
            $productId = $keyParts[0];
            $productSize = isset($keyParts[1]) ? ProductSize::find($keyParts[1]) : null;
            $product = Product::find($productId);

            if ($product && $product->is_active) {
                $items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $productSize?->price,
                    'size_id' => $productSize?->id,
                    'size' => $productSize?->value,
                    'quantity' => $quantity,
                    'total' => $quantity * $product->price,
                    // 'discounted_price' => $product->discounted_price,
                    // 'discount' => $product->discount,
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
    protected function getGuestCart()
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
        $items = $this->getItems(); // Fetch cart items
        $totalPrice = $this->getTotalPrice($items); // Calculate total price

        return [
            'items' => $items,
            'totalPrice' => $totalPrice,
        ];
    }

    public function clearCart()
    {
        Cookie::queue(Cookie::forget($this->cookieName));
    }
}
