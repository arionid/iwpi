<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('meta-seo')
    <meta name="author" content="nndproject | fernandoferry">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#b91d47">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('title', 'IWPI - Ikatan Wajib Pajak Indonesia')</title>
    @include('frontend.layouts.css')
    @yield('style')
</head>
<body class="body-white-bg">
    <!-- preloader -->
    <div id="preloader">
        <div id="loading-center">
            <div class="loader">
                <div class="loader-outter"></div>
                <div class="loader-inner"></div>
            </div>
        </div>
    </div>
    <!-- preloader-end -->
    <div class="page-wrapper">
        @yield('header')
        @yield('content')
        <!--Start Footer One-->
        <footer class="footer-one">
            <!-- Start Footer Main -->
            <div class="footer-main">
                <div class="container">
                    <div class="footer-one__img1 float-bob-x">
                        <img src="{{ asset('assets/img/footer/footer-illustration-1.webp') }}" alt="#">
                    </div>
                    <div class="footer-one__img2 float-bob-y">
                        <img src="{{ asset('assets/img/footer/footer-illustration-2.webp') }}" alt="#">
                    </div>
                    <div class="footer-main__inner text-center">
                        <div class="footer-one__logo-box">
                            <a href="{{ route('/') }}"><img src="{{ asset('assets/img/resource/logo-iwpi.webp') }}" alt="#"></a>
                        </div>
                        <div class="footer-one__big-title">
                            <h2>Ikatan Wajib Pajak Indonesia</h2>
                        </div>
                        <div class="footer-one__text-box">
                            <p>IWPI saat ini merupakan wadah asosiasi bagi Wajib Pajak di seluruh Indonesia <br>
                                yang berbentuk Perkumpulan berbadan hukum</p>
                        </div>
                        <div class="footer-one__socel-link">
                            <ul class="clearfix">
                                <li>
                                    <a href="https://www.youtube.com/@Ikatanwajibpajakindonesia">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/iwpi.id">
                                        <i class="icon-instagram-symbol"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer Main -->
            <!--Start Footer Middle-->
            <div class="footer-middle">
                <div class="container">
                    <div class="footer-middle__inner">
                        <div class="copyright-menu">
                            <ul>
                                <li>
                                    <p><a href="{{ route('/') }}">Beranda</a></p>
                                </li>
                                <li>
                                    <p><a href="{{ route('news') }}">Artikel</a></p>
                                </li>
                                <li>
                                    <p><a href="{{ route('konfirmasi-pembayaran') }}">Konfirmasi Pembayaran</a></p>
                                </li>
                                <li>
                                    <p><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></p>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-middle__mail-box">
                            <div class="icon">
                                <span class="icon-mail-inbox-app"></span>
                            </div>
                            <div class="text">
                                <p><a href="mailto:admin@iwpi.com">admin@iwpi.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Footer Middle-->
            <!--Start Footer Bottom -->
            <div class="footer-bottom">
                <div class="container">
                    <div class="footer-bottom__inner">
                        <div class="copyright-text text-center">
                            <p>Copyright © 2024 IWPI.INFO by <a href="#"><b>#nnd</b>project.</a> All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Footer Bottom -->
        </footer>
        <!--Start Footer One-->
    </div>
    <!-- Scroll-top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="icon-down-arrow"></i>
    </button>
    <!-- Scroll-top-end-->
    <!-- latest jquery-->
    @include('frontend.layouts.script')
    @yield('footer-script')
</body>
</html>
