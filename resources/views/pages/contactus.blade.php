@extends('layout.mainlayout')

@section('title', __('contactUs.title'))

@section('content')

    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">{{ __('contactUs.home') }}</a></li>
                <li>{{ __('contactUs.contact_us') }}</li>
            </ul>
        </div>
    </div>
    <!-- Page Banner Section End -->

    <!-- Contact Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="row row-cols-md-2 row-cols-1 g-4">
                <!-- Contact Info Section -->
                <div class="col">
                    <div class="block-title">
                        <h2 class="sub-title">{{ __('contactUs.keep_in_touch') }}</h2>
                    </div>
                    <ul class="contact-info">
                        <li><i class="sli-location-pin"></i> {{ __('contactUs.address') }}</li>
                        <li><i class="sli-envelope"></i> {{ __('contactUs.email') }}</li>
                        <li><i class="sli-phone"></i> {{ __('contactUs.phone') }}</li>
                    </ul>
                </div>

                <!-- Contact Form Section -->
                <div class="col">
                    <div>
                        <form action="{{ route('contactUs.send') }}" method="POST">
                            @csrf
                            <div class="row row-cols-1 g-4">
                                <!-- Name Field -->
                                <div class="col-sm-6 col-md-12 col-lg-6 col">
                                    <input class="form-field" name="name" type="text"
                                        placeholder="{{ __('contactUs.name') }}" required>
                                </div>
                                <!-- Email Field -->
                                <div class="col-sm-6 col-md-12 col-lg-6 col">
                                    <input class="form-field" name="email" type="email"
                                        placeholder="{{ __('contactUs.email_placeholder') }}" required>
                                </div>
                                <!-- Subject Field -->
                                <div class="col">
                                    <input class="form-field" name="subject" type="text"
                                        placeholder="{{ __('contactUs.subject') }}" required>
                                </div>
                                <!-- Message Field -->
                                <div class="col">
                                    <textarea class="form-field" name="message" placeholder="{{ __('contactUs.message') }}" required></textarea>
                                </div>
                                <!-- Submit Button -->
                                <div class="col">
                                    <button class="btn btn-contact rounded-0 w-100" type="submit">
                                        {{ __('contactUs.send_message') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Success/Error Message Display -->
                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Section End -->

    <!-- Contact Map Section Start -->
    <div class="section section-padding pt-0">
        <div class="container">
            <div class="ratio ratio-21x9">
                <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3387.0638684418373!2d35.963764!3d31.904862!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzHCsDU0JzE3LjUiTiAzNcKwNTcnNDkuNiJF!5e0!3m2!1sen!2sjo!4v1734873057801!5m2!1sen!2sjo" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <!-- Contact Map Section End -->

@endsection
