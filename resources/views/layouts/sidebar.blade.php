<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper"><a href="{{ route('/')}}"><img class="img-fluid for-light"
                    src="{{ asset('adm-assets/images/logo/logo.png') }}" alt=""><img class="img-fluid for-dark"
                    src="{{ asset('adm-assets/images/logo/logo_dark.png') }}" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{ route('/')}}"><img class="img-fluid"
                    src="{{ asset('adm-assets/images/logo/logo-icon.png') }}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i>
                        </div>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{ route('home')}}">
                            <i data-feather="home"></i>
                            <span>Dashboard</span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="file-text"></i>
                            <span>Blog</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('blog.index') }}">Blog Listing</a></li>
                            <li><a href="{{ route('blog.create') }}">Add Post</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title"
                            href="{{ route('categories.index') }}">
                            <i data-feather="flag"></i>
                            <span>Categories </span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title"
                            href="{{ route('register-anggota.index')}}">
                            <i data-feather="users"></i>
                            <span>Register Anggota</span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title"
                            href="{{ route('anggota-kehormatan.index')}}">
                            <i data-feather="users" class="text-danger"></i>
                            <span>Anggota Kehormatan</span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="user"></i>
                            <span>Management User</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('management-user.index') }}">List Users</a></li>
                            <li><a href="{{ route('management-user.create') }}">Add User</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="target" class="text-danger"></i>
                        <span>Data Pengaduan</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('pengaduan-yellow-page.index') }}">List Pengaduan</a></li>
                            <li><a href="{{ route('pengaduan-yellow-page.create') }}">Tambah Pengaduan</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title fw-bold" href="https://dashboard.midtrans.com/" target="_blank">
                        <i data-feather="radio" class="text-primary"></i>
                            <span>Dashboard Midtrans</span></a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
