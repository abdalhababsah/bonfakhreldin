@extends('layout.mainlayout')

@section('title', __('Shop'))

<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">

@section('content')
<x-breadcrumb />
<div class="shop-product-section section section-padding">
    <div class="container">

        <!-- Shop Top Bar Start -->
        <div class="shop-top-bar">

            <div class="shop-top-bar-item">
                <label for="SortBy">Sort by :</label>
                <select name="SortBy" id="SortBy">
                    <option value="manual">Featured</option>
                    <option value="best-selling">Best Selling</option>
                    <option value="title-ascending">Alphabetically, A-Z</option>
                    <option value="title-descending">Alphabetically, Z-A</option>
                    <option value="price-ascending">Price, low to high</option>
                    <option value="price-descending">Price, high to low</option>
                    <option value="created-descending">Date, new to old</option>
                    <option value="created-ascending">Date, old to new</option>
                </select>
            </div>

            <div class="shop-top-bar-item">
                <p>Showing 1 - 12 of 25 result</p>
            </div>

            <div class="shop-top-bar-item">
                <label for="paginateBy">Show :</label>
                <select name="paginateBy" id="paginateBy">
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12" selected="">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    <option value="32">32</option>
                    <option value="33">33</option>
                    <option value="34">34</option>
                    <option value="35">35</option>
                    <option value="36">36</option>
                    <option value="37">37</option>
                    <option value="38">38</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                    <option value="44">44</option>
                    <option value="45">45</option>
                    <option value="46">46</option>
                    <option value="47">47</option>
                    <option value="48">48</option>
                    <option value="49">49</option>
                    <option value="50">50</option>
                </select>
            </div>

            <div class="shop-top-bar-item">
                <div class="nav list-grid-toggle" role="tablist">
                    <button class="active" data-bs-toggle="tab" data-bs-target="#product-grid" aria-selected="true" role="tab"><i class="sli-grid"></i></button>
                    <button data-bs-toggle="tab" data-bs-target="#product-list" aria-selected="false" tabindex="-1" role="tab"><i class="sli-menu"></i></button>
                </div>
            </div>

        </div>
        <!-- Shop Top Bar End -->

        <!-- Product Tab Start -->
        <div class="tab-content" id="shopProductTabContent">
            <div class="tab-pane fade show active" id="product-grid" role="tabpanel">
                <div class="row row-cols-lg-3 row-cols-sm-2 row-cols-1 mb-n6">

                    <div class="col mb-6">
                        <div class="product">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-1.jpg" alt="House Coffee Original" width="268" height="306"></a>


                                <div class="product-badge-left">
                                    <span class="product-badge-new">new</span>
                                </div>

                                <div class="product-badge-right">
                                    <span class="product-badge-sale">sale</span>
                                    <span class="product-badge-sale">-15%</span>

                                </div>
                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to cart"><i class="sli-bag"></i></button>
                                </div>

                                <div class="product-variation">
                                    <div class="product-variation-type">
                                        <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="./assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="./assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="./assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                    </div>
                                </div>

                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">House Coffee Original</a></h5>
                                <div class="product-price"><del>$130.00</del>$110.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 90%;"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-2.jpg" alt="Medium Roast Ground Coffee" width="268" height="306"></a>



                                <div class="product-badge-right">
                                    <span class="product-badge-sale">sale</span>
                                    <span class="product-badge-sale">-10%</span>

                                </div>
                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to cart"><i class="sli-bag"></i></button>
                                </div>

                                <div class="product-variation">
                                    <div class="product-variation-type">
                                        <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="./assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="./assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="./assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                    </div>
                                </div>

                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Medium Roast Ground Coffee</a></h5>
                                <div class="product-price"><del>$21.00</del>$19.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 80%;"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-3.jpg" alt="Premium Roast Coffee" width="268" height="306"></a>

                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to cart"><i class="sli-bag"></i></button>
                                </div>

                                <div class="product-variation">
                                    <div class="product-variation-type">
                                        <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="./assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="./assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="./assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                    </div>
                                </div>

                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Premium Roast Coffee</a></h5>
                                <div class="product-price">$39.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 100%;"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-4.jpg" alt="Signature Blend Roast Coffee" width="268" height="306"></a>



                                <div class="product-badge-right">
                                    <span class="product-badge-sale">sale</span>
                                    <span class="product-badge-sale">-11%</span>

                                </div>
                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to cart"><i class="sli-bag"></i></button>
                                </div>

                                <div class="product-variation">
                                    <div class="product-variation-type">
                                        <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="./assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="./assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="./assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                    </div>
                                </div>
                                <div class="product-countdown" data-countdown="2023/06/01"><div class="countdown-item"><span class="number">00</span><span class="label">Days</span></div><div class="countdown-item"><span class="number">00</span><span class="label">Hours</span></div><div class="countdown-item"><span class="number">00</span><span class="label">Min</span></div><div class="countdown-item"><span class="number">00</span><span class="label">Sec</span></div></div>
                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Signature Blend Roast Coffee</a></h5>
                                <div class="product-price"><del>$110.00</del>$99.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 75%;"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-5.jpg" alt="Supreme Dark Roast Coffee" width="268" height="306"></a>


                                <div class="product-badge-left">
                                    <span class="product-badge-new">new</span>
                                </div>

                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to cart"><i class="sli-bag"></i></button>
                                </div>

                                <div class="product-variation">
                                    <div class="product-variation-type">
                                        <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="./assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="./assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="./assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                    </div>
                                </div>

                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Supreme Dark Roast Coffee</a></h5>
                                <div class="product-price">$80.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 90%;"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-6.jpg" alt="Classic Coffee Roast" width="268" height="306"></a>



                                <div class="product-badge-right">
                                    <span class="product-badge-sale">sale</span>
                                    <span class="product-badge-sale">-18%</span>

                                </div>
                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to cart"><i class="sli-bag"></i></button>
                                </div>

                                <div class="product-variation">
                                    <div class="product-variation-type">
                                        <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="./assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="./assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="./assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                    </div>
                                </div>

                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Classic Coffee Roast</a></h5>
                                <div class="product-price">$39.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 75%;"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-7.jpg" alt="Medium Roast Ground Coffee" width="268" height="306"></a>



                                <div class="product-badge-right">

                                    <span class="product-badge-soldout">soldout</span>
                                </div>
                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to cart"><i class="sli-bag"></i></button>
                                </div>


                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Medium Roast Ground Coffee</a></h5>
                                <div class="product-price"><del>$29.00</del>$19.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 90%;"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-8.jpg" alt="Premium Roast Coffee" width="268" height="306"></a>

                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to cart"><i class="sli-bag"></i></button>
                                </div>


                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Premium Roast Coffee</a></h5>
                                <div class="product-price">$50.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 80%;"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-9.jpg" alt="Supreme Dark Roast Coffee" width="268" height="306"></a>



                                <div class="product-badge-right">

                                    <span class="product-badge-soldout">soldout</span>
                                </div>
                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                    <button class="product-action-btn" data-tooltip-text="Add to cart"><i class="sli-bag"></i></button>
                                </div>

                                <div class="product-variation">
                                    <div class="product-variation-type">
                                        <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="./assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="./assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="./assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                    </div>
                                </div>

                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Supreme Dark Roast Coffee</a></h5>
                                <div class="product-price"><del>$75.00</del>$55.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 65%;"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="product-list" role="tabpanel">
                <div class="row row-cols-md-1 row-cols-sm-2 row-cols-1 gy-4">

                    <div class="col mb-6">
                        <div class="product product-list">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-1.jpg" alt="House Coffee Original" width="268" height="306"></a>


                                <div class="product-badge-left">
                                    <span class="product-badge-new">new</span>
                                </div>

                                <div class="product-badge-right">
                                    <span class="product-badge-sale">sale</span>
                                    <span class="product-badge-sale">-15%</span>

                                </div>
                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                </div>

                                <div class="product-variation">
                                    <div class="product-variation-type">
                                        <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="./assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="./assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="./assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                    </div>
                                </div>

                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">House Coffee Original</a></h5>
                                <p class="product-excerpt">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,</p>
                                <div class="product-price"><del>$130.00</del>$110.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 90%;"></span></span>
                                </div>
                                <div class="product-action position-static">
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn"><i class="sli-basket-loaded"></i> Add to Cart</button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product product-list">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-2.jpg" alt="Medium Roast Ground Coffee" width="268" height="306"></a>



                                <div class="product-badge-right">
                                    <span class="product-badge-sale">sale</span>
                                    <span class="product-badge-sale">-10%</span>

                                </div>
                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                </div>

                                <div class="product-variation">
                                    <div class="product-variation-type">
                                        <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="./assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="./assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="./assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                    </div>
                                </div>

                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Medium Roast Ground Coffee</a></h5>
                                <p class="product-excerpt">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,</p>
                                <div class="product-price"><del>$21.00</del>$19.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 80%;"></span></span>
                                </div>
                                <div class="product-action position-static">
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn"><i class="sli-basket-loaded"></i> Add to Cart</button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product product-list">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-3.jpg" alt="Premium Roast Coffee" width="268" height="306"></a>

                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                </div>

                                <div class="product-variation">
                                    <div class="product-variation-type">
                                        <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="./assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="./assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="./assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                    </div>
                                </div>

                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Premium Roast Coffee</a></h5>
                                <p class="product-excerpt">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,</p>
                                <div class="product-price">$39.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 100%;"></span></span>
                                </div>
                                <div class="product-action position-static">
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn"><i class="sli-basket-loaded"></i> Add to Cart</button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product product-list">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-4.jpg" alt="Signature Blend Roast Coffee" width="268" height="306"></a>



                                <div class="product-badge-right">
                                    <span class="product-badge-sale">sale</span>
                                    <span class="product-badge-sale">-11%</span>

                                </div>
                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                </div>

                                <div class="product-variation">
                                    <div class="product-variation-type">
                                        <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="./assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="./assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="./assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                    </div>
                                </div>
                                <div class="product-countdown" data-countdown="2023/06/01"><div class="countdown-item"><span class="number">00</span><span class="label">Days</span></div><div class="countdown-item"><span class="number">00</span><span class="label">Hours</span></div><div class="countdown-item"><span class="number">00</span><span class="label">Min</span></div><div class="countdown-item"><span class="number">00</span><span class="label">Sec</span></div></div>
                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Signature Blend Roast Coffee</a></h5>
                                <p class="product-excerpt">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,</p>
                                <div class="product-price"><del>$110.00</del>$99.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 75%;"></span></span>
                                </div>
                                <div class="product-action position-static">
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn"><i class="sli-basket-loaded"></i> Add to Cart</button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product product-list">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-5.jpg" alt="Supreme Dark Roast Coffee" width="268" height="306"></a>


                                <div class="product-badge-left">
                                    <span class="product-badge-new">new</span>
                                </div>

                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                </div>

                                <div class="product-variation">
                                    <div class="product-variation-type">
                                        <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="./assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="./assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="./assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                    </div>
                                </div>

                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Supreme Dark Roast Coffee</a></h5>
                                <p class="product-excerpt">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,</p>
                                <div class="product-price">$80.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 90%;"></span></span>
                                </div>
                                <div class="product-action position-static">
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn"><i class="sli-basket-loaded"></i> Add to Cart</button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product product-list">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-6.jpg" alt="Classic Coffee Roast" width="268" height="306"></a>



                                <div class="product-badge-right">
                                    <span class="product-badge-sale">sale</span>
                                    <span class="product-badge-sale">-18%</span>

                                </div>
                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                </div>

                                <div class="product-variation">
                                    <div class="product-variation-type">
                                        <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="./assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="./assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="./assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                    </div>
                                </div>

                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Classic Coffee Roast</a></h5>
                                <p class="product-excerpt">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,</p>
                                <div class="product-price">$39.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 75%;"></span></span>
                                </div>
                                <div class="product-action position-static">
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn"><i class="sli-basket-loaded"></i> Add to Cart</button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product product-list">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-7.jpg" alt="Medium Roast Ground Coffee" width="268" height="306"></a>



                                <div class="product-badge-right">

                                    <span class="product-badge-soldout">soldout</span>
                                </div>
                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                </div>


                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Medium Roast Ground Coffee</a></h5>
                                <p class="product-excerpt">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,</p>
                                <div class="product-price"><del>$29.00</del>$19.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 90%;"></span></span>
                                </div>
                                <div class="product-action position-static">
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn"><i class="sli-basket-loaded"></i> Add to Cart</button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product product-list">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-8.jpg" alt="Premium Roast Coffee" width="268" height="306"></a>

                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                </div>


                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Premium Roast Coffee</a></h5>
                                <p class="product-excerpt">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,</p>
                                <div class="product-price">$50.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 80%;"></span></span>
                                </div>
                                <div class="product-action position-static">
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn"><i class="sli-basket-loaded"></i> Add to Cart</button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-6">
                        <div class="product product-list">
                            <div class="product-thumb">
                                <a href="product-details.html" class="product-image"><img loading="lazy" src="./assets/images/products/product-9.jpg" alt="Supreme Dark Roast Coffee" width="268" height="306"></a>



                                <div class="product-badge-right">

                                    <span class="product-badge-soldout">soldout</span>
                                </div>
                                <div class="product-action">
                                    <button class="product-action-btn" data-tooltip-text="Quick View" data-bs-toggle="modal" data-bs-target="#exampleProductModal"><i class="sli-magnifier"></i></button>
                                </div>

                                <div class="product-variation">
                                    <div class="product-variation-type">
                                        <button class="product-variation-type-btn" data-tooltip-text="White"><img loading="lazy" src="./assets/images/products/variation/type/type-1.jpg" alt="white" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Gold"><img loading="lazy" src="./assets/images/products/variation/type/type-2.jpg" alt="gold" width="23" height="23"></button>
                                        <button class="product-variation-type-btn" data-tooltip-text="Black"><img loading="lazy" src="./assets/images/products/variation/type/type-3.jpg" alt="black" width="23" height="23"></button>
                                    </div>
                                </div>

                            </div>
                            <div class="product-content">

                                <h5 class="product-title"><a href="product-details.html">Supreme Dark Roast Coffee</a></h5>
                                <p class="product-excerpt">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,</p>
                                <div class="product-price"><del>$75.00</del>$55.00</div>
                                <div class="product-rating">
                                    <span class="product-rating-bg"><span class="product-rating-active" style="width: 65%;"></span></span>
                                </div>
                                <div class="product-action position-static">
                                    <button class="product-action-btn" data-tooltip-text="Add to wishlist"><i class="sli-heart"></i></button>
                                    <button class="product-action-btn"><i class="sli-basket-loaded"></i> Add to Cart</button>
                                    <button class="product-action-btn" data-tooltip-text="Compare"><i class="sli-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Tab End -->

        <!-- Shop Bottom Bar Start -->
        <div class="shop-bottom-bar">
            <ul class="pagination">
                <li class="disabled"><a href="#prev"><i class="sli-arrow-left"></i></a></li>
                <li><a class="active" href="#page=1">1</a></li>
                <li><a href="#page=2">2</a></li>
                <li><a href="#page=3">3</a></li>
                <li><a href="#next"><i class="sli-arrow-right"></i></a></li>
            </ul>
        </div>
        <!-- Shop Bottom Bar End -->

    </div>
</div>

<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold display-6">{{__('Shop by Category')}}</h2>
    <div class="row g-5 justify-content-center">
    @foreach ($categories as $category)
        <div class="col-md-6 d-flex justify-content-center">
        @if ($category->children->isNotEmpty())
            <div class="w-100">
            <div class="category-box elegant-hover shadow-lg"
                 style="background-image: url('{{ asset($category->image ?:'assets/images/categories/'. $category->slug .'.jpg') }}')">
                <h2 class="fw-bold">{{ $category->name }}</h2>
            </div>
            <ul class="list-group mt-3">
                @foreach ($category->children as $child)
                <li class="list-group-item">
                    <a href="{{ url('shop', $child->slug) }}" class="text-decoration-none">
                    {{ $child->name }}
                    </a>
                </li>
                @endforeach
            </ul>
            </div>
        @else
            <a href="{{ url('shop', $category->slug) }}" class="text-decoration-none w-100">
            <div class="category-box elegant-hover shadow-lg"
                 style="background-image: url('{{ asset($category->image ?:'assets/images/categories/'. $category->slug .'.jpg') }}')">
                <h2 class="fw-bold">{{ $category->name }}</h2>
            </div>
            </a>
        @endif
        </div>
    @endforeach
    </div>
</div>
@endsection
