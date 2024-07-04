@extends('frontend.layouts.master')
@section('meta-seo')
<meta name="robots" content="noindex">
<!-- Primary Meta Tags -->
<meta name="title" content="Anggota IWPI - Ikatan Wajib Pajak Indonesia" />
<meta name="description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta name="keywords"
    content="IWPI, Ikatan Wajib Pajak Indonesia, Wajib Pajak, Asosiasi Wajib Pajak, Perkumpulan Wajib Pajak, Pajak Indonesia, DJP, Melawan DJP, Pajak Transparan, Organisasi Pajak" />
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://iwipi.info/" />
<meta property="og:title" content="Anggota IWPI - Ikatan Wajib Pajak Indonesia" />
<meta property="og:description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta property="og:image" content="{{ asset('meta-seo.webp') }}" />
<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="https://iwipi.info/" />
<meta property="twitter:title" content="Anggota IWPI - Ikatan Wajib Pajak Indonesia" />
<meta property="twitter:description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta property="twitter:image" content="{{ asset('meta-seo.webp') }}" />
@endsection
@section('header')
@include('frontend.layouts.header')
<style>
    .keterangan-kartu {
        font-size: 16px;
        line-height: 24px;
        font-weight: 600;
        color: #4F4F6B
    }

    .keterangan-kartu>ul {
        list-style-type: disc;
        padding-left: 25px
    }


    .media {
        display: flex;
        align-items: flex-start
    }

    .kartu-anggota {
        color: #000;
        font-weight: 700
    }

    .media .media-body {
        flex: 1
    }

    .img-100 {
        width: 100px !important
    }

    ul.biodata {
        padding-left: 0;
        list-style-type: none;
        margin-bottom: 0
    }

    ul.biodata li {
        color: #000 !important;
        border-bottom: 1px solid #e6e6e6
    }

    .list-persons .profile {
        padding: 30px 0
    }

    .list-persons .profile .general {
        padding-top: 50px
    }

    .list-persons .profile .general ul {
        padding-right: 20px
    }

    .list-persons .profile .general ul li {
        color: #898989;
        padding-bottom: 10px;
        margin-bottom: 10px
    }

    .list-persons .profile .general ul li:last-child {
        padding-bottom: 0;
        margin-bottom: 0
    }

    .list-persons .profile .general ul li>span {
        float: right
    }

    .list-persons .profile .general p span {
        margin-left: 30px
    }

    .list-persons .profile .general .gender {
        margin-top: 30px
    }

    .action-single-items>p {
        padding-bottom: 20px
    }

    @media only screen and (min-width:992px) {
        .kartu-anggota {
            font-size: 20px
        }
    }

    @media only screen and (max-width:414px) {
        .kartu-anggota .display-3 {
            font-size: 2.5rem
        }

        .kartu-anggota .display-4 {
            font-size: 1.5rem
        }

        .list-persons .profile .general {
            padding: unset !important
        }
    }
</style>
@stop
@section('title', 'Kartu Anggota IWPI - Ikatan Wajib Pajak Indonesia')
@section('content')
<!--Start Page Header-->
<section class="page-header">
    <div class="shape1 rotate-me"><img src="{{ asset('assets/img/shape/page-header-shape1.png') }}" alt=""></div>
    <div class="shape2 float-bob-x"><img src="{{ asset('assets/img/shape/page-header-shape2.png') }}" alt=""></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>Verifikasi Kartu Anggota</h2>
            <ul class="thm-breadcrumb">
                <li><a href="{{ route('/') }}"><span class="fa fa-home"></span> Home</a></li>
                <li><i class="icon-right-arrow-angle"></i></li>
                <li class="color-base">Verifikasi Kartu Anggota</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->
<!-- About Us section End here -->


<!--Start Contact Page-->
<section class="contact-page pt-0">
    <div class="contact-page__bottom">
        <!--Start Contact Two-->
        <div class="contact-page__bottom-form">
            <div class="container">
                <div class="contact-page__bottom-form-inner">
                    <div class="title-box">
                        <h2 class="subtitle">Kartu Tanda Anggota IWPI</h2>
                        <p class="description style-01">Cek Angggota IWPI & Keaslian Link dari QR Code dengan
                            mengisi captcha terlebih dahulu.</p>
                        <div class="keterangan-kartu list-items wow animate__ animate__fadeInUp">
                            <ul>
                                <li>Untuk Keaslian data pastikan data yang tertera sama dengan KTA dan KTP
                                    Elektronik yang berlaku</li>
                                <li>e-KTA merupakan Kartu Tanda Anggota yang sah dan diterbitkan oleh Sekretariat
                                    IWPI sebagai bukti anggota Resmi IWPI</li>
                                <li>Dilarang menggunakan kartu ini dalam kegiatan yang melanggar Hukum.</li>
                                <li>Kartu ini adalah hasil cetak mandiri dari KTA Elektronik melalui
                                    https://www.iwpi.info</li>
                                <li>Segala bentuk pelanggaran termasuk manipulasi data akan diproses sesuai
                                    ketentuan dan undang-undang yang berlaku di wilayah Republik Indonesia.</li>
                                <li>Jika menemukan kartu ini harap dikembalikan ke: <br>
                                    <p><b>Kantor IWPI</b><br>
                                        Grand Slipi Tower, Unit 36-E Perkantoran. <br>
                                        Jalan. Kota Adm Jakarta Barat <br>
                                        admin@iwpi.info<br>
                                        +62 822 4551 9467<br>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact-page pt-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card kartu-anggota wow animate__animated animate__fadeInUp">
                        <div class="card-header" style="background: #0d4e84 !important;">
                            <div class="media">
                                <div class="media-body mt-0 fw-700">
                                    <h4 class="display-3 text-light font-weight-bold text-uppercase ms-2">{{ $user->fullname
                                        }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body list-persons">
                            <div class="profile">
                                <div class="general p-5 f-w-600 f-16">
                                    <h5 class="mb-3 display-4 font-weight-bold title">Data Anggota</h5>
                                    <ul class="biodata">
                                        <li>Nomor Anggota<span class="text-primary">@if($user->status == 'Waiting') -
                                                @else {{ $user->nomor_anggota }}@endif</span></li>
                                        <li>Nama Lengkap <span class="text-primary">{{ $user->fullname }}</span></li>
                                        <li>NIK <span>...</span></li>
                                        @if($user->layanan == 'Badan Usaha')
                                        <li>Jenis Anggota<span>{{ $user->layanan }}</span></li>
                                        <li>Perusahaan<span>{!! \Str::upper($user->perusahaan) !!}</span></li>
                                        @endif
                                        <li>Jabatan <span>{{ $user->jabatan }}</span></li>
                                        <li>Jenis Kelamin <span>...</span></li>
                                        <li>Status Perkawinan <span>...</span></li>
                                        <li>Tempat Tanggal Lahir <span>...</span></li>
                                        <li>Alamat KTP<span> <span>...</span></li>
                                        <li>Provinsi<span>{{ $user->provinces_name }}</span></li>
                                        <li>Kota/Kabupaten<span>{{ $user->regency_name }}</span></li>
                                        <li>Kecamatan<span>...</span></li>
                                        <li>Kelurahan<span>...</span></li>
                                        <li>Status Keanggotaan
                                            @if($user->status == 'Waiting')
                                            <span class="badge bg-info blinking">Menunggu Konfirmasi</span>
                                            @elseif($user->status == 'Approve')
                                            <span class="badge bg-success">Anggota Telah Aktif Hingga {{
                                                \Carbon\Carbon::parse($user->date_active)->format('d/m/Y')}}</span>
                                            @else
                                            <span class="badge bg-primary">{{ $user->status }}</span>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
    @endsection
    @section('footer-script')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
        document.onkeydown=function(e){return!e.ctrlKey||67!==e.keyCode&&86!==e.keyCode&&85!==e.keyCode&&117!==e.keyCode},document.addEventListener("keydown",function(){if(123==event.keyCode||event.ctrlKey&&event.shiftKey&&73==event.keyCode||event.ctrlKey&&85==event.keyCode)return!1},!1),document.addEventListener?document.addEventListener("contextmenu",function(e){e.preventDefault()},!1):document.attachEvent("oncontextmenu",function(){window.event.returnValue=!1}),$(document).keypress("u",function(e){return!e.ctrlKey});
    </script>
    @endsection
