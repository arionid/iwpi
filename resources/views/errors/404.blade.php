@extends('frontend.layouts.master')
@section('header')
@include('frontend.layouts.header')
@stop
@section('title', __('Not Found'))
@section('content')
  <div class="error-section bg-shape" style="background-image: url(assets/img/error-shape.png);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="thumbnail">
                    <img src="assets/img/404.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="error-section style-01 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="content">
                    <h4 class="title">OPPS! Page not found</h4>
                </div>
                <div class="btn-wrapper desktop-center">
                    <a href="{{ route('/') }}" class="boxed-btn error-btn"><i class="fas fa-arrow-right"></i>Go to home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
