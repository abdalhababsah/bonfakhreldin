@extends('layout.mainlayout')

@section('title', __('products.title'))

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/products.css') }}">
    <!-- Pass assetBase and appUrl to JavaScript -->
    <script>
        const assetBase = "{{ asset('storage') }}/";
        const appUrl = "{{ url('/') }}";
    </script>

    <!-- Page Banner Section -->
    <div class="page-banner-section section">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Products</li>
            </ul>
        </div>
    </div>

    <!-- Shop Product Section -->
    <div class="shop-product-section section section-padding">
        <div class="container">

            <!-- Shop Top Bar Start -->
            <div class="shop-top-bar">

                <div class="shop-top-bar-item d-flex flex-column">
                    <select id="category-filter" class="form-select d-inline-block" style="width: 300px; margin-top: 10px;">
                        <option value="">@lang('products.all_categories')</option>
                    </select>
                </div>

            </div>
            <!-- Shop Top Bar End -->

            <!-- Product Tab Start -->
            <div class="tab-content" id="shopProductTabContent">
                <!-- Grid View -->
                <div class="tab-pane fade show active" id="product-grid">
                    <!-- Loader -->
                    <div id="loader" class="text-center my-5" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="row row-cols-lg-3 row-cols-sm-2 row-cols-1 g-4 mb-n6" id="grid-view">

                        <!-- Dynamic Products will be injected here -->

                    </div>
                </div>
                <!-- List View Removed -->
            </div>
            <!-- Product Tab End -->

            <!-- Shop Bottom Bar Start -->
            <div class="shop-bottom-bar">
                <ul class="pagination justify-content-center" id="pagination">
                    <!-- Pagination links will be dynamically updated -->
                </ul>
            </div>
            <!-- Shop Bottom Bar End -->

        </div>
    </div>

    <!-- Default Placeholder Image -->
    <img id="default-placeholder" src="{{ asset('assets/images/default-placeholder.png') }}" alt="Placeholder"
        style="display: none;">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryDropdown = document.getElementById('category-filter');
            const gridView = document.getElementById('grid-view');
            const pagination = document.getElementById('pagination');
            const loader = document.getElementById('loader'); // Loader element
            const defaultPlaceholder = document.getElementById('default-placeholder').src;

            // Fetch products (initial load and filtered)
            function fetchProducts(url = '/products/data', categoryId = '') {
                const fullUrl = categoryId ? `${url}?category_id=${categoryId}` : url;

                // Show loader before fetching
                loader.style.display = 'block';
                gridView.style.display = 'none'; // Hide grid view while loading

                fetch(fullUrl)
                    .then(response => response.json())
                    .then(data => {
                        populateCategories(data.categories);
                        populateGridView(data.products);
                        populatePagination(data.products);
                        // Hide loader after fetching
                        loader.style.display = 'none';
                        gridView.style.display = 'flex'; // Show grid view
                    })
                    .catch(error => {
                        console.error('Error fetching products:', error);
                        // Hide loader and show error message
                        loader.style.display = 'none';
                        gridView.innerHTML = `<div class="col-12"><p>@lang('products.error_loading_products')</p></div>`;
                    });
            }

            // Populate categories dropdown
            function populateCategories(categories) {
                if (categoryDropdown.options.length === 1) { // Only populate if not already done
                    categories.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.id;
                        option.textContent = category.name;
                        categoryDropdown.appendChild(option);
                    });
                }
            }

            // Populate Grid View
            function populateGridView(products) {
                gridView.innerHTML = '';
                if (products.data.length > 0) {
                    products.data.forEach((product, index) => {
                        // Determine animation class
                        const animationClass = index % 2 === 0 ? 'animate-slide-in-left' :
                            'animate-slide-in-right';

                        // Get the primary image URL if available
                        const primaryImage = product.images && product.images.length > 0 ?
                            `${assetBase}${product.images[0].image_url}` :
                            defaultPlaceholder; // Fallback to a placeholder image



                        // Generate the product card HTML
                        const productHtml = `
                <div class="col products-card ${animationClass}">
                    <div class="product">
                        <div class="product-thumb position-relative">
                            <a href="${appUrl}/product-details/${product.slug}" class="product-image">
                                <img loading="lazy" src="${primaryImage}" alt="${product.name}" class="img-fluid fixed-size-image">
                            </a>

                        </div>
                        <div class="product-content">
                            <h5 class="product-title">
                                <a href="${appUrl}/product-details/${product.slug}">${product.name}</a>
                            </h5>
                            <p class="product-description">${product.description}</p>
                        </div>
                    </div>
                </div>`;

                        gridView.insertAdjacentHTML('beforeend', productHtml);
                    });
                } else {
                    gridView.innerHTML = `<div class="col-12"><p>@lang('products.no_products_found')</p></div>`;
                }
            }

            // Populate pagination links
            function populatePagination(products) {
                pagination.innerHTML = '';
                if (products.links && products.links.length > 0) {
                    products.links.forEach(link => {
                        if (link.url) {
                            // Determine if the link is Previous or Next
                            const isPrev = link.label.toLowerCase().includes('previous') || link.label
                                .includes('&laquo;');
                            const isNext = link.label.toLowerCase().includes('next') || link.label.includes(
                                '&raquo;');

                            // Define arrow icons (using SLI icons as per your existing code)
                            let icon = '';
                            if (isPrev) {
                                icon = '<i class="sli-arrow-left"></i>';
                            } else if (isNext) {
                                icon = '<i class="sli-arrow-right"></i>';
                            } else {
                                // For numbered pages
                                icon = link.label;
                            }

                            // Add appropriate classes based on link type
                            const liClass =
                                `page-item ${link.active ? 'active' : ''} ${(!link.url && (isPrev || isNext)) ? 'disabled' : ''}`;
                            const aClass = "page-link";

                            pagination.innerHTML += `
                        <li class="${liClass}">
                            <a href="#" data-url="${link.url || '#'}" class="${aClass}">${icon}</a>
                        </li>`;
                        } else {
                            // For 'Previous' or 'Next' buttons without URL
                            pagination.innerHTML += `
                        <li class="page-item disabled">
                            <span class="page-link">${link.label}</span>
                        </li>`;
                        }
                    });
                }
                attachPaginationEvents();
            }

            // Attach click events to pagination links
            function attachPaginationEvents() {
                document.querySelectorAll('.pagination-link, .page-link').forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const url = this.getAttribute('data-url');
                        if (url && url !== '#') {
                            fetchProducts(url, categoryDropdown.value);
                        }
                    });
                });
            }

            // Event listener for category filter
            categoryDropdown.addEventListener('change', function() {
                fetchProducts('/products/data', this.value);
            });

            // Initial load
            fetchProducts();
        });
    </script>

    <style>
        .shop-product-section {
            background-image: url('{{ asset('assets/images/pattern-merged.png') }}');
            background-position: right center;
            /* Positions the image to the right and vertically centered */
            background-repeat: no-repeat;
            /* Prevents the image from repeating */
            background-size: contain;
            /* Scales the image to fit the container while maintaining aspect ratio */
            /* padding-right: 50px; */
            /* Adds space on the right to prevent content overlap with the background image */
            position: relative;
            /* Establishes a positioning context for pseudo-elements */
        }
    </style>
@endsection
