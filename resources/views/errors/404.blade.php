@extends('layout.mainlayout')

@section('title', 404)

@section('content')

    <x-breadcrumb />
    <div class="container">
        <div class="row m-5">
            <div class="col-sm-5 text-right">
                <h1 class="text-success text-center" style=" font-size: 100px;">404</h1>
                {{-- <img src="{{url('images/404.png')}}" alt="">// i'll added if i find suitable one --}}
            </div>
            <div class="col-sm-6">
                <h2 class="page_title">{{__('We are')}} <span>{{__('Sorry')}}!</span><br> {{__('Your Page cannot be found')}}!</h2>
                <p class="page_description">{{__('Go back')}} {{__('to')}} <br>
                    <a traget="_blank" href="{{url('/')}}">{{__('our homepage')}}</a>.
                </p>

            </div>
            {{-- <div class="col-12">
                <div class="align-items-center justify-content-center text-center">
                    <img src="{{url('assets/images/empty-cart.png')}}" alt="empty cart" class="img-fluid me-3" style="width: 200px;">
                    <h5 class="m-4">{{ $message }}.</h5>
                    <a href="{{ url('/shop') }}" class="btn btn-create">{{ __('Go shopping') }}</a>
                </div>
            </div> --}}
        </div>
    </div>

@endsection