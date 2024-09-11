 <!--Start Main Header One -->
 <header class="main-header main-header-two">
    <div class="main-header-two__bottom">
        <div id="sticky-header" class="menu-area">
            <div class="container">
                <div class="main-header-two__bottom-inner">
                    <div class="main-header-two__bottom-left">
                        <div class="logo-box-one">
                            <a href="{{ route('/') }}">
                                <img src="{{ asset('assets/img/resource/logo-iwpi-light.webp') }}" alt="Logo Ikatan Wajib Pajak Indonesia">
                            </a>
                        </div>
                    </div>
                    <div class="main-header-two__bottom-middle">
                        <div class="menu-area__inner">
                            <div class="mobile-nav-toggler">
                                <i class="fas fa-bars"></i>
                            </div>
                            <div class="menu-wrap">
                                <nav class="menu-nav">
                                    <div class="navbar-wrap main-menu">
                                        <ul class="navigation">
                                            <li><a href="{{ route('/') }}">Beranda</a></li>
                                            <li class="menu-item-has-children"><a href="#">Tentang Kami</a>
                                                <ul class="sub-menu">
                                                    <li>
                                                        <a href="{{ route('arti-logo') }}">Arti Logo IWPI</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('about-us') }}">Struktur Organisasi</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('/') }}#bidang-pelayanan">Bidang Pelayanan</a></li>
                                            <li><a href="{{ route('news') }}">Artikel</a></li>
                                            <li class="menu-item-has-children"><a href="{{ route('/') }}#keanggotaan">Keanggotaan</a>
                                                <ul class="sub-menu">
                                                    <li>
                                                        <a href="#">Diskusi Online</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Konsultasi Gratis</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('/') }}#bidang-pelayanan">Konsultasi Litigasi</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('/') }}#bidang-pelayanan">Konsultasi Non Litigasi</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('register.anggota-kehormatan') }}#bidang-pelayanan">Anggota Kehormatan</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children"><a href="{{ route('yellowlist') }}#keanggotaan">Yellow List</a>
                                                <ul class="sub-menu">
                                                    <li>
                                                        <a href="{{ route('form-pengaduan') }}">Buat Pengaduan</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="main-header-three__bottom-right">
                        <div class="header-btn-box-three">
                            <a class="thm-btn" href="{{ route('form-pengaduan') }}">
                                <span class="txt">
                                    Pengaduan Fiskus
                                    <i class="icon-next"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Start Mobile Menu  -->
    <div class="mobile-menu">
        <nav class="menu-box">
            <div class="close-btn">
                <i class="fas fa-times"></i>
            </div>
            <div class="nav-logo">
                <a href="{{ route('/') }}">
                    <img src="{{ asset('assets/img/resource/mobile-menu-logo.webp') }}" alt="Logo Ikatan Wajib Pajak Indonesia">
                </a>
            </div>
            <div class="menu-outer">
                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            </div>
            <div class="contact-info">
                <div class="icon-box"><span class="icon-phone-call"></span>
                </div>
                <p><a href="//wa.me/6282245519467?text=iwpi.info">+62 822 4551 9467</a></p>
            </div>
        </nav>
    </div>
    <div class="menu-backdrop"></div>
    <!-- End Mobile Menu -->
</header>
<!--End Main Header One -->
