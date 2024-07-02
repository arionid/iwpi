@extends('frontend.layouts.master')
@section('meta-seo')
<!-- Primary Meta Tags -->
<meta name="title" content="Konfirmasi Pembayaran - Ikatan Wajib Pajak Indonesia" />
<meta name="description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta name="keywords" content="IWPI, Ikatan Wajib Pajak Indonesia, Wajib Pajak, Asosiasi Wajib Pajak, Perkumpulan Wajib Pajak, Pajak Indonesia, DJP, Melawan DJP, Pajak Transparan, Organisasi Pajak" />
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://iwipi.info/" />
<meta property="og:title" content="Konfirmasi Pembayaran - Ikatan Wajib Pajak Indonesia" />
<meta property="og:description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta property="og:image" content="{{ asset('meta-seo.webp') }}" />
<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="https://iwipi.info/" />
<meta property="twitter:title" content="Konfirmasi Pembayaran - Ikatan Wajib Pajak Indonesia" />
<meta property="twitter:description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta property="twitter:image" content="{{ asset('meta-seo.webp') }}" />
@endsection
@section('header')
@include('frontend.layouts.header')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<style>
    .about-one {
        padding-top: 8rem;
        padding-bottom: 8rem;
    }

    .about-one__overlay-box {
        background-color: var(--thm-secondary) !important;
    }

    .cta-two__inner {
        background-color: #61e181 !important;
    }
</style>
@stop
@section('title', 'Konfirmasi Pembayaran - Ikatan Wajib Pajak Indonesia')
@section('content')
<!--Start Page Header-->
<section class="page-header">
    <div class="shape1 rotate-me"><img src="assets/img/shape/page-header-shape1.png" alt=""></div>
    <div class="shape2 float-bob-x"><img src="assets/img/shape/page-header-shape2.png" alt=""></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>Konfirmasi Pembayaran</h2>
            <ul class="thm-breadcrumb">
                <li><a href="{{ route('/') }}"><span class="fa fa-home"></span> Home</a></li>
                <li><i class="icon-right-arrow-angle"></i></li>
                <li class="color-base">Konfirmasi Pembayaran</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->
@if ($message = Session::get('success'))
<div class="cta-two testmonials pt-5 mb-1">
    <div class="container">
        <div class="cta-two__inner">
            <div class="cta-two__inner-bg" style="background-image: url(assets/img/pattern/cta-two__parttern1.png);">
            </div>
            <div class="cta-two__content">
                <h2>Konfirmasi Pembayaran Berhasil</h2>
                <p>{!! $message !!}</p>
            </div>
            <div class="cta-two__btn">
                <a class="thm-btn" href="{{ route('/') }}">
                    <span class="txt">Kembali Ke Beranda</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endif
<!--Start Contact Page-->
<section class="contact-page pt-0">
    <div class="contact-page__bottom">
        <!--Start Contact Two-->
        <div class="contact-page__bottom-form">
            <div class="container">
                <div class="contact-page__bottom-form-inner">
                    <div class="title-box">
                        <h2>Konfirmasi di atas jam 21.00 atau di Hari Libur?</h2>
                        <p>Untuk pembayaran yang dilakukan di atas jam 21.00WIB atau pada hari libur di atas jam
                            17.00WIB, silakan mengupload bukti transfer melalui form dibawah ini agar pembayaran Anda
                            dapat diproses segera.</p>
                    </div>
                    @if ($errors->any())
                    <div>
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Pemberitahuan</h4>
                            <hr>
                            @foreach ($errors->all() as $error)
                            <p>{{$error}}</p>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="contact-page__bottom-form-inner-box">
                        <form method="POST" action="{{ route('konfirmasi-pembayaran.submit') }}"
                            enctype="multipart/form-data" class="contact-page__form">
                            @csrf
                            <input type="hidden" name="pendaftar_id" id="pendaftar_id">
                            <div class="row">
                                <div class="col-md-12  py-3">
                                    <label class="form-label text-dark fw-bold">NPWP yang di daftarkan<span
                                            class="text-danger">*</span></label>
                                    <div class="form-group {{ $errors->has('npwp') ? ' has-error' : '' }}">
                                        <input type="text" id="npwp" name="npwp" placeholder="No NPWP 15 Digit"
                                            class="form-control format_npwp fw-bold txt-blue" value="{{ old('npwp') }}"
                                            required="">
                                        @if ($errors->has('npwp'))
                                        <div class="invalid-feedback">{{ $errors->first('npwp') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label text-dark fw-bold">Nominal Tagihan</label>
                                        <input type="text" name="nominal_tagihan" class="form-control"
                                            placeholder="Nilai Tagihan" id="nominal_tagihan" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label text-dark fw-bold">Bank Tujuan</label>
                                        <input type="text" class="form-control"
                                            value="Bank Mandiri a/n PERKUMPULAN WAJIB PAJAK INDONESIA 144-00-2772888-7">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label text-dark fw-bold">Tanggal Transfer<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="tgl_bayar" placeholder="Masukkan Tanggal Transfer"
                                            class="form-control" value="{{ old('tgl_bayar') }}" id="datepicker" required
                                            autocomplete="off">
                                        @if ($errors->has('tgl_bayar'))
                                        <div class="invalid-feedback">{{ $errors->first('tgl_bayar') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label text-dark fw-bold">Nama Pengirim / Pemilik
                                            Rekening<span class="text-danger">*</span></label>
                                        <input type="text" name="pengirim" class="form-control"
                                            placeholder="Nama Pengirim/ Pemilik Rekening" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-dark fw-bold py-2">Upload Bukti Pembayaran<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-12 p-0">
                                        <div class="form-group">
                                            <input type="file" name="file_bukti" class="form-control" required>
                                            <small class="form-text text-danger">File yang diijinkan
                                                adalah file gambar dengan ekstensi [.jpg/.jpeg/.png].</small>
                                            @if ($errors->has('file_bukti'))
                                            <div class="invalid-feedback">{{ $errors->first('file_bukti') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-dark fw-bold py-2">Keterangan Tambahan</label>
                                    <div class="col-md-12 p-0">
                                        <div class="form-group">
                                            <textarea name="keterangan" class="form-control" rows="3"
                                                placeholder="Isi keterangan jika nominal yang di transfer berbeda">{!!
                                                old('keterangan') !!}</textarea>
                                            @if ($errors->has('keterangan'))
                                            <div class="invalid-feedback">{{ $errors->first('keterangan') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
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
                                            <input type="text" name="captcha" placeholder="Isi Jawaban Math disini"
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
                            <div class="contact-page__btn">
                                <button class="thm-btn" type="submit" id="btn-submit">
                                    <span class="txt">
                                        Konfirmasi Pembayaran <i class="fas fa-arrow-right"></i>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End Contact Two-->
    </div>
</section>
<!--End Contact Page-->
@endsection
@section('footer-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
    integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script>
    // document.onkeydown=function(e){return!e.ctrlKey||67!==e.keyCode&&86!==e.keyCode&&85!==e.keyCode&&117!==e.keyCode},document.addEventListener("keydown",function(){if(123==event.keyCode||event.ctrlKey&&event.shiftKey&&73==event.keyCode||event.ctrlKey&&85==event.keyCode)return!1},!1),document.addEventListener?document.addEventListener("contextmenu",function(e){e.preventDefault()},!1):document.attachEvent("oncontextmenu",function(){window.event.returnValue=!1}),$(document).keypress("u",function(e){return!e.ctrlKey});
$('.format_npwp').mask('00.000.000.0-000.0000');
$( "#datepicker" ).datepicker({maxDate: "d", dateFormat: "yy-mm-dd"});
$(".btn-refresh").click(function(){
  $.ajax({
     type:'GET',
     url:'/refresh_captcha',
     success:function(data){
        $(".captcha span").html(data.captcha);
     }
  });
});
$('#npwp').change(function(){
        var npwp=document.getElementById("npwp").value;
        $.ajax({
            type : 'POST',
            url  : "{{ config('nnd.link-online').'/api/pembayaran/npwp' }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "npwp": npwp,
            },
            success: function(data){
                $('#pendaftar_id').val(data.pendaftaran_id);
                $('#nominal_tagihan').val("Rp "+ new Intl.NumberFormat().format(data.layanan_nominal));
            },
            error: function (request, status, error) {
                console.log(request);
                if(request.status ==429){
                    alert(error);
                }else{
                    alert("NPWP & Email yang anda masukkan tidak ada dalam database kami, mohon di check kembali");
                }
            }
        });
    });
</script>
@endsection
