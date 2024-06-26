@extends('frontend.layouts.master')
@section('meta-seo')
<meta name="title" content="Struktur Organisasi Ikatan Wajib Pajak Indonesia" />
<meta name="description"
    content="Struktur Organisasi Ikatan Wajib Pajak Indonesia" />
<meta name="keywords" content="partai x, partaixid, satu bangsa satu kesatuan, partai politik, pemilu 2024" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://iwipi.info/" />
<meta property="og:title" content="Struktur Organisasi Ikatan Wajib Pajak Indonesia" />
<meta property="og:description"
    content="Struktur Organisasi Ikatan Wajib Pajak Indonesia" />
<meta property="og:image" content="{{ asset('meta-seo.webp') }}" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="https://iwipi.info/" />
<meta property="twitter:title" content="Struktur Organisasi Ikatan Wajib Pajak Indonesia" />
<meta property="twitter:description"
    content="Struktur Organisasi Ikatan Wajib Pajak Indonesia" />
<meta property="twitter:image" content="{{ asset('meta-seo.webp') }}" />
@endsection
@section('header')
@include('frontend.layouts.header')
@stop
@section('title', "Struktur Organisasi Ikatan Wajib Pajak Indonesia")
@section('content')

<!--Start Page Header-->
<section class="page-header">
    <div class="shape1 rotate-me"><img src="{{ asset('assets/img/shape/page-header-shape1.png') }}" alt=""></div>
    <div class="shape2 float-bob-x"><img src="{{ asset('assets/img/shape/page-header-shape2.png') }}" alt=""></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>Struktur Organisasi</h2>
            <ul class="thm-breadcrumb">
                <li><a href="{{ route('/') }}"><span class="fa fa-home"></span> Home</a></li>
                <li><i class="icon-right-arrow-angle"></i></li>
                <li class="color-base">Struktur Organisasi</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->
  <!--Start Team One-->
  <section class="team-one py-5">
    <div class="container">
      <img src="{{ asset('assets/img/struktur-organisasi-iwpi.webp') }}" class="img-fluid">
    </div>
</section>
<!--End Team One-->

@endsection
