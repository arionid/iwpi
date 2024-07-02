@extends('frontend.layouts.master')
@section('meta-seo')
<meta name="robots" content="noindex">
@endsection
@section('header')
@include('frontend.layouts.header')
@stop
@section('title', __('Not Found'))
@section('content')
<section class="page-header">
    <div class="shape1 rotate-me"><img src="{{ asset('assets/img/shape/page-header-shape1.png') }}" alt=""></div>
    <div class="shape2 float-bob-x"><img src="{{ asset('assets/img/shape/page-header-shape2.png') }}" alt=""></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>Page Not Found</h2>
            <ul class="thm-breadcrumb">
                <li><a href="{{ route('/') }}"><span class="fa fa-home"></span> Home</a></li>
                <li><i class="icon-right-arrow-angle"></i></li>
                <li class="color-base">Page Not Found</li>
            </ul>
        </div>
    </div>
</section>

@endsection
