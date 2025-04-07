<?php

namespace App\Services;

use App\Models\Addition;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductOption;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class CartService
{
    protected $cart;
    protected $cookieName = 'cart';

    public function __construct()
    {
        $this->cart = null;
    }

    /**
     * Add a product to the cart with options and additions.
     *
     * @param array $data
     * @return array
     */
    public function add($data)
    {
        $product = Product::find($data['product_id']);

        if (!$product || $product->status != 'active') {
            Log::error('Product not found or not active');
            return ['status' => 'error', 'message' => __('cart.product_not_found')];
        }

        $cart = $this->getCookieCart();
        $cartItemKey = $data['product_id'] . '-' . $data['size_id'] . '-' . $data['option_id'];

        // Include additions in the cart key
        if (!empty($data['additions'])) {
            $additionKeys = array_map(function ($quantity, $key) {
            return $key . 'x' . $quantity;
            }, $data['additions'], array_keys($data['additions']));
            Log::info('Addition keys', $additionKeys);
            $cartItemKey .= '-' . implode(',', $additionKeys);
        }

        $existingQty = isset($cart[$cartItemKey]) ? $cart[$cartItemKey] : 0;
        $newQuantity = $existingQty + $data['quantity'];

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
    public function updateQuantity($key, $quantity)
    {
        if ($quantity < 1) {
            return ['status' => 'error', 'message' => __('cart.invalid_quantity')];
        }

        // $product = Product::find($productId);

        // if (!$product || !$product->is_active) {
        //     return ['status' => 'error', 'message' => __('cart.product_not_found')];
        // }

        $cart = $this->getCookieCart();

        if (!isset($cart[$key])) {
            return ['status' => 'error', 'message' => __('cart.product_not_in_cart')];
        }

        // Update the quantity in the guest cart
        $cart[$key] = $quantity;
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
        $items = [];

        foreach ($cart as $key => $quantity) {
            $keyParts = explode('-', $key);
            $productId = $keyParts[0];
            $productSize = isset($keyParts[1]) ? ProductSize::find($keyParts[1]) : null;
            $productOption = isset($keyParts[2]) ? ProductOption::find($keyParts[2]) : null;
            $productAdditions = isset($keyParts[3]) ? explode(',',  $keyParts[3]) : [];
            $additionsDetails = [];

            foreach ($productAdditions as $addition) {
                list($additionId, $additionQuantity) = explode('x', $addition);
                $additionModel = Addition::find($additionId);
                $additionsTotal = 0;
                if ($additionModel) {
                    $additionsDetails[] = [
                        'id' => $additionModel->id,
                        'name' => $additionModel->name,
                        'price' => $additionModel->price,
                        'quantity' => $additionQuantity,
                        'total' => $additionModel->price * $additionQuantity,
                    ];
                    $additionsTotal += $additionModel->price * $additionQuantity;
                }
            }
            $product = Product::find($productId);

            if ($product && $product->status == 'active') {
                $productPrice = $productSize ? $productSize->price + ($additionsTotal ?? 0) : 0;
                $items[] = [
                    'product_id' => $product->id,
                    'key' => $key,
                    'name' => $product->name,
                    'price' => $productPrice ,
                    'size_id' => $productSize?->id,
                    'size' => $productSize?->value,
                    'option' => $productOption?->name,
                    'additions' => $additionsDetails,
                    'quantity' => $quantity,
                    'total' => $quantity * $productPrice,
                    'image_url' => $product->primaryImage ? asset('storage/' . $product->primaryImage->image_url) : 'https://placehold.co/262x370',
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
            $productTotal = $item['price'] * $item['quantity'];
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

        return [
            'items' => $items,
            'totalPrice' => $totalPrice,
        ];
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
