@extends('frontend.layouts.master')
@section('meta-seo')
<meta name="robots" content="noindex">
<!-- Primary Meta Tags -->
<meta name="title" content="Anggota IWPI - Ikatan Wajib Pajak Indonesia" />
<meta name="description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
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
    .keterangan-kartu p {
        color: #900
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
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="alert-heading">Pemberitahuan</h4>
    <hr>
    @foreach ($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
</div>
@endif
<!-- Donation Content Section Start here -->
<div class="donation-content-section pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
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
                            <p></p>
                            <div class="notice">
                                <div class="icon">
                                    <i class="icon-danger"></i>
                                </div>
                                <p class="f-w-700"><span>INFORMASI:</span> Lihat Pemilik Kartu Anggota dengan mengisi
                                    form dibawah ini</p>
                            </div>
                        </div>
                    </div>
                    <div class="contact-form style-01">
                        <form action="{{ route('form.kta-digital') }}" method="POST" class="contact-page-form"
                            novalidate="novalidate">
                            @csrf
                            <input type="hidden" name="kta" value="{{ \Request()->id }}">
                            <h6 class="title">Isi Jawaban Captha dibawah ini pada field yang di tentukan <i
                                    class="fa fa-refresh" aria-hidden="true"></i></h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group captcha">
                                        <span>{!! captcha_img('flat') !!}</span>
                                        <button type="button" class="btn btn-primary btn-refresh"><i
                                                class="fas fa-sync"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="captcha" placeholder="Isi Jawabah Math disini"
                                            class="form-control input-lg" required="" aria-required="true">
                                        @if ($errors->has('captcha'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('captcha') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="btn-wrapper">
                        <button type="submit" class="boxed-btn btn-sanatory">LIHAT ANGGOTA <span
                                class="icon-paper-plan"></span></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Donation Content Section Start here -->
@endsection
@section('footer-script')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    document.onkeydown=function(e){return!e.ctrlKey||67!==e.keyCode&&86!==e.keyCode&&85!==e.keyCode&&117!==e.keyCode},document.addEventListener("keydown",function(){if(123==event.keyCode||event.ctrlKey&&event.shiftKey&&73==event.keyCode||event.ctrlKey&&85==event.keyCode)return!1},!1),document.addEventListener?document.addEventListener("contextmenu",function(e){e.preventDefault()},!1):document.attachEvent("oncontextmenu",function(){window.event.returnValue=!1}),$(document).keypress("u",function(e){return!e.ctrlKey});
$(".btn-refresh").click(function(){
  $.ajax({
     type:'GET',
     url:'/refresh_captcha',
     success:function(data){
        $(".captcha span").html(data.captcha);
     }
  });
});
</script>
@endsection
