@extends('frontend.layouts.master')
@section('meta-seo')
<meta name="title" content="Arti Logo Ikatan Wajib Pajak Indonesia" />
<meta name="description"
    content="Arti Logo Ikatan Wajib Pajak Indonesia" />
<meta name="keywords" content="IWPI, Ikatan Wajib Pajak Indonesia, Wajib Pajak, Asosiasi Wajib Pajak, Perkumpulan Wajib Pajak, Pajak Indonesia, DJP, Melawan DJP, Pajak Transparan, Organisasi Pajak" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://iwipi.info/" />
<meta property="og:title" content="Arti Logo Ikatan Wajib Pajak Indonesia" />
<meta property="og:description"
    content="Arti Logo Ikatan Wajib Pajak Indonesia" />
<meta property="og:image" content="{{ asset('meta-seo.webp') }}" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="https://iwipi.info/" />
<meta property="twitter:title" content="Arti Logo Ikatan Wajib Pajak Indonesia" />
<meta property="twitter:description"
    content="Arti Logo Ikatan Wajib Pajak Indonesia" />
<meta property="twitter:image" content="{{ asset('meta-seo.webp') }}" />
@endsection
@section('header')
@include('frontend.layouts.header')
<style>
    .text {
        text-align: justify;
    }
</style>
@stop
@section('title', "Arti Logo Ikatan Wajib Pajak Indonesia")
@section('content')

<!--Start Page Header-->
<section class="page-header">
    <div class="shape1 rotate-me"><img src="{{ asset('assets/img/shape/page-header-shape1.png') }}" alt=""></div>
    <div class="shape2 float-bob-x"><img src="{{ asset('assets/img/shape/page-header-shape2.png') }}" alt=""></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>Arti Logo</h2>
            <ul class="thm-breadcrumb">
                <li><a href="{{ route('/') }}"><span class="fa fa-home"></span> Home</a></li>
                <li><i class="icon-right-arrow-angle"></i></li>
                <li class="color-base">Arti Logo</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->
  <!--Start About Three-->
  <section class="about-three">
    <div class="about-three__shape1 float-bob-y">
        <img src="{{ asset('assets/img/shape/about-three__shape1.png') }}" alt="shapes">
    </div>
    <div class="about-three__shape2">
        <img src="{{ asset('assets/img/shape/about-three__shape2.png') }}" alt="shapes">
    </div>
    <div class="about-three__shape3">
        <img src="{{ asset('assets/img/shape/about-three__shape3.png') }}" alt="shapes">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="about-three__content">
                    <div class="sec-title-four">
                        <div class="sub-title">
                            <h4>Arti Logo Organisasi</h4>
                        </div>
                        <h2>
                            Arti Logo<br> Organisasi Ikatan Wajib Pajak Indonesia
                        </h2>
                    </div>
                    <div class="text">
                <p>
                    Tanda gambar ini mempunyai simbol orang yang sedang merangkul, yang jika dibuat secara geometris, menimbulkan makna solid, kerjasama, persahabatan, saling membantu….. Hal ini sesuai dengan visi dan misi wadah perkumpulan ini dibuat.
Makna dan bentuk logo yang geometris dapat dipergunakan untuk menyampaikan pesan yang kuat tentang ketelitian, kestabilan, dan struktur dalam bidang perpajakan. Dalam logo ini bentuk persegi mencerminkan ketegasan dalam penegakan aturan, yang itu sangat penting dalam wadah perkumpulan ini.

Elemen geometris dalam logo ini menciptakan kesan bahwa wadah perkumpulan pajak ini berdiri tegak, kuat, dan siap membantu dalam mengelola aspek-aspek keuangan yang kompleks dan keahlian yang terukur.

Warna-warna yang dipilih mungkin mengandung nuansa profesionalisme, seperti biru tua untuk menegaskan kredibilitas dan keadaan terkait pajak.

                </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="about-three__img-box">
                    <ul>
                        <li class="wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <!--Single About Three Img-->
                            <div class="single-about-three__img-box">
                            </div>
                            <!--End About Three Img-->
                        </li>

                        <li class="wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <!--Single About Three Img-->
                            <div class="single-about-three__img-box">
                                <img src="{{ asset('part-logo.webp') }}" alt="image">
                            </div>
                            <!--End About Three Img-->
                        </li>
                    </ul>

                    <div class="about-three__img-box-bottom wow fadeInLeft" data-wow-delay="0ms"
                        data-wow-duration="1500ms">
                        <!--Single About Three Img-->
                        <div class="single-about-three__img-box">
                            <img src="{{ asset('logo-iwpi-lg.webp') }}" alt="Logo IWPI">
                        </div>
                        <!--End About Three Img-->
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--End About Three-->

@endsection
