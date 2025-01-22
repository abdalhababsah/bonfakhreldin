@extends('layout.mainlayout')

@section('title', __('products.title'))

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/products.css') }}">
    <!-- Pass assetBase and appUrl to JavaScript -->
    <script>
        const assetBase = "{{ asset('storage') }}/";
        const appUrl = "{{ url('/') }}";
    </script>

    <style>
        .shop-product-section {
            background-image: url('{{ asset('assets/images/pattern-merged.png') }}');
            background-position: right center;
            background-repeat: no-repeat;
            background-size: contain;
            position: relative;
            min-height: 100vh !important;
        }
    </style>

<div class="page-banner-section section">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ route('home') }}">@lang('products.home')</a></li>
            <li>@lang('products.products')</li>
        </ul>
    </div>
</div>


    <!-- Shop Product Section -->
    <div class="shop-product-section section section-padding">
        <div class="container">
            <div class="row">

                <!-- Left Sidebar (Filter Box) -->
                <div class="col-lg-3 col-md-4 mb-4">
                    <div class="filter-box">
                        <h5>@lang('products.filter_title')</h5>
                        <input type="text" id="search-bar" class="form-control" placeholder="@lang('products.search_placeholder')">
                        <select id="category-filter" class="form-select">
                            <option value="">@lang('products.all_categories')</option>
                        </select>
                    </div>
                </div>

                <!-- Right Content (Products and Pagination) -->
                <div class="col-lg-9 col-md-8" >
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
                    </div>
                    <!-- Product Tab End -->

                    <!-- Shop Bottom Bar Start -->
                    <div class="shop-bottom-bar mt-4">
                        <ul class="pagination justify-content-center" id="pagination">
                            <!-- Pagination links will be dynamically updated -->
                        </ul>
                    </div>
                    <!-- Shop Bottom Bar End -->
                </div>
            </div>
        </div>
    </div>

    <!-- Default Placeholder Image -->
    <img id="default-placeholder" src="{{ asset('assets/images/default-placeholder.png') }}" alt="Placeholder" style="display: none;">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryDropdown = document.getElementById('category-filter');
            const searchBar = document.getElementById('search-bar');
            const gridView = document.getElementById('grid-view');
            const pagination = document.getElementById('pagination');
            const defaultPlaceholder = document.getElementById('default-placeholder').src;

            // Global variables to keep track of the current filters
            let currentCategoryId = '';
            let currentSearchTerm = '';
            
            // Parse the category ID from the URL 
            
            const urlParams = new URLSearchParams(window.location.search); 
            const initialCategoryId = urlParams.get('category_id') || ''; 

            // Set dropdown value to the category ID from the URL 
            categoryDropdown.value = initialCategoryId;
            
            // Fetch products with given parameters
            function fetchProducts(url = '/products/data', categoryId = initialCategoryId, searchTerm = '') {
                currentCategoryId = categoryId;
                currentSearchTerm = searchTerm;

                const params = new URLSearchParams();
                if (categoryId) params.append('category_id', categoryId);
                if (searchTerm) params.append('search', searchTerm);

                let fullUrl = url;
                if (params.toString()) {
                    fullUrl += (fullUrl.includes('?') ? '&' : '?') + params.toString();
                }

                gridView.style.display = 'none';

                fetch(fullUrl)
                    .then(response => response.json())
                    .then(data => {
                        populateCategories(data.categories);
                        populateGridView(data.products);
                        populatePagination(data.products);
                        gridView.style.display = 'flex';
                    })
                    .catch(error => {
                        console.error('Error fetching products:', error);
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
                        option.selected = option.value == initialCategoryId
                        categoryDropdown.appendChild(option);
                    });
                }
            }

            // Populate Grid View
            function populateGridView(products) {
                gridView.innerHTML = '';
                if (products.data.length > 0) {
                    products.data.forEach((product, index) => {
                        const animationClass = index % 2 === 0 ? 'animate-slide-in-left' : 'animate-slide-in-right';
                        const primaryImage = product.images && product.images.length > 0 ?
                            `${assetBase}${product.images[0].image_url}` :
                            defaultPlaceholder; 

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
                            </div>
                        `;
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
                            const isPrev = link.label.toLowerCase().includes('previous') || link.label.includes('&laquo;');
                            const isNext = link.label.toLowerCase().includes('next') || link.label.includes('&raquo;');

                            let icon = '';
                            if (isPrev) {
                                icon = '<i class="sli-arrow-left"></i>';
                            } else if (isNext) {
                                icon = '<i class="sli-arrow-right"></i>';
                            } else {
                                icon = link.label;
                            }

                            const liClass = `page-item ${link.active ? 'active' : ''} ${(!link.url && (isPrev || isNext)) ? 'disabled' : ''}`;
                            const aClass = "page-link";

                            pagination.innerHTML += `
                                <li class="${liClass}">
                                    <a href="#" data-url="${link.url || '#'}" class="${aClass}">${icon}</a>
                                </li>`;
                        } else {
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
                document.querySelectorAll('#pagination .page-link').forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const url = this.getAttribute('data-url');
                        if (url && url !== '#') {
                            // Fetch products maintaining current filters
                            fetchProducts(url, currentCategoryId, currentSearchTerm);
                        }
                    });
                });
            }

            // Event listener for category filter
            categoryDropdown.addEventListener('change', function() {
                fetchProducts('/products/data', this.value, currentSearchTerm);
            });

            // Debounce for search input
            let debounceTimer;
            searchBar.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    fetchProducts('/products/data', currentCategoryId, this.value);
                }, 300);
            });

            // Initial load
            fetchProducts();
        });
    </script>
@endsection