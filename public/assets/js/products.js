const categoryDropdown = document.getElementById('category-filter');
const searchBar = document.getElementById('search-bar');
const gridView = document.getElementById('grid-view');
const pagination = document.getElementById('pagination');
const defaultPlaceholder = document.getElementById('default-placeholder').src;
const PRODUCTS_URL = appUrl + '/products/data';

const lang = document.documentElement.lang;

let sentence = {
    ar :{
        "error_loading": "خطأ في التحميل",
        "not_found": "لم يتم العثور على منتجات",
    },
    en :{
        "error_loading": "erro while loading",
        "not_found": "no products found",
    },
};

let localSentence = sentence[lang ?? 'en'];
// Parse the category ID from the URL

const urlParams = new URLSearchParams(window.location.search);
const initialCategoryId = urlParams.get('category_id') || '';

// Set dropdown value to the category ID from the URL
categoryDropdown.value = initialCategoryId;

// Global variables to keep track of the current filters
let currentCategoryId = '';
let currentSearchTerm = '';
// Fetch products with given parameters
function fetchProducts(url = PRODUCTS_URL, categoryId = initialCategoryId, searchTerm = '') {
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
            option.selected = option.value == initialCategoryId;
            gridView.innerHTML = `<div class="col-12"><p>${localSentence.error_loading}</p></div>`;
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
            const primaryImage = product.primary_image && product.primary_image.image_url ?
                `${assetBase}${product.primary_image.image_url}` :
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
        gridView.innerHTML = `<div class="col-12"><p>${localSentence.not_found}</p></div>`;
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
    fetchProducts(PRODUCTS_URL, this.value, currentSearchTerm);
});

// Debounce for search input
let debounceTimer;
searchBar.addEventListener('input', function() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        fetchProducts(PRODUCTS_URL, currentCategoryId, this.value);
    }, 300);
});


document.addEventListener('DOMContentLoaded', function() {

    // Initial load
    fetchProducts();
});
