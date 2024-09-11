@extends('layouts.master')
@section('title', 'Tambah Data Pengaduan')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('style')
<style>

.select2 {
  width: 100% !important;
}
.select2-container .select2-selection--single {
  border-color: #ced4da;
}

</style>
@endsection

@section('breadcrumb-title')
<h3>Tambah Data Pengaduan</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Data Pengaduan</li>
<li class="breadcrumb-item active">Tambah Data Pengaduan</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h5>Form Tambah Data Pengaduan</h5>
                </div>
                <div class="card-body add-post">
                    <form method="POST" action="{{ route('pengaduan-yellow-page.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Jenis Laporan<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
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
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kategori Instansi<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
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
                        <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kantor Praktisi</label>
                                <div class="col-sm-10">
                                    <div class="form-group {{ $errors->has('kantor') ? ' has-error' : '' }}">
                                <input type="text" name="kantor" placeholder="Nama Kantor Terlapor" class="form-control fw-bold"
                                    value="{{ old('kantor') }}">
                                @if ($errors->has('kantor'))
                                <div class="invalid-feedback">{{ $errors->first('kantor') }}</div>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kantor [Unit Kerja DJP/Kantor Praktisi]<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="form-group {{ $errors->has('unit_djp') ? ' has-error' : '' }}">
                                <select class="form-select select2" name="unit_djp">
                                    <option selected disabled value="">Pilih Kantor Unit Kerja</option>
                                    @foreach($djp as $item)
                                        <option value="{{ $item->nama_unit }}">{{ $item->nama_unit." "}} @if(!empty($item->kanwil)) [{{ $item->kanwil }}] @endif</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('unit_djp'))
                                <div class="invalid-feedback">{{ $errors->first('unit_djp') }}</div>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nama Lengkap [Pejabat/Oknum]<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <div class="form-group {{ $errors->has('fullname') ? ' has-error' : '' }}">
                                <input type="text" name="fullname" placeholder="Masukkan Nama Lengkap Terlapor" class="form-control fw-bold"
                                    value="{{ old('fullname') }}">
                                @if ($errors->has('fullname'))
                                <div class="invalid-feedback">{{ $errors->first('fullname') }}</div>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">NIP [Pejabat/Oknum]</label>
                                <div class="col-sm-10">
                                    <div class="form-group {{ $errors->has('nip') ? ' has-error' : '' }}">
                                <input type="text" name="nip" placeholder="NIP Terlapor" class="form-control fw-bold txt-blue"
                                    value="{{ old('nip') }}">
                                @if ($errors->has('nip'))
                                <div class="invalid-feedback">{{ $errors->first('nip') }}</div>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Jabatan [Pejabat/Oknum]</label>
                                <div class="col-sm-10">
                                    <div class="form-group {{ $errors->has('jabatan') ? ' has-error' : '' }}">
                                <input type="text" name="jabatan" placeholder="Jabatan Terlapor" class="form-control fw-bold txt-blue"
                                    value="{{ old('jabatan') }}" >
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label py-2">Jenis Kelamin<span class="text-danger">*</span></label>
                            <div class="col-md-10 ps-3">
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
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label py-2">Provinsi KTP<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
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
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label py-2">Kabupaten/ Kota<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
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
                        <div class="col-12 pt-2 text-end">
                            <button class="btn btn-primary" type="submit">Submit Data</button>
                            <button class="btn btn-light" type="reset">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('adm-assets/js/editor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('adm-assets/js/editor/ckeditor/adapters/jquery.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
    function removeOptions(selectbox, judul) { var i; for(i = selectbox.options.length - 1 ; i >= 0 ; i--) { selectbox.remove(i);}}
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
