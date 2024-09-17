@extends('frontend.layouts.master')
@section('meta-seo')
<meta name="title" content="Form Pengaduan Fiskus/Praktisi Pajak - Ikatan Wajib Pajak Indonesia" />
<meta name="description" content="Form Pengaduan Fiskus/Praktisi Pajak - Ikatan Wajib Pajak Indonesia" />
<meta name="keywords"
    content="IWPI, Ikatan Wajib Pajak Indonesia, Wajib Pajak, Asosiasi Wajib Pajak, Perkumpulan Wajib Pajak, Pajak Indonesia, DJP, Melawan DJP, Pajak Transparan, Organisasi Pajak" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://iwipi.info/" />
<meta property="og:title" content="Form Pengaduan Fiskus/Praktisi Pajak - Ikatan Wajib Pajak Indonesia" />
<meta property="og:description" content="Form Pengaduan Fiskus/Praktisi Pajak - Ikatan Wajib Pajak Indonesia" />
<meta property="og:image" content="{{ asset('meta-seo.webp') }}" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="https://iwipi.info/" />
<meta property="twitter:title" content="Form Pengaduan Fiskus/Praktisi Pajak - Ikatan Wajib Pajak Indonesia" />
<meta property="twitter:description" content="Form Pengaduan Fiskus/Praktisi Pajak - Ikatan Wajib Pajak Indonesia" />
<meta property="twitter:image" content="{{ asset('meta-seo.webp') }}" /><meta name="csrf-token" content="{{ csrf_token() }}">
{!! htmlScriptTagJsApi([
'action' => 'homepage',
]) !!}
@endsection
@section('header')
@include('frontend.layouts.header')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>


.select2-container--default .select2-selection--single{
    height: unset;
    color: var(--thm-black);
    font-size: 16px;
    font-weight: 600;
    width: 100%;
    border: 0px solid #e4e4e4;
    background: #ffffff;
    padding: 15px 25px 15px;
    outline: none;
    transition: all 200ms linear;
    transition-delay: 0.1s;
    border-radius: 0px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow{
    top: 15px;
    right: 5px;
}

</style>
@stop
@section('title', "Form Pengaduan Fiskus/Praktisi Pajak - Ikatan Wajib Pajak Indonesia")
@section('content')

<!--Start Page Header-->
<section class="page-header">
    <div class="shape1 rotate-me"><img src="{{ asset('assets/img/shape/page-header-shape1.png') }}" alt=""></div>
    <div class="shape2 float-bob-x"><img src="{{ asset('assets/img/shape/page-header-shape2.png') }}" alt=""></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>Form Pengaduan <br />Fiskus/Praktisi Pajak</h2>
            <ul class="thm-breadcrumb">
                <li><a href="{{ route('/') }}"><span class="fa fa-home"></span> Home</a></li>
                <li><i class="icon-right-arrow-angle"></i></li>
                <li class="color-base">Form Pengaduan Fiskus/Praktisi Pajak</li>
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
                <h2>Pengaduan Berhasil Dikirim</h2>
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
                        <h2>Form Pengaduan <br />Fiskus/Praktisi Pajak</h2>
                        <p>Pengaduan ini merupakan fasilitas untuk menyampaikan keluhan kepada <b class="text-primary">Anggota/ Karyawan/ Oknum/ Pejabat Fiskus/ Praktisi Pajak </b> atas pelayanan pelaksanaan yang tidak sesuai dengan Standar Pelayanan, atau pengabaian kewajiban dan/ atau pelanggaran larangan terkait pelayanan pajak.</p>
                        <p>*Data Kontak Pelapor bersifat rahasia, data yang di inputkan untuk validasi dan menginformasikan perkembangan terkait pengaduan yang disampaikan.</p>
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
                        <form method="POST" action="{{ route('submit-form-pengaduan') }}" enctype="multipart/form-data"
                            class="contact-page__form">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label text-dark fw-bold">Nama Pelapor<span class="text-danger">*</span></label>
                                        <input type="text" name="nama_pelapor" placeholder="Nama Pelapor" class="form-control"
                                            required="" value="{{ old('nama_pelapor') }}" required>
                                        @if ($errors->has('nama_pelapor'))
                                        <div class="invalid-feedback">{{ $errors->first('nama_pelapor') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-dark fw-bold">Peran Pelapor<span class="text-danger">*</span></label>
                                        <select class="form-select" name="peran_pelapor" required>
                                            <option value="" selected="">Peran Pelapor Sebagai</option>
                                            <option {{ old('peran_pelapor') == 'Wajib Pajak' ? "selected" : "" }}>Wajib Pajak</option>
                                            <option {{ old('peran_pelapor') == 'Kuasa Hukum' ? "selected" : "" }}>Kuasa Hukum</option>
                                        </select>
                                        @if ($errors->has('peran_pelapor'))
                                        <div class="invalid-feedback">{{ $errors->first('peran_pelapor') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="form-label text-dark fw-bold">Kontak Pelapor [Email/No Telepon]<span class="text-danger">*</span></label>
                                        <input type="text" name="tlp_pelapor" placeholder="Nomor Telepon" class="form-control"
                                            required="" value="{{ old('tlp_pelapor') }}">
                                        @if ($errors->has('tlp_pelapor'))
                                        <div class="invalid-feedback">{{ $errors->first('tlp_pelapor') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-dark fw-bold">Jenis Laporan<span class="text-danger">*</span></label>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="form-select" name="jenis_pengaduan" id="in_jenis_pengaduan" required>
                                                <option value="" selected="">Pilih Jenis Laporan</option>
                                                <option {{ old('jenis_pengaduan') == 'Pelayanan Perpajakan' ? "selected" : "" }}>Pelayanan Perpajakan</option>
                                                <option {{ old('jenis_pengaduan') == 'Pelanggaran Kode Etik & Disiplin' ? "selected" : "" }}>Pelanggaran Kode Etik & Disiplin</option>
                                                <option {{ old('jenis_pengaduan') == 'Tindak Pidana Perpajakan' ? "selected" : "" }}>Tindak Pidana Perpajakan</option>
                                            </select>
                                            @if ($errors->has('jenis_pengaduan'))
                                            <div class="invalid-feedback">{{ $errors->first('jenis_pengaduan') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 py-3">
                                    <label class="form-label text-dark fw-bold">Kategori Instansi<span class="text-danger">*</span></label>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="form-select" name="kategori" id="in_kategori" required>
                                                <option value="" selected="">Pilih Kategori Instansi</option>
                                                <option {{ old('kategori') == 'Fiskus' ? "selected" : "" }}>Fiskus</option>
                                                <option {{ old('kategori') == 'Praktisi Pajak' ? "selected" : "" }}>Praktisi Pajak</option>
                                            </select>
                                            @if ($errors->has('kategori'))
                                            <div class="invalid-feedback">{{ $errors->first('kategori') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('kantor') ? ' has-error' : '' }}">
                                        <label class="form-label text-dark fw-bold">Kantor Praktisi</label>
                                        <input type="text" name="kantor" placeholder="Nama Kantor Terlapor" class="form-control fw-bold"
                                            value="{{ old('kantor') }}">
                                        @if ($errors->has('kantor'))
                                        <div class="invalid-feedback">{{ $errors->first('kantor') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 py-3">
                                    <div class="form-group {{ $errors->has('unit_djp') ? ' has-error' : '' }}">
                                        <label class="form-label text-dark fw-bold">Kantor [Unit Kerja DJP/Kantor Praktisi]<span class="text-danger">*</span></label>
                                        <select class="form-select select2" name="unit_djp">
                                            @foreach($djp as $item)
                                                <option value="{{ $item->nama_unit }}">{{ $item->nama_unit." "}} @if(!empty($item->kanwil)) [{{ $item->kanwil }}] @endif</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('unit_djp'))
                                        <div class="invalid-feedback">{{ $errors->first('unit_djp') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('fullname') ? ' has-error' : '' }}">
                                        <label class="form-label text-dark fw-bold">Nama Lengkap [Pejabat/Oknum]<span class="text-danger">*</span></label>
                                        <input type="text" name="fullname" placeholder="Masukkan Nama Lengkap Terlapor" class="form-control fw-bold"
                                            value="{{ old('fullname') }}">
                                        @if ($errors->has('fullname'))
                                        <div class="invalid-feedback">{{ $errors->first('fullname') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('nip') ? ' has-error' : '' }}">
                                        <label class="form-label text-dark fw-bold">NIP [Pejabat/Oknum]</label>
                                        <input type="text" name="nip" placeholder="NIP Terlapor" class="form-control fw-bold txt-blue"
                                            value="{{ old('nip') }}">
                                        @if ($errors->has('nip'))
                                        <div class="invalid-feedback">{{ $errors->first('nip') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('jabatan') ? ' has-error' : '' }}">
                                        <label class="form-label text-dark fw-bold">Jabatan [Pejabat/Oknum]</label>
                                        <input type="text" name="jabatan" placeholder="Jabatan Terlapor" class="form-control fw-bold txt-blue"
                                            value="{{ old('jabatan') }}" >
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
                                    <label class="form-label text-dark fw-bold py-2">Kronologi Laporan<span class="text-danger">*</span></label>
                                    <div class="col-md-12 p-0">
                                        <div class="form-group">
                                            <textarea name="kronologi" class="form-control" rows="3"
                                                placeholder="Menceritakan Kronologis Kejadian yang ingin di Laporkan.">{!! old('kronologi') !!}</textarea>
                                            @if ($errors->has('kronologi'))
                                            <div class="invalid-feedback">{{ $errors->first('kronologi') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-dark fw-bold py-2">Upload Lampiran</label>
                                    <div class="col-md-12 p-0">
                                        <div class="form-group">
                                            <input type="file" name="file[]" class="form-control" multiple>
                                            <small id="emailHelp" class="form-text text-danger">File yang diijinkan
                                                adalah file dokumen dengan ekstensi [.doc/.pdf/.zip].<br />
                                            Anda dapat upload lebih dari satu dokumen</small>
                                            @if ($errors->has('file_ktp'))
                                            <div class="invalid-feedback">{{ $errors->first('file_ktp') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 pt-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="agreement_1"
                                            id="agreement_1" required>
                                        <label class="form-check-label" for="agreement_1">
                                            Dengan ini saya menyatakan laporan yang saya buat adalah kejadian yang sebenar-benarnya terjadi.
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
                                <button class="thm-btn" type="submit"  disabled="disabled" id="btn-submit">
                                    <span class="txt">
                                        Kirim Pengaduan <i class="fas fa-arrow-right"></i>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2();
});
    function enableBtn() {
          const submitButton = document.getElementById("btn-submit");
          submitButton.removeAttribute("disabled");
        }

        function removeOptions(selectbox, judul) { var i; for(i = selectbox.options.length - 1 ; i >= 0 ; i--) { selectbox.remove(i);}
    option = document.createElement( 'option' ); option.text = judul; option.disabled = true; selectbox.add( option ); }
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


</script>
@endsection
