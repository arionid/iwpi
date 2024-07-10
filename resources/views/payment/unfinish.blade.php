@extends('frontend.layouts.master')
@section('meta-seo')
<meta name="robots" content="noindex,nofollow" />
<!-- Primary Meta Tags -->
<meta name="title" content="Status Pembayaran - Ikatan Wajib Pajak Indonesia" />
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://iwipi.info/" />
<meta property="og:title" content="Status Pembayaran - Ikatan Wajib Pajak Indonesia" />
<meta property="og:description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta property="og:image" content="{{ asset('meta-seo.webp') }}" />
<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="https://iwipi.info/" />
<meta property="twitter:title" content="Status Pembayaran - Ikatan Wajib Pajak Indonesia" />
<meta property="twitter:description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta property="twitter:image" content="{{ asset('meta-seo.webp') }}" />
@endsection
@section('header')
@include('frontend.layouts.header')
<style>
    .about-one {
        padding-top: 8rem;
        padding-bottom: 8rem;
    }

    .about-one__overlay-box {
        background-color: var(--thm-secondary) !important;
    }
</style>
@stop
@section('title', 'Cara Pembayaran - Ikatan Wajib Pajak Indonesia')
@section('content')
<!--Start Page Header-->
<section class="page-header">
    <div class="shape1 rotate-me"><img src="{{ asset('assets/img/shape/page-header-shape1.png') }}" alt=""></div>
    <div class="shape2 float-bob-x"><img src="{{ asset('assets/img/shape/page-header-shape2.png') }}" alt=""></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>Menuggu Pembayaran</h2>
            <ul class="thm-breadcrumb">
                <li><a href="{{ route('/') }}"><span class="fa fa-home"></span> Home</a></li>
                <li><i class="icon-right-arrow-angle"></i></li>
                <li class="color-base">Pembayaran Layanan</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->
<!--Start About One-->
<section class="about-one">
    <div class="container">
        <div class="cta-two testmonials pt-1 mb-1">
            <div class="container">
                <div class="cta-two__inner">
                    <div class="cta-two__inner-bg" style="background-image: url({{ asset('assets/img/pattern/cta-two__parttern1.png') }});">
                    </div>
                    <div class="cta-two__content">
                        <h2>Menuggu Pembayaran</h2>
                        <p>Pembayaran registrasi anggota belum dilakukan, harap lakukan pembayaran terlebih dahulu untuk menjadi anggota Ikatan Wajib Pajak Indonesia.</p>
                    </div>
                    <div class="cta-two__btn">
                        <a class="thm-btn" href="{{ route('/') }}">
                            <span class="txt">Kembali Ke Beranda</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="about-one__content-box pt-5">
            <div class="sec-title">
                <div class="sub-title">
                    <h4>Petunjuk</h4>
                </div>
                <h2>Cara Pembayaran</h2>
            </div>
            <div class="text">
                <p>
                    Link pembayaran telah dikirimkan melalui email terdaftar, segera check di kotak masuk / Inbox pada Email anda.<br />
                    Jika tidak menerima email <b class="text-primary">link pembayaran</b><br />
                    Segera hubungi Admin Support melalui kontak dibawah ini<br>
                    <h3 class="text-primary">
                        Admin Support IWPI <br />
                        <a href="//wa.me/6282245519467?text=iwpi.info"><i class="fab fa-whatsapp me-2"></i>0822 4551 9467</a> <br />
                    </h3>
                </p>
            </div>

        </div>
    </div>
</section>
<!--End About One-->
@endsection
