@extends('frontend.layouts.master')
@section('meta-seo')
<!-- Primary Meta Tags -->
<title>IWPI - Ikatan Wajib Pajak Indonesia</title>
<meta name="title" content="IWPI - Ikatan Wajib Pajak Indonesia" />
<meta name="description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta name="keywords"
    content="IWPI, Ikatan Wajib Pajak Indonesia, Wajib Pajak, Asosiasi Wajib Pajak, Perkumpulan Wajib Pajak, Pajak Indonesia, DJP, Melawan DJP, Pajak Transparan, Organisasi Pajak" />
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://iwipi.info/" />
<meta property="og:title" content="IWPI - Ikatan Wajib Pajak Indonesia" />
<meta property="og:description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta property="og:image" content="{{ asset('meta-seo.webp') }}" />
<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="https://iwipi.info/" />
<meta property="twitter:title" content="IWPI - Ikatan Wajib Pajak Indonesia" />
<meta property="twitter:description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta property="twitter:image" content="{{ asset('meta-seo.webp') }}" />
@endsection
@section('header')
@include('frontend.layouts.headerB')
<style>
    .cta-one__inner {
    background-color: var(--thm-heading-font-color) !important;
}
</style>
@stop
@section('content')
<!--Start Banner Two-->
<section class="banner-two">
    <div class="banner-two__shape1">
        <img src="{{ asset('assets/img/shape/banner-two__shape1.png') }}" alt="shape">
    </div>
    <div class="banner-two__shape2">
        <img src="{{ asset('assets/img/shape/banner-two__shape2.png') }}" alt="shape">
    </div>
    <div class="banner-two__shape3">
        <img src="{{ asset('assets/img/shape/banner-two__shape3.png') }}" alt="shape">
    </div>
    <div class="banner-two__shape4">
        <img src="{{ asset('assets/img/shape/banner-two__shape4.png') }}" alt="shape">
    </div>
    <div class="banner-two__shape5 rotate-me">
        <img src="{{ asset('assets/img/shape/banner-two__shape5.png') }}" alt="shape">
    </div>
    <div class="banner-two__shape6 float-bob-y">
        <img src="{{ asset('assets/img/shape/banner-two__shape6.png') }}" alt="shape">
    </div>
    <div class="container">
        <div class="banner-two__inner clearfix">
            <div class="banner-two__content wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                <div class="big-title">
                    <h2>Ikatan<br>Wajib Pajak<br>Indonesia</h2>
                </div>
                <div class="text">
                    <p>IWPI saat ini merupakan wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk
                        Perkumpulan berbadan hukum.</p>
                </div>
                <div class="bottom-box">
                    <div class="btn-box">
                        <a class="thm-btn" href="{{ route('register.member') }}">
                            <span class="txt">
                                Daftar Sekarang
                                <i class="icon-next"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="banner-two__img float-bob-y muter">
                <img src="{{ asset('assets/img/iwpi-illustration.png') }}" alt="banner">
            </div>
        </div>
    </div>
</section>
<!--End Banner Two-->
<!--Start Service Two-->
<section class="service-two">
    <div class="service-two__shape1">
        <img src="{{ asset('assets/img/shape/service-two__shape1.png') }}" alt="shape">
    </div>
    <div class="service-two__shape2">
        <img src="{{ asset('assets/img/shape/service-two__shape2.png') }}" alt="shape">
    </div>
    <div class="service-two__shape3">
        <img src="{{ asset('assets/img/shape/service-two__shape3.png') }}" alt="shape">
    </div>
    <div class="service-two__shape4 float-bob-y">
        <img src="{{ asset('assets/img/shape/service-two__shape4.png') }}" alt="shape">
    </div>
    <div class="container">
        <div class="sec-title-two text-center">
            <h2>Tujuan <span>Perkumpulan</span></h2>
        </div>
        <div class="row">
            <!--Start Single Service Two-->
            <div class="col-xl-3 col-lg-6 col-md-6 wow animated fadeInUp" data-wow-delay="0.1s">
                <div class="service-two__single">
                    <div class="service-two__single-icon-box color1">
                        <span class="icon-happy-clients"><span class="path1"></span><span class="path2"></span><span
                                class="path3"></span><span class="path4"></span></span>
                    </div>
                    <div class="service-two__single-title-box">
                        <h3><a href="#">Mempererat Solidaritas</a></h3>
                    </div>
                    <div class="service-two__single-text-box">
                        <p>Untuk mempererat hubungan dan solidaritas antar sesama wajib pajak.</p>
                    </div>
                </div>
            </div>
            <!--End Single Service Two-->
            <!--Start Single Service Two-->
            <div class="col-xl-3 col-lg-6 col-md-6 wow animated fadeInUp" data-wow-delay="0.2s">
                <div class="service-two__single">
                    <div class="service-two__single-icon-box color2">
                        <span class="icon-document"></span>
                    </div>
                    <div class="service-two__single-title-box">
                        <h3><a href="#">Sarana Kerjasama</a></h3>
                    </div>
                    <div class="service-two__single-text-box">
                        <p>Sarana Kerjasama pelaku usaha/pengusaha dan karyawan sebagai wajib pajak.</p>
                    </div>
                </div>
            </div>
            <!--End Single Service Two-->
            <!--Start Single Service Two-->
            <div class="col-xl-3 col-lg-6 col-md-6 wow animated fadeInUp" data-wow-delay="0.3s">
                <div class="service-two__single">
                    <div class="service-two__single-icon-box">
                        <span class="icon-winning-award"></span>
                    </div>
                    <div class="service-two__single-title-box">
                        <h3><a href="#">Meningkatkan Peran dan Kualitas Wajib Pajak </a></h3>
                    </div>
                    <div class="service-two__single-text-box">
                        <p>Meningkatkan Peran, <i>Knowledge</i> dan Kualitas Wajib Pajak.</p>
                    </div>
                </div>
            </div>
            <!--End Single Service Two-->
            <!--Start Single Service Two-->
            <div class="col-xl-3 col-lg-6 col-md-6 wow animated fadeInUp" data-wow-delay="0.4s">
                <div class="service-two__single">
                    <div class="service-two__single-icon-box color3">
                        <span class="icon-design-strategy"><span class="path1"></span><span class="path2"></span><span
                                class="path3"></span><span class="path4"></span></span>
                        <!-- <span class="icon-web-development1"></span> -->
                    </div>
                    <div class="service-two__single-title-box">
                        <h3><a href="#">Memberikan Kepastian Hukum</a></h3>
                    </div>
                    <div class="service-two__single-text-box">
                        <p>Mendukung dan mengupayakan agar peraturan perundang-undangan perpajakan diterapkan dengan
                            adil.</p>
                    </div>
                </div>
            </div>
            <!--End Single Service Two-->
        </div>
    </div>
</section>
<!--End Service Two-->

 <!--Start Cta One-->
 <section class="cta-one">
    <div class="container">
        <div class="cta-one__inner text-center">
            <div class="cta-one__shape1 float-bob-y">
                <img src="{{ asset('assets/img/shape/cta-one__shape1.png') }}" alt="#">
            </div>
            <div class="cta-one__shape2 float-bob-y">
                <img src="{{ asset('assets/img/shape/cta-one__shape2.png') }}" alt="#">
            </div>
            <div class="cta-one__shape3 rotate-me">
                <img src="{{ asset('assets/img/shape/cta-one__shape2.png') }}" alt="#">
            </div>
            <div class="cta-one__shape4 float-bob-x">
                <img src="{{ asset('assets/img/shape/cta-one__shape2.png') }}" alt="#">
            </div>
            <div class="cta-one__shape5 float-bob-x">
                <img src="{{ asset('assets/img/shape/cta-one__shape2.png') }}" alt="#">
            </div>
            <div class="cta-one__shape6 float-bob-y">
                <img src="{{ asset('assets/img/shape/cta-one__shape2.png') }}" alt="#">
            </div>
            <div class="cta-one__inner-title-box">
                <h2>Sebagai Wajib Pajak, Bayar Pajaklah Sesuai Kewajiban Agar Negara Kuat,
                    dan Fiskus Menerima Haknya demi Terciptanya Keadilan.</h2>
            </div>
        </div>
    </div>
</section>
<!--End Cta One-->

<!--Start Skills One-->
<section class="skills-one" id="bidang-pelayanan">
    <div class="container">
        <div class="sec-title text-center">
            <div class="sub-title">
                <h4>Jasa / Layanan</h4>
            </div>
            <h2>Bidang Pelayanan Jasa</h2>
        </div>
        <div class="row">
            <!--Start Single Skills One-->
            <div class="col-xl-6 col-lg-6 wow animated fadeInLeft" data-wow-delay="0.1s">
                <div class="skills-one__single">
                    <div class="skills-one__single-inner">
                        <div class="skills-one__single-left-box">
                            <div class="skills-one__single-icon">
                                <img src="{{ asset('assets/img/icon/skills/skills1-1.png') }}"
                                    alt="Bidang Pelayanan Jasa">
                            </div>
                            <div class="skills-one__single-title">
                                <h3>Accounting Service</h3>
                                <p>Non Litigasi</p>
                            </div>
                        </div>
                        <div class="skills-one__single-right-box">
                            <div class="skills-one__single-btn-box">
                                <a href="#"><span class="icon-up-right-arrow"></span></a>
                            </div>
                            <div class="skills-one__single-date-box">
                                <p>Informasi Lengkap</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Single Skills One-->
            <!--Start Single Skills One-->
            <div class="col-xl-6 col-lg-6 wow animated fadeInRight" data-wow-delay="0.1s">
                <div class="skills-one__single">
                    <div class="skills-one__single-inner">
                        <div class="skills-one__single-left-box">
                            <div class="skills-one__single-icon">
                                <img src="{{ asset('assets/img/icon/skills/skills1-1.png') }}"
                                    alt="Bidang Pelayanan Jasa">
                            </div>
                            <div class="skills-one__single-title">
                                <h3>Tax Review</h3>
                                <p>Non Litigasi</p>
                            </div>
                        </div>
                        <div class="skills-one__single-right-box">
                            <div class="skills-one__single-btn-box">
                                <a href="#"><span class="icon-up-right-arrow"></span></a>
                            </div>
                            <div class="skills-one__single-date-box">
                                <p>Informasi Lengkap</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Single Skills One-->
            <!--Start Single Skills One-->
            <div class="col-xl-6 col-lg-6 wow animated fadeInLeft" data-wow-delay="0.2s">
                <div class="skills-one__single">
                    <div class="skills-one__single-inner">
                        <div class="skills-one__single-left-box">
                            <div class="skills-one__single-icon">
                                <img src="{{ asset('assets/img/icon/skills/skills1-1.png') }}"
                                    alt="Bidang Pelayanan Jasa">
                            </div>
                            <div class="skills-one__single-title">
                                <h3>Konsultasi</h3>
                                <p>Non Litigasi</p>
                            </div>
                        </div>
                        <div class="skills-one__single-right-box">
                            <div class="skills-one__single-btn-box">
                                <a href="#"><span class="icon-up-right-arrow"></span></a>
                            </div>
                            <div class="skills-one__single-date-box">
                                <p>Informasi Lengkap</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Single Skills One-->
            <!--Start Single Skills One-->
            <div class="col-xl-6 col-lg-6 wow animated fadeInRight" data-wow-delay="0.2s">
                <div class="skills-one__single">
                    <div class="skills-one__single-inner">
                        <div class="skills-one__single-left-box">
                            <div class="skills-one__single-icon">
                                <img src="{{ asset('assets/img/icon/skills/skills1-1.png') }}"
                                    alt="Bidang Pelayanan Jasa">
                            </div>
                            <div class="skills-one__single-title">
                                <h3>SP2DK</h3>
                                <p>Non Litigasi</p>
                            </div>
                        </div>
                        <div class="skills-one__single-right-box">
                            <div class="skills-one__single-btn-box">
                                <a href="#"><span class="icon-up-right-arrow"></span></a>
                            </div>
                            <div class="skills-one__single-date-box">
                                <p>Informasi Lengkap</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Single Skills One-->
            <!--Start Single Skills One-->
            <div class="col-xl-6 col-lg-6 wow animated fadeInLeft" data-wow-delay="0.3s">
                <div class="skills-one__single">
                    <div class="skills-one__single-inner">
                        <div class="skills-one__single-left-box">
                            <div class="skills-one__single-icon">
                                <img src="{{ asset('assets/img/icon/skills/skills1-1.png') }}"
                                    alt="Bidang Pelayanan Jasa">
                            </div>
                            <div class="skills-one__single-title">
                                <h3>Pendampingan Pemerikasaan</h3>
                                <p>Non Litigasi</p>
                            </div>
                        </div>
                        <div class="skills-one__single-right-box">
                            <div class="skills-one__single-btn-box">
                                <a href="#"><span class="icon-up-right-arrow"></span></a>
                            </div>
                            <div class="skills-one__single-date-box">
                                <p>Informasi Lengkap</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Single Skills One-->
            <!--Start Single Skills One-->
            <div class="col-xl-6 col-lg-6 wow animated fadeInRight" data-wow-delay="0.1s">
                <div class="skills-one__single">
                    <div class="skills-one__single-inner">
                        <div class="skills-one__single-left-box">
                            <div class="skills-one__single-icon">
                                <img src="{{ asset('assets/img/icon/skills/skills1-1.png') }}"
                                    alt="Bidang Pelayanan Jasa">
                            </div>
                            <div class="skills-one__single-title">
                                <h3>Pembetulan SKP & STP</h3>
                                <p>Non Litigasi</p>
                            </div>
                        </div>
                        <div class="skills-one__single-right-box">
                            <div class="skills-one__single-btn-box">
                                <a href="#"><span class="icon-up-right-arrow"></span></a>
                            </div>
                            <div class="skills-one__single-date-box">
                                <p>Informasi Lengkap</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Single Skills One-->
            <!--Start Single Skills One-->
            <div class="col-xl-6 col-lg-6 wow animated fadeInRight" data-wow-delay="0.1s">
                <div class="skills-one__single">
                    <div class="skills-one__single-inner">
                        <div class="skills-one__single-left-box">
                            <div class="skills-one__single-icon">
                                <img src="{{ asset('assets/img/icon/skills/skills1-1.png') }}"
                                    alt="Bidang Pelayanan Jasa">
                            </div>
                            <div class="skills-one__single-title">
                                <h3>Pembatalan SKP & STP</h3>
                                <p>Non Litigasi</p>
                            </div>
                        </div>
                        <div class="skills-one__single-right-box">
                            <div class="skills-one__single-btn-box">
                                <a href="#"><span class="icon-up-right-arrow"></span></a>
                            </div>
                            <div class="skills-one__single-date-box">
                                <p>Informasi Lengkap</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Single Skills One-->
            <!--Start Single Skills One-->
            <div class="col-xl-6 col-lg-6 wow animated fadeInRight" data-wow-delay="0.1s">
                <div class="skills-one__single">
                    <div class="skills-one__single-inner">
                        <div class="skills-one__single-left-box">
                            <div class="skills-one__single-icon">
                                <img src="{{ asset('assets/img/icon/skills/skills1-1.png') }}"
                                    alt="Bidang Pelayanan Jasa">
                            </div>
                            <div class="skills-one__single-title">
                                <h3>Pengadilan Pajak</h3>
                                <p>Litigasi</p>
                            </div>
                        </div>
                        <div class="skills-one__single-right-box">
                            <div class="skills-one__single-btn-box">
                                <a href="#"><span class="icon-up-right-arrow"></span></a>
                            </div>
                            <div class="skills-one__single-date-box">
                                <p>Informasi Lengkap</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Single Skills One-->
            <!--Start Single Skills One-->
            <div class="col-xl-6 col-lg-6 wow animated fadeInRight" data-wow-delay="0.1s">
                <div class="skills-one__single">
                    <div class="skills-one__single-inner">
                        <div class="skills-one__single-left-box">
                            <div class="skills-one__single-icon">
                                <img src="{{ asset('assets/img/icon/skills/skills1-1.png') }}"
                                    alt="Bidang Pelayanan Jasa">
                            </div>
                            <div class="skills-one__single-title">
                                <h3>Pengadilan Negeri (PN)</h3>
                                <p>Litigasi</p>
                            </div>
                        </div>
                        <div class="skills-one__single-right-box">
                            <div class="skills-one__single-btn-box">
                                <a href="#"><span class="icon-up-right-arrow"></span></a>
                            </div>
                            <div class="skills-one__single-date-box">
                                <p>Informasi Lengkap</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Single Skills One-->
            <!--Start Single Skills One-->
            <div class="col-xl-6 col-lg-6 wow animated fadeInRight" data-wow-delay="0.1s">
                <div class="skills-one__single">
                    <div class="skills-one__single-inner">
                        <div class="skills-one__single-left-box">
                            <div class="skills-one__single-icon">
                                <img src="{{ asset('assets/img/icon/skills/skills1-1.png') }}"
                                    alt="Bidang Pelayanan Jasa">
                            </div>
                            <div class="skills-one__single-title">
                                <h3>Mahkamah Agung (MA)</h3>
                                <p>Litigasi</p>
                            </div>
                        </div>
                        <div class="skills-one__single-right-box">
                            <div class="skills-one__single-btn-box">
                                <a href="#"><span class="icon-up-right-arrow"></span></a>
                            </div>
                            <div class="skills-one__single-date-box">
                                <p>Informasi Lengkap</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Single Skills One-->
        </div>
    </div>
</section>
<!--End Skills One-->
<!--Start Pricing One-->
<section class="pricing-one" id="keanggotaan">
    <div class="container">
        <div class="sec-title-two text-center">
            <h2>Biaya <span>Keanggotaan</span></h2>
            <p>Dapatkan banyak benefit dengan bergabung dengan Ikatan Wajib Pajak Indonesia</p>
        </div>
        <div class="row justify-content-md-center">
            <!--Start Single Pricing One-->
            <div class="col-xl-4 col-lg-4 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                <div class="pricing-one__single">
                    <div class="pricing-one__single-title">
                        <h2>Perorangan</h2>
                        <p>Wajib Pajak Perorangan</p>
                    </div>
                    <div class="pricing-one__single-value">
                        <h2>Rp. 50.000<span>/tahun</span></h2>
                    </div>
                    <div class="pricing-one__single-list">
                        <ul>
                            <li>
                                <div class="icon">
                                    <span class="icon-check"></span>
                                </div>
                                <p>Masuk Grup WhatApp/Telegram IWPI</p>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-check"></span>
                                </div>
                                <p>Informasi Terbaru terkait Perpajakan Indonesia</p>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-check"></span>
                                </div>
                                <p>Sesi Konsultasi Gratis</p>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-check"></span>
                                </div>
                                <p>Forum IWP</p>
                            </li>
                        </ul>
                    </div>
                    <div class="pricing-one__single-btn">
                        <a class="thm-btn" href="{{ route('register.member') }}">
                            <span class="txt">Bergabung</span>
                            <i class="icon-next"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!--End Single Pricing One-->
            <!--Start Single Pricing One-->
            <div class="col-xl-4 col-lg-4 wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1500ms">
                <div class="pricing-one__single">
                    <div class="category-box">
                        <p>Best Plan</p>
                    </div>
                    <div class="pricing-one__single-title">
                        <h2>Badan</h2>
                        <p>Wajib Pajak Badan</p>
                    </div>
                    <div class="pricing-one__single-value">
                        <h2>Rp. 150.000<span>/tahun</span></h2>
                    </div>
                    <div class="pricing-one__single-list">
                        <ul>
                            <li>
                                <div class="icon">
                                    <span class="icon-check"></span>
                                </div>
                                <p>Masuk Grup WhatApp/Telegram IWPI</p>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-check"></span>
                                </div>
                                <p>Informasi Terbaru terkait Perpajakan Indonesia</p>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-check"></span>
                                </div>
                                <p>Sesi Konsultasi Gratis</p>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-check"></span>
                                </div>
                                <p>Diskusi Rutin Dengan Member</p>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-check"></span>
                                </div>
                                <p>Kelas Perpajakan</p>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-check"></span>
                                </div>
                                <p>Free Download Kumpulan Perundang-undangan Pajak Terbaru</p>
                            </li>
                    </div>
                    <div class="pricing-one__single-btn">
                        <a class="thm-btn" href="{{ route('register.member') }}">
                            <span class="txt">Bergabung</span>
                            <i class="icon-next"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!--End Single Pricing One-->
        </div>
    </div>
</section>
<!--End Pricing One-->
@isset($blog)
<!--Start Blog Two-->
<section class="blog-two">
    <div class="container">
        <div class="sec-title-two text-center">
            <h2>Artikel <span>Terbaru</span></h2>
        </div>
        <ul class="row">
            <!--Start Single Blog Two-->
            @foreach ($blog as $item)
            <li class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay=".1s">
                <div class="blog-two__single">
                    <div class="blog-two__single-img">
                        <img src="{{ file_exists('uploads/'.$item->featured_img) ? asset('uploads/'.$item->featured_img) : asset('assets/img/default-blog-sm.jpg') }}"
                            alt="{{ $item->title }}">
                    </div>
                    <div class="blog-two__single-content">
                        <div class="date-box">
                            <ul class="clearfix">
                                <li>
                                    <div class="icon">
                                        <span class="icon-calendar"></span>
                                    </div>
                                    <p>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="icon-time"></span>
                                    </div>
                                    <p>{{ \Str::title($item->category->name) ?? 'Artikel'}}</p>
                                </li>
                            </ul>
                        </div>
                        <div class="blog-two__single-content-title">
                            <h3><a href="{{ route('news.detail', $item->slug) }}">{{ $item->title }}</a></h3>
                            {!! Str::limit($item->excerpt, 150) !!}
                        </div>
                        <div class="blog-two__single-content-btn-box">
                            <a class="thm-btn" href="{{ route('news.detail', $item->slug) }}">
                                <span class="txt">Baca Selengkapnya</span>
                                <i class="icon-next"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
            <!--End Single Blog Two-->
            @endforeach
        </ul>
    </div>
</section>
<!--End Blog Two-->
@endisset
@endsection
