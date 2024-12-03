@extends('layout.mainlayout')

@section('title', $product->name)

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/view-product.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- Hero Section -->
<div id="hero-section" class="section-unique">
    <div class="content">
        <h1 class="animate__animated animate__fadeIn">
            {{ __('view_product.hero_section.heading', ['product_name' => $product->name]) }}
        </h1>
        <p class="animate__animated animate__fadeIn animate__delay-1s">
            {{ __('view_product.hero_section.description', ['product_description' => $product->description]) }}
        </p>
    </div>
</div>


<!-- Middle Section -->
<div id="middle-section" class="section-unique">
    <div class="split-container">
        <!-- Left Content -->
        <div class="left-side">
            <h2 class="animate__animated animate__fadeIn">
                {{ __('view_product.middle_section.heading') }}
            </h2>
            <p class="animate__animated animate__fadeInUp">
                {{ __('view_product.middle_section.description') }}
            </p>
        </div>

        <!-- Right Content -->
        <div class="right-side"></div>

        <!-- Floating Image -->
        <div id="floatingProductImage" class="floating-image animate__animated animate__zoomIn">
            <img src="{{ $product->images->first() && $product->images->first()->image_url ? asset('storage/' . $product->images->first()->image_url) : asset('assets/images/default-placeholder.png') }}" alt="{{ $product->name }}">
        </div>
    </div>
</div>

<!-- Slider Section -->
<div id="slider-section" class="section-unique">
    <div class="content">
        <h2 class="animate__animated animate__fadeIn">
            {{ __('view_product.slider_section.heading') }}
        </h2>
        <div class="slider">
            <div class="slider-item animate__animated animate__fadeInLeft">
                <i class="icon fas fa-gem"></i>
                <h3>{{ __('view_product.slider_section.features.premium_materials.title') }}</h3>
                <p>{{ __('view_product.slider_section.features.premium_materials.description') }}</p>
            </div>
            <div class="slider-item animate__animated animate__fadeInRight">
                <i class="icon fas fa-award"></i>
                <h3>{{ __('view_product.slider_section.features.exclusive_design.title') }}</h3>
                <p>{{ __('view_product.slider_section.features.exclusive_design.description') }}</p>
            </div>
            <div class="slider-item animate__animated animate__fadeInLeft">
                <i class="icon fas fa-certificate"></i>
                <h3>{{ __('view_product.slider_section.features.certified_quality.title') }}</h3>
                <p>{{ __('view_product.slider_section.features.certified_quality.description') }}</p>
            </div>
        </div>
    </div>
</div>

<style>
/* General Styles */
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    overflow-x: hidden;
}

/* Unique Section Styling */
.section-unique {
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: relative;
    padding: 20px;
}

/* Hero Section */
#hero-section {
    background: linear-gradient(to bottom, #fafafa, #eaeaea);
    text-align: center;
}

#hero-section .content {
    z-index: 2;
    color: #333;
}

#hero-section h1 {
    font-size: 36px;
    font-weight: bold;
}

#hero-section p {
    font-size: 18px;
    margin-top: 10px;
}

/* Middle Section */
#middle-section {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    position: relative;
    overflow: hidden;
}

.split-container {
    display: flex;
    width: 100%;
    height: 100%;
    position: relative;
}

/* Left Side */
.left-side {
    background-color: #f8f9fa;
    width: 70%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
    text-align: center;
}

.left-side h2 {
    font-size: 36px;
    color: #333;
    margin-bottom: 20px;
}

.left-side p {
    font-size: 18px;
    line-height: 1.6;
    color: #555;
}

/* Right Side */
.right-side {
    background-color: #126442;
    width: 30%;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Floating Product Image */
.floating-image {
    position: absolute;
    top: 50%;
    left: 70%; /* Centered at the boundary between left and right */
    transform: translate(-50%, -50%);
    z-index: 10;
    pointer-events: none; /* Ensure the image doesn't interfere with interactions */
    transition: all 1s ease-in-out;
}

.floating-image img {
    width: 300px; /* Increased size */
    height: auto;
    border-radius: 10px; /* Optional: To make the image slightly rounded */
    background: transparent; /* Ensure no background around the image */
    object-fit: cover;
}

/* Slider Section */
#slider-section {
    background: #fff;
    padding: 50px 20px;
    text-align: center;
}

.slider {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.slider-item {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 10px;
    width: 300px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.slider-item h3 {
    font-size: 24px;
}

.slider-item p {
    font-size: 16px;
}

/* Responsive Styles */

/* Tablet */
@media (max-width: 1024px) {
    .left-side {
        width: 70%;
        padding-left: 125px;
        padding-right: 2px;
        align-items: flex-start;
        text-align: left;
    }

    .floating-image {
        left: 70%;
    }

    .left-side h2 {
        margin-left: -104px;
    }

    .left-side p {
        margin-left: -93px;
    }

    .floating-image img {
        width: 250px; /* Adjusted size for tablet */
    }
}

/* Mobile */
@media (max-width: 768px) {
    .split-container {
        flex-direction: column;
    }

    .left-side {
        width: 100%;
        padding: 20px;
        align-items: center;
        text-align: center;
        margin-left: 0;
    }

    .right-side {
        width: 100%;
        height: 100px; /* Adjust height as needed */
    }


    .floating-image {
        left: 50% !important;
        top: 47% !important;
    }


    .floating-image img {
        width: 200px; /* Adjusted size for mobile */
    }

    .left-side h2 {
        font-size: 28px;
        margin-left: 0;
    }

    .left-side p {
        font-size: 16px;
        margin-left: 0;
    }
    #middle-section {
    height: 70vh !important;

}
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollify/1.0.19/jquery.scrollify.min.js"></script>
<script>
    $(function() {
        // Initialize Scrollify
        $.scrollify({
            section: ".section-unique",
            scrollSpeed: 1100,
            before: function(index, sections) {
                // Remove animation classes before the section becomes active
                $('.animate__animated').removeClass('animate__fadeIn animate__fadeInUp animate__fadeInLeft animate__fadeInRight animate__zoomIn');
            },
            after: function(index, sections) {
                // Add animation classes after the section becomes active
                const currentSection = sections[index];
                $(currentSection).find('.animate__animated').addClass('animate__fadeIn');

                // Handle Floating Image Positioning
                const productImage = $('#floatingProductImage');

                if (index === 0) {
                    // Hero Section: Position image at the boundary
                    productImage.css({
                        top: '50%',
                        left: '70%',
                        transform: 'translate(-50%, -50%)'
                    });
                } else if (index === 1) {
                    // Middle Section: Image stays centered on the boundary
                    productImage.css({
                        top: '50%',
                        left: '70%',
                        transform: 'translate(-50%, -50%)'
                    });
                    productImage.addClass('animate__fadeInUp');
                } else if (index === 2) {
                    // Slider Section: Move image to the left side or hide
                    productImage.css({
                        top: '80%',
                        left: '30%',
                        transform: 'translate(-50%, -50%)'
                    });
                    productImage.addClass('animate__fadeInLeft');
                }
            },
            afterResize: function() {
                $.scrollify.update();
            },
            offset : 0,
            interstitialSection : "",
            easing: "easeOutExpo",
            setHeights: true,
            overflowScroll: true,
            updateHash: true,
            touchScroll:true,
            before:function() {}
        });
    });
</script>
@endsection