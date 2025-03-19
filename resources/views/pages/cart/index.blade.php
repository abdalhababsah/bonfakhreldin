@extends('layout.mainlayout')

@section('title', __('Cart'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="section-title">{{ __('Your Cart') }}</h1>

            @if(!empty($cart['items']) && is_array($cart['items']))
            <div class="cart-table table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Product') }}</th>
                            <th>{{ __('Size') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Total') }}</th>
                            <th>{{ __('Remove') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart['items'] as $item)
                        <tr>
                            <td class="image">
                                <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" style="width: 60px;">
                            </td>
                            <td class="product">{{ $item['name'] }}</td>
                            <td class="size">{{ $item['size'] }}</td>
                            <td class="price">{{ number_format($item['price'], 2) }} JOD</td>
                            <td class="quantity">
                                <input
                                type="number" 
                                name="quantity" 
                                class="form-control quantity-input"
                                data-product-id="{{ $item['product_id'] }}"
                                data-size-id="{{ $item['size_id'] }}"
                                data-price="{{ $item['price'] }}"
                                value="{{ $item['quantity'] }}"
                                >
                            </td>
                            <td class="total">
                                <span id="total-{{ $item['product_id'] }}-{{ $item['size_id'] }}">
                                    {{ number_format($item['total'], 2) }} JOD
                                </span>
                            </td>
                            <td>
                            <form action="{{ url('cart/remove', $item['product_id'] . '-' . $item['size_id']) }}" method="POST" class="remove-item-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn remove-item-btn" onclick="return confirmAndRemove(this);">
                                    <i class="sli-trash"></i>
                                </button>
                            </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="cart-totals mt-4">
                <h2 class="title">{{ __('Cart Totals') }}</h2>
                <table class="table">
                    <tr>
                        <th>{{ __('Subtotal') }}</th>
                        <td id="cart-subtotal">{{ number_format($cart['totalPrice'], 2) }} JOD</td>
                    </tr>
                </table>
                <a href="{{ url('cart/checkout') }}" class="btn btn-create">{{ __('Proceed to Checkout') }}</a>
            </div>
            @else
                <p>{{ __('Your cart is currently empty.') }}</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function () {
            const productId = this.dataset.productId;
            const sizeId = this.dataset.sizeId;
            const newQty = parseInt(this.value);
            const price = parseFloat(this.dataset.price);
            const totalSpan = document.getElementById(`total-${productId}-${sizeId}`);

            if (isNaN(newQty) || newQty < 1) return;

            fetch(`/cart/update/${productId}-${sizeId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    quantity: newQty,
                    size_id: sizeId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const newTotal = (newQty * parseFloat(this.dataset.price)).toFixed(2);
                    document.getElementById(`total-${productId}-${sizeId}`).innerText = newTotal;

                    updateCartSubtotal();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error("Update failed", error));
        });
    });

    function updateCartSubtotal() {
        let subtotal = 0;
        document.querySelectorAll('.quantity-input').forEach(input => {
            const qty = parseFloat(input.value);
            const price = parseFloat(input.dataset.price);
            subtotal += qty * price;
        });

        document.getElementById('cart-subtotal').innerText = `$${subtotal.toFixed(2)}`;
    }
});

function confirmAndRemove(btn) {
    if (confirm('Are you sure you want to remove this item?')) {
        btn.closest('form').submit();
        return true;
    }
    return false;
}

</script>
@endsection
