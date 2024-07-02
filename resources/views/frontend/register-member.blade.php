@extends('frontend.layouts.master')
@section('meta-seo')
<!-- Primary Meta Tags -->
<meta name="title" content="Pendaftaran Anggota Ikatan Wajib Pajak Indonesia" />
<meta name="description" content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta name="keywords"
    content="IWPI, Ikatan Wajib Pajak Indonesia, Wajib Pajak, Asosiasi Wajib Pajak, Perkumpulan Wajib Pajak, Pajak Indonesia, DJP, Melawan DJP, Pajak Transparan, Organisasi Pajak" />
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://iwipi.info/" />
<meta property="og:title" content="Pendaftaran Anggota Ikatan Wajib Pajak Indonesia" />
<meta property="og:description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta property="og:image" content="{{ asset('meta-seo.webp') }}" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="https://iwipi.info/" />
<meta property="twitter:title" content="Pendaftaran Anggota Ikatan Wajib Pajak Indonesia" />
<meta property="twitter:description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta property="twitter:image" content="{{ asset('meta-seo.webp') }}" />
<meta name="csrf-token" content="{{ csrf_token() }}">
{!! htmlScriptTagJsApi([
'action' => 'homepage',
]) !!}

<style>

    .txt-blue{
        color: #135ed6 !important;
    }
    .cta-two__inner {
    background-color: #61e181 !important;
    }
    .cta-two__content{
        max-width: 700px !important;
    }
    .thm-btn:disabled::after{
        background-color: #c2c2c2 !important;
    }
</style>
@endsection
@section('header')
@include('frontend.layouts.header')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
@stop
@section('title', 'Pendaftaran Anggota Ikatan Wajib Pajak Indonesia')
@section('content')
<!-- About Us section start here -->
{{-- <script src="https://www.google.com/recaptcha/api.js"></script> --}}

<!--Start Page Header-->
<section class="page-header">
    <div class="shape1 rotate-me"><img src="{{ asset('assets/img/shape/page-header-shape1.png') }}" alt=""></div>
    <div class="shape2 float-bob-x"><img src="{{ asset('assets/img/shape/page-header-shape2.png') }}" alt=""></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>Pendaftaran Anggota</h2>
            <ul class="thm-breadcrumb">
                <li><a href="{{ route('/') }}"><span class="fa fa-home"></span> Home</a></li>
                <li><i class="icon-right-arrow-angle"></i></li>
                <li class="color-base">Pendfataran Anggota</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->
@if ($message = Session::get('success'))
<div class="cta-two testmonials pt-5 mb-1">
    <div class="container">
        <div class="cta-two__inner">
            <div class="cta-two__inner-bg" style="background-image: url(assets/img/pattern/cta-two__parttern1.png);"></div>
            <div class="cta-two__content">
                <h2>Pendaftaran Anggota Berhasil</h2>
                <p>{!! $message !!}</p>
                @if ($nominal = Session::get('nominal'))
                <p>Proses selanjutnya adalah melakukan pembayaran Tagihan Layanan Sebesar <b class="text-light">Rp. {{ number_format($nominal, 2) }}</b>, tata cara pembayaran klik tombol di samping</p>
                @endif
            </div>
            <div class="cta-two__btn">
                <a class="thm-btn" href="{{ route('cara_pembayaran') }}">
                    <span class="txt">Lakukan Pembayaran</span>
                    <i class="icon-next"></i>
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
                        <h2>Form Pendaftaran Anggota IWPI</h2>
                        <p>Hasil Pendaftaran Akan & Infomasi Terkait Tata Cara Pembayaran akan di informasikan oleh admin IWPI melalui <b class="text-primary">Nomor Telepon / WhatsApp </b>yang anda masukkan di Form Pendaftaran dibawah ini.</p>
                        <p>*Pastikan Seluruh data yang dimasukkan sesuai dengan asli dan dapat di pertanggung jawabkan.</p>
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

                        <form method="POST" action="{{ route('register.member.submit') }}" enctype="multipart/form-data"
                            class="contact-page__form contact-form-validated">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 py-3">
                                    <label class="form-label text-dark fw-bold">Jenis Keanggotaan<span class="text-danger">*</span></label>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="form-select" name="layanan_keanggotaan" id="in_layanan_keanggotaan" required>
                                                <option value="" selected="">Pilih Jenis Keanggotaan</option>
                                                <option>Perseorangan</option>
                                                <option>Badan Usaha</option>
                                            </select>
                                            @if ($errors->has('layanan_keanggotaan'))
                                            <div class="invalid-feedback">{{ $errors->first('layanan_keanggotaan') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('npwp') ? ' has-error' : '' }}">
                                        <label class="form-label text-dark fw-bold">Nomor NPWP<span class="text-danger">*</span></label>
                                        <input type="text" name="npwp" placeholder="No NPWP 15 Digit" class="form-control format_npwp fw-bold txt-blue"
                                            value="{{ old('npwp') }}" required="">
                                        @if ($errors->has('npwp'))
                                        <div class="invalid-feedback">{{ $errors->first('npwp') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('perusahaan') ? ' has-error' : '' }}">
                                        <label class="form-label text-dark fw-bold">Nama Badan Usaha/Perseorangan</label>
                                        <input type="text" name="perusahaan" placeholder="Kosongi Jika Anda Perseorangan" class="form-control fw-bold"
                                            value="{{ old('perusahaan') }}">
                                        @if ($errors->has('perusahaan'))
                                        <div class="invalid-feedback">{{ $errors->first('perusahaan') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('nik') ? ' has-error' : '' }}">
                                        <label class="form-label text-dark fw-bold">Nomor KTP Anggota<span class="text-danger">*</span></label>
                                        <input type="text" name="nik" placeholder="NIK KTP" class="form-control fw-bold txt-blue"
                                            value="{{ old('nik') }}" required="">
                                        @if ($errors->has('nik'))
                                        <div class="invalid-feedback">{{ $errors->first('nik') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label text-dark fw-bold">Nama Anggota Sesuai KTP<span class="text-danger">*</span></label>
                                        <input type="text" name="fullname" placeholder="Nama Sesuai KTP"
                                            class="form-control" required="" value="{{ old('fullname') }}">
                                        @if ($errors->has('fullname'))
                                        <div class="invalid-feedback">{{ $errors->first('fullname') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label text-dark fw-bold">Alamat Email Aktif<span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            required="" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label text-dark fw-bold">Nomor Telepon / WhatsApp<span class="text-danger">*</span></label>
                                        <input type="text" name="phone" placeholder="Nomor Telepon" class="form-control"
                                            required="" value="{{ old('phone') }}">
                                        @if ($errors->has('phone'))
                                        <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label text-dark fw-bold">Kota Kelahiran<span class="text-danger">*</span></label>
                                        <input type="text" name="city_born" placeholder="Kota Kelahiran"
                                            class="form-control" required="" value="{{ old('city_born') }}">
                                        @if ($errors->has('city_born'))
                                        <div class="invalid-feedback">{{ $errors->first('city_born') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label text-dark fw-bold">Tanggal Lahir<span class="text-danger">*</span></label>
                                        <input type="text" name="born" placeholder="Tanggal Lahir (1990-12-31)"
                                            class="form-control" value="{{ old('born') }}" id="datepicker" required>
                                        @if ($errors->has('born'))
                                        <div class="invalid-feedback">{{ $errors->first('born') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-dark fw-bold py-2">Provinsi KTP<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <select class="form-select" name="province_id" id="in_province_id" required>
                                            <option value="" selected="">Pilih Provinsi</option>
                                            @foreach ($province as $item)
                                            <option value="{{ $item->kode }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('province_id'))
                                        <div class="invalid-feedback">{{ $errors->first('province_id') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label text-dark fw-bold py-2">Kabupaten/ Kota<span class="text-danger">*</span></label>
                                    <div class="col-md-12 p-0">
                                        <div class="form-group">
                                            <select class="form-select" name="regency_id" id="in_regency_id" required>
                                                <option value="" selected="">Pilih Kabupaten/Kota</option>
                                            </select>
                                            @if ($errors->has('regency_id'))
                                            <div class="invalid-feedback">{{ $errors->first('regency_id') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-dark fw-bold py-2">Kecamatan<span class="text-danger">*</span></label>
                                    <div class="col-md-12 p-0">
                                        <div class="form-group">
                                            <select class="form-select" name="district_id" id="in_district_id" required>
                                                <option value="" selected="">Pilih Kecamatan</option>
                                            </select>
                                            @if ($errors->has('district_id'))
                                            <div class="invalid-feedback">{{ $errors->first('district_id') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-dark fw-bold py-2">Kelurahan<span class="text-danger">*</span></label>
                                    <div class="col-md-12 p-0">
                                        <div class="form-group">
                                            <select class="form-select" name="village_id" id="in_village_id" required>
                                                <option value="" selected="">Pilih Kelurahan</option>
                                            </select>
                                            @if ($errors->has('village_id'))
                                            <div class="invalid-feedback">{{ $errors->first('village_id') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-dark fw-bold py-2">Alamat Lengkap<span class="text-danger">*</span></label>
                                    <div class="col-md-12 p-0">
                                        <div class="form-group">
                                            <textarea name="address" class="form-control" rows="3"
                                                placeholder="Alamat Lengkap">{!! old('address') !!}</textarea>
                                            @if ($errors->has('address'))
                                            <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-dark fw-bold py-2">Jenis Kelamin<span class="text-danger">*</span></label>
                                    <div class="ps-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" value="Perempuan"
                                                id="genderPerempuan" @if(old('gender')=='Perempuan' ) checked @endif>
                                            <label class="form-check-label" for="genderPerempuan">
                                                Perempuan
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" value="Laki-Laki"
                                                id="genderLaki" @if(old('gender')=='Laki-Laki' ) checked @endif>
                                            <label class="form-check-label" for="genderLaki">
                                                Laki-laki
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('gender'))
                                    <div class="invalid-feedback">{{ $errors->first('gender') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-dark fw-bold py-2">Status Pernikahan<span class="text-danger">*</span></label>
                                    <div class="ps-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="perkawinan"
                                                value="Belum Menikah" id="perkawinan1"
                                                @if(old('perkawinan')=='Belum Menikah' ) checked @endif>
                                            <span class="checkmark"></span>
                                            <label class="form-check-label" for="perkawinan1">
                                                Belum Menikah
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="perkawinan"
                                                value="Menikah" id="perkawinan2" @if(old('perkawinan')=='Menikah' )
                                                checked @endif>
                                            <span class="checkmark"></span>
                                            <label class="form-check-label" for="perkawinan2">
                                                Menikah
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="perkawinan"
                                                value="Pernah Menikah" id="perkawinan3"
                                                @if(old('perkawinan')=='Pernah Menikah' ) checked @endif>
                                            <span class="checkmark"></span>
                                            <label class="form-check-label" for="perkawinan3">
                                                Pernah Menikah
                                            </label>
                                        </div>
                                        @if ($errors->has('status_ktp'))
                                        <div class="invalid-feedback">{{ $errors->first('status_ktp') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-dark fw-bold py-2">Upload KTP<span class="text-danger">*</span></label>
                                    <div class="col-md-12 p-0">
                                        <div class="form-group">
                                            <input type="file" name="file_ktp" class="form-control" required>
                                            <small id="emailHelp" class="form-text text-danger">File yang diijinkan
                                                adalah file
                                                gambar dengan ekstensi [.jpg/.jpeg/.png].</small>
                                            @if ($errors->has('file_ktp'))
                                            <div class="invalid-feedback">{{ $errors->first('file_ktp') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-dark fw-bold py-2">Upload NPWP<span class="text-danger">*</span></label>
                                    <div class="col-md-12 p-0">
                                        <div class="form-group">
                                            <input type="file" name="file_npwp" class="form-control" required>
                                            <small id="emailHelp" class="form-text text-danger">File yang diijinkan
                                                adalah file
                                                gambar dengan ekstensi [.jpg/.jpeg/.png].</small>
                                            @if ($errors->has('file_npwp'))
                                            <div class="invalid-feedback">{{ $errors->first('file_npwp') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 pt-5">
                                    <p>Bersama dengan ini saya menyatakan setuju untuk Data yang saya masukkan digunakan
                                        oleh IWPI untuk Kebutuhan pengecekkan, validasi dan lain lain.</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="agreement_1"
                                            id="agreement_1" required>
                                        <label class="form-check-label" for="agreement_1">
                                            Saya menyetujui & menerima seluruh konsekuensi dari aturan yang berlaku di
                                            IWPI
                                        </label>
                                    </div>
                                    @if ($errors->has('agreement_1'))
                                    <div class="invalid-feedback">{{ $errors->first('agreement_1') }}</div>
                                    @endif
                                    {!! htmlFormSnippet([
                                    "theme" => "light",
                                    "size" => "normal",
                                    "tabindex" => "3",
                                    "callback" => "enableBtn",
                                    ]) !!}
                                </div>
                            </div>
                            <div class="contact-page__btn">
                                <button class="thm-btn" type="submit" disabled="disabled" id="btn-submit">
                                    <span class="txt">
                                        Kirim Dokumen Pendaftaran <i class="fas fa-arrow-right"></i>
                                    </span>
                                </button>
                            </div>
                            <div class="text-mute block mt-5 font-light text-xs">
                                This site is protected by reCAPTCHA and the Google
                                <a class="text-gray-500 font-semibold" target="_blank"
                                    href="https://policies.google.com/privacy">Privacy
                                    Policy</a>
                                and
                                <a class="text-gray-500 font-semibold" target="_blank"
                                    href="https://policies.google.com/terms">Terms
                                    of Service</a>
                                apply.
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script type="text/javascript">
    function enableBtn() {
          const submitButton = document.getElementById("btn-submit");
          submitButton.removeAttribute("disabled");
        }

        function removeOptions(selectbox, judul) { var i; for(i = selectbox.options.length - 1 ; i >= 0 ; i--) { selectbox.remove(i);}
    option = document.createElement( 'option' ); option.text = judul; option.disabled = true; selectbox.add( option ); }
$('.format_npwp').mask('00.000.000.0-000.0000');
$( "#datepicker" ).datepicker({maxDate: "-17y", dateFormat: "yy-mm-dd"});
$('#in_province_id').change(function(){
        var prov=document.getElementById("in_province_id").value;
        $.ajax({
            type : 'POST',
            url  : "{{ config('nnd.link-online').'/list-region' }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": prov,
                "category": 'regency'
            },
            success: function(data){
                select = document.getElementById( 'in_regency_id' );
                removeOptions(select, 'Pilih Kota/Kabupaten');
                $.each(data, function (index, data) {
                    option = document.createElement( 'option' );
                    option.value = data.kode;
                    option.text = data.nama;
                    select.selectedIndex ="0";
                    select.add( option );
                });
            }
        });

        $("#in_regency_id").focus();
        $('#in_regency_id').prop('disabled', false);
        document.getElementById('in_regency_id').selectedIndex="1";


    });
    $('#in_regency_id').change(function(){
        var prov=document.getElementById("in_regency_id").value;
        $.ajax({
            type : 'POST',
            url  : "{{ config('nnd.link-online').'/list-region' }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": prov,
                "category": 'district'
            },
            success: function(data){
                select = document.getElementById( 'in_district_id' );
                removeOptions(select, 'Pilih Kecamatan');

                $.each(data, function (index, data) {
                    option = document.createElement( 'option' );
                    option.value = data.kode;
                    option.text = data.nama;
                    select.selectedIndex ="0";
                    select.add( option );
                });
            }
        });

        $("#in_district_id").focus();
        $('#in_district_id').prop('disabled', false);
        document.getElementById('in_district_id').selectedIndex="1";
    });

    $('#in_district_id').change(function(){
        var prov=document.getElementById("in_district_id").value;
        $.ajax({
            type : 'POST',
            url  : "{{ config('nnd.link-online').'/list-region' }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": prov,
                "category": 'village'
            },
            success: function(data){
                select = document.getElementById( 'in_village_id' );
                removeOptions(select, 'Pilih Kelurahan');

                $.each(data, function (index, data) {
                    option = document.createElement( 'option' );
                    option.value = data.kode;
                    option.text = data.nama;
                    select.selectedIndex ="0";
                    select.add( option );
                });
            }
        });

        $("#in_village_id").focus();
        $('#in_village_id').prop('disabled', false);
        document.getElementById('in_village_id').selectedIndex="1";
    });


</script>
@endsection
