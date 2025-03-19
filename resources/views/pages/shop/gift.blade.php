@extends('layout.mainlayout')

@section('title', 'Shop')



@section('content')

       

        <!-- Product Grid -->
        
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="product-card card shadow-sm h-100 p-3">
                            <h5 class="product-title mb-2">{{ $product->name}}</h5>

                            @foreach($product->images as $image)
                            <img src="{{ asset('storage/' . $image->image_url) }}">
                            @endforeach


                            <button 
                                class="see-options-btn w-100 btn btn-success" 
                                data-bs-toggle="modal" 
                                data-bs-target="#productOptionsModal"
                                data-product="{{ $product->toJson() }}">
                                See Options 
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $products->withQueryString()->links() }}
            </div>


        



<!-- Product Modal -->
<div class="modal fade" id="productOptionsModal" tabindex="-1" aria-labelledby="productOptionsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productOptionsModalLabel">Product Options</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <h6 id="modal-product-title" class="mb-3 fw-bold"></h6>

    <div class="mb-3">
        <label class="form-label">Size</label>
        <select id="modal-size-select" class="form-select"></select>
        <div class="text-muted mt-2" id="modal-price-display"></div>
    </div>

    <div class="mb-3" id="modal-options-wrapper" style="display: none;">
        <label class="form-label">Options</label>
        <select id="modal-option-select" class="form-select"></select>
    </div>

    <div class="mb-3">
        <label for="modal-qty" class="form-label">Quantity</label>
        <input type="number" id="modal-qty" class="form-control" min="1" value="1">
    </div>

    <button class="btn btn-success w-100" id="add-to-cart-modal-btn">
        Add to Cart
    </button>
</div>

    </div>
  </div>
</div>
@endsection



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/shop.js') }}"></script>

<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">