<!--Start Main Header One -->
<header class="main-header main-header-two">
    <div class="main-header-two__bottom">
        <div id="sticky-header" class="menu-area">
            <div class="container">
                <div class="main-header-two__bottom-inner">

                    <div class="main-header-two__bottom-left">
                        <div class="logo-box-one">
                            <a href="{{ route('/') }}">
                                <img src="{{ asset('assets/img/resource/logo-iwpi-light.webp') }}" alt="Logo">
                            </a>
                        </div>
                    </div>

                    <div class="main-header-one__bottom-middle">
                        <div class="menu-area__inner">
                            <div class="mobile-nav-toggler">
                                <i class="fas fa-bars"></i>
                            </div>
                            <div class="menu-wrap">
                                <nav class="menu-nav">
                                    <div class="navbar-wrap main-menu">
                                        <ul class="navigation">
                                            <li><a href="{{ route('/') }}">Beranda</a></li>
                                            <li><a href="{{ route('/') }}#bidang-pelayanan">Bidang Pelayanan</a></li>
                                            <li><a href="{{ route('/') }}#keanggotaan">Keanggotaan</a></li>
                                            <li><a href="{{ route('news') }}">Artikel</a></li>
                                            <li class="menu-item-has-children"><a href="#">Keanggotaan</a>
                                                <ul class="sub-menu">
                                                    <li>
                                                        <a href="#">Diskusi Online</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Konsultasi Gratis</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Konsultasi Litigasi</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Konsultasi Non Litigasi</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Surat Menyurat Administrasi</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--End Main Header One -->
