@extends('frontend.layouts.master')
@section('meta-seo')
<meta name="robots" content="noindex">
<!-- Primary Meta Tags -->
<meta name="title" content="Anggota IWPI - Ikatan Wajib Pajak Indonesia" />
<meta name="description" content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta name="keywords"
    content="partai x, partaixid, satu bangsa satu kesatuan, partai politik, pemilu 2024, anggota partai x" />
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
    .keterangan-kartu{font-size:16px;line-height:24px;font-weight:600;color:#4F4F6B}.keterangan-kartu>ul{list-style-type:disc;padding-left:25px}.keterangan-kartu p{color:#900}.media{display:flex;align-items:flex-start}.kartu-anggota{color:#000;font-weight:700}.media .media-body{flex:1}.img-100{width:100px!important}ul.biodata{padding-left:0;list-style-type:none;margin-bottom:0}ul.biodata li{color:#000!important;border-bottom:1px solid #e6e6e6}.list-persons .profile{padding:30px 0}.list-persons .profile .general{padding-top:50px}.list-persons .profile .general ul{padding-right:20px}.list-persons .profile .general ul li{color:#898989;padding-bottom:10px;margin-bottom:10px}.list-persons .profile .general ul li:last-child{padding-bottom:0;margin-bottom:0}.list-persons .profile .general ul li>span{float:right}.list-persons .profile .general p span{margin-left:30px}.list-persons .profile .general .gender{margin-top:30px}.action-single-items>p{padding-bottom:20px}@media only screen and (min-width:992px){.kartu-anggota{font-size:20px}}@media only screen and (max-width:414px){.kartu-anggota .display-3{font-size:2.5rem}.kartu-anggota .display-4{font-size:1.5rem}.list-persons .profile .general{padding:unset!important}}
</style>
@stop
@section('title', 'Kartu Anggota IWPI - Ikatan Wajib Pajak Indonesia')
@section('content')
<!-- About Us section start here -->
<div class="about-us-section-area about-bg" style="background-image: url({{ asset('assets/img/banner-top.png') }});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="about-inner">
                    <h1 class="title wow animate__animated animate__fadeInUp">Verifikasi Kartu Anggota</h1>
                </div>
                <div class="breadcrumbs wow animate__animated animate__fadeInUp animate__delay-1s">
                    <ul>
                        <li><a href="{{ route('/') }}">Home</a></li>
                        <li><a href="#">Kartu Anggota</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Us section End here -->

<!-- Donation Content Section Start here -->
<div class="donation-content-section pt-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="volunteer-form style-01">
                    <div class="donate-programm">
                        <div class="content">
                            <h6 class="subtitle">Kartu Tanda Anggota Partai X</h6>
                            <p class="description style-01">Cek Angggota Partai X & Keaslian Link dari QR Code dengan
                                mengisi captcha terlebih dahulu.</p>
                            <div class="keterangan-kartu list-items wow animate__ animate__fadeInUp">
                                <ul>
                                    <li>Untuk Keaslian data pastikan data yang tertera sama dengan KTA dan KTP
                                        Elektronik yang berlaku</li>
                                    <li>e-KTA merupakan Kartu Tanda Anggota yang sah dan diterbitkan oleh Sekretariat
                                        Partai X sebagai bukti bahwa pemegang e-KTA merupakan anggota Partai X</li>
                                    <li>Dilarang menggunakan kartu ini dalam kegiatan yang melanggar Hukum.</li>
                                    <li>Kartu ini adalah hasil cetak mandiri dari KTA Elektronik melalui
                                        https://www.iwpi.info</li>
                                    <li>Segala bentuk pelanggaran termasuk manipulasi data akan diproses sesuai
                                        ketentuan dan undang-undang yang berlaku di wilayah Republik Indonesia.</li>
                                    <li>Jika menemukan kartu ini harap dikembalikan ke: <br>
                                        <p><b>Sekretariat DPP Partai X</b><br>
                                            Menara Karya, 28th Floor<br>
                                            Jl. H.R. Rasuna Said Blok X-5, Kav. 1-2, Jakarta 12950 - INDONESIA <br>
                                            admin@partaix.id<br>
                                            021-5789 5972<br>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Donation Content Section Start here -->
<!-- Administration Section Start Here -->
<div class="administration-section home-six">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card kartu-anggota wow animate__animated animate__fadeInUp">
                    <div class="card-header bg-danger" style="background: #990000 !important;">
                        <div class="media">
                            <img class="img-100 img-fluid m-r-20 rounded-circle"
                                src="{{ asset('/assets/img/body-2.png') }}" alt="">
                            <div class="media-body mt-0 fw-700">
                                <h4 class="display-3 text-light font-weight-bold text-uppercase">{{ $user->fullname }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body list-persons">
                        <div class="profile">
                            <div class="general p-5 f-w-600 f-16">
                                <h5 class="mb-3 display-4 font-weight-bold title text-danger">Data Anggota</h5>
                                <ul class="biodata">
                                    <li>Nomor Anggota Partai<span class="text-danger">@if($user->status == 'Waiting') -
                                            @else {{ substr($user->nik,0,3)."******".substr($user->nik,(strlen($user->nik))-3,3); }} @endif</span></li>
                                    <li>Nama Lengkap <span class="text-danger">{{ $user->fullname }}</span></li>
                                    <li>NIK <span>...</span></li>
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
                                        <span class="badge badge-info blinking">Menunggu Konfirmasi</span>
                                        @elseif($user->status == 'Approve')
                                        <span class="badge badge-success">Anggota Telah Aktif Hingga {{
                                            \Carbon\Carbon::parse($user->date_active)->format('d/m/Y')}}</span>
                                        @else
                                        <span class="badge badge-default">{{ $user->status }}</span>
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
</div>
@endsection
@section('footer-script')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    document.onkeydown=function(e){return!e.ctrlKey||67!==e.keyCode&&86!==e.keyCode&&85!==e.keyCode&&117!==e.keyCode},document.addEventListener("keydown",function(){if(123==event.keyCode||event.ctrlKey&&event.shiftKey&&73==event.keyCode||event.ctrlKey&&85==event.keyCode)return!1},!1),document.addEventListener?document.addEventListener("contextmenu",function(e){e.preventDefault()},!1):document.attachEvent("oncontextmenu",function(){window.event.returnValue=!1}),$(document).keypress("u",function(e){return!e.ctrlKey});
</script>
@endsection
