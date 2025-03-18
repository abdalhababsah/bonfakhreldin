@extends('layout.mainlayout')

@section('title', 'Shop')

@push('styles')
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .shop-filter {
        background: #ffffff;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid #e0e0e0;
        margin-bottom: 40px;
    }

    .shop-filter label {
        font-weight: 600;
        color: #333;
    }
    .product-card {
        border: none;
        border-radius: 12px;
        padding: 24px;
        background: #fff;
        transition: box-shadow 0.3s ease-in-out;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        text-align: center;
    }

    .product-card:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .product-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 12px;
        color: #222;
    }

    .product-description {
        font-size: 0.95rem;
        color: #555;
        margin-bottom: 12px;
    }

    .size-select,
    .form-select,
    .form-control {
        font-size: 0.95rem;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        transition: border 0.2s;
    }

    .form-select:focus,
    .form-control:focus {
        border-color: #126442;
        box-shadow: 0 0 0 3px rgba(18, 100, 66, 0.15);
    }

    button.apply-btn{
        background: #126442 !important;
    }
    .add-to-cart-btn {
        width: 100%;
        background: #126442;
        border: none;
        padding: 14px;
        font-weight: 600;
        font-size: 1rem;
        border-radius: 8px;
        color: #fff;
        transition: background 0.3s ease;
    }

    .add-to-cart-btn:hover {
        background: #0f5537;
    }

    .product-card img {
        border-radius: 8px;
        max-height: 200px;
        object-fit: contain;
        width: 100%;
        margin-bottom: 16px;
    }

    .text-muted.small {
        margin-top: 4px;
        font-size: 0.9rem;
        color: #888;
    }

    .product-card select.form-select {
        margin-bottom: 10px;
    }

    /* Filter Form */
    form.mb-5 {
        background-color: #f5f5f5;
        padding: 24px;
        border-radius: 12px;
        border: 1px solid #ddd;
        margin-bottom: 40px;
    }

    label.form-label {
        font-weight: 600;
        font-size: 0.95rem;
        color: #222;
    }

    form .btn-primary {
        background-color: #126442 !important;
        border: none;
        font-weight: 600;
        font-size: 1rem;
    }

    form .btn-primary:hover {
        background-color: #0f5537;
    }
    .col-md-4 .btn{
        background-color: #0f5537 !important;
    }

    @media (max-width: 767.98px) {
        form.mb-5 .row > div {
            margin-bottom: 1rem;
        }
    }
</style>
@endpush



@section('content')

<div class="container py-5">
    <form method="GET" action="{{ route('shop.index') }}" class="shop-filter">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name_en }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="search" class="form-label">Search</label>
                <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}">
            </div>

            <div class="col-md-4">
                <button type="submit" class="apply-btn">Apply Filters</button>
            </div>
        </div>
    </form>

<div class="container py-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($products as $product)
            <div class="col">
                <div class="product-card card shadow-sm h-100 p-3">
                    <h5 class="product-title">{{ $product->name_en }}</h5>

                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid mb-3 rounded" alt="{{ $product->name_en }}">
                    @endif

                    <!-- <p class="product-description">{{ $product->description_en }}</p> -->

                    @if($product->sizes->isNotEmpty())
                        <select class="form-select mb-2 size-select" data-product-id="{{ $product->id }}">
                            @foreach($product->sizes as $size)
                                <option value="{{ $size->id }}" data-price="{{ $size->price }}">
                                    {{ $size->value }} 
                                </option>
                            @endforeach
                        </select>

                        <div class="text-muted small" id="price-display-{{ $product->id }}">
                            Price: ${{ number_format($product->sizes->first()->price, 2) }}
                        </div>
                    @endif

                    @if(!empty($product->options) && is_array($product->options))
                    <div class="mb-2">
                        <label for="option-select-{{ $product->id }}" class="form-label">Options</label>
                        <select id="option-select-{{ $product->id }}" class="form-select">
                            @foreach($product->options as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif


                    <button class="add-to-cart-btn mt-3" data-product-id="{{ $product->id }}">
                        Add to Cart
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection


@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    console.log("✅ DOM ready. Starting price binding...");

    document.querySelectorAll('.size-select').forEach(function (select) {
        const productId = select.dataset.productId;
        const priceDisplay = document.getElementById(`price-display-${productId}`);

        function updatePrice() {
            const selectedOption = select.options[select.selectedIndex];
            const price = selectedOption.dataset.price;

            if (price && priceDisplay) {
                const parsedPrice = parseFloat(price);
                if (!isNaN(parsedPrice)) {
                    priceDisplay.textContent = `Price: $${parsedPrice.toFixed(2)}`;
                    console.log(`✔️ Updated price for product ${productId}: $${parsedPrice}`);
                }
            }
        }

        updatePrice();
        select.addEventListener('change', updatePrice);
    });
});
</script>
@endsection

