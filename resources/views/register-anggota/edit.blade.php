@extends('layouts.master')
@section('title', 'Profile')
@section('css')
@endsection
@section('style')
<style>
    .media-body {
        opacity: 1 !important;
    }

    .blinking {
        animation: blinker 1s linear infinite;
    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
</style>
@endsection
@section('breadcrumb-title')
<h3>Data Register Anggota</h3>
@endsection
@section('breadcrumb-items')
<li class="breadcrumb-item">Register Anggota</li>
<li class="breadcrumb-item active">Detail Data</li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-center">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    <h4>Action Detail</h4>
                </div>
                <div class="card-body">
                    <div class="collection-filter-block">
                        <ul class="pro-services ">
                            <li>
                                <div class="media"><i data-feather="user"></i>
                                    <div class="media-body">
                                        <h5>Status Keanggotaan <br>
                                            @if($user->status == 'Waiting')
                                            <span class="badge badge-info blinking">Menunggu Konfirmasi</span>
                                            @elseif($user->status == 'Approve')
                                            <span class="badge badge-success">Anggota Telah Aktif Hingga {{
                                                \Carbon\Carbon::parse($user->date_active)->format('d/m/Y')}}</span>
                                            @else
                                            <span class="badge badge-default">{{ $user->status }}</span>
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media"><i data-feather="mail"></i>
                                    <div class="media-body">
                                        <h5>Email Terdaftar</h5>
                                        <a href="mailto:{{ $user->email ?? '' }}">{{ $user->email ?? '' }}</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media"><i data-feather="phone"></i>
                                    <div class="media-body">
                                        <h5>No. Telepon / No. Whatsapp </h5>
                                        <a href="tel:{{ $user->phone }}" class="text-success"><i
                                                class="fa fa-whatsapp me-1 "></i>{{
                                            $user->phone }}</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media"><i data-feather="clock"></i>
                                    <div class="media-body">
                                        <h5>Waktu Pendaftaran</h5>
                                        <p>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y H:i:00') }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media"><i data-feather="image"></i>
                                    <div class="media-body">
                                        <h5>Foto KTP</h5>
                                        <img src="{{ file_exists("storage/".$user->file_ktp) ?
                                        asset("storage/".$user->file_ktp) :
                                        "https://placehold.co/600x350/e8e5ff/7366ff?text=FOTO+KTP&font=Playfair+Displayn"
                                        }}" class="img-fluid">
                                        <p><a href="{{ asset("storage/".$user->file_ktp) }}" target="_blank"
                                                class="text-underline">Lihat Foto KTP </a></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-2 row">
                        <a class="btn btn-block btn-success btn-air-success btn-lg fw-bold" href="cart.html" title="">
                            <i class="fa fa-whatsapp me-1 text-success fw-bold"></i>Kirim Pesan WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <h3>Data Diri <b class="text-primary">{{ $user->fullname }}</b></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('register-anggota.update',$user->id) }}" class="theme-form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 row fw-bold text-danger">
                            <label class="col-sm-3 col-form-label ">NOMOR ANGGOTA PARTAI</label>
                            <div class="col-sm-9">
                                <input class="form-control fw-bold text-danger" type="text" value="{{ $user->nik }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="nik" value="{{ $user->nik }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="fullname" value="{{ $user->fullname }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Tempat Tanggal Lahir</label>
                            <div class="col-sm-9 row">
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="city_born"
                                        value="{{ $user->city_born }}">
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="born" value="{{ $user->born }}">
                                </div>
                                <span class="pt-1 ms-2 fw-bold"><code>Usia Saat Ini :</code> {{
                                    \Carbon\Carbon::parse($user->born)->diff(\Carbon\Carbon::now())->format('%y Tahun,
                                    %m Bulan and %d Hari'); }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Alamat KTP</label>
                            <div class="col-sm-9">
                                <textarea name="address" class="form-control" readonly>{!! $user->address !!}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="province_id" id="in_province_id" required>
                                    <option value="" selected="" disabled>Pilih Provinsi</option>
                                    @foreach ($province as $item)
                                    <option value="{{ $item->id }}" @if($item->id == $user->province_id) selected
                                        @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Kota/Kabupaten</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="regency_id" id="in_regency_id" required>
                                    <option value="{{ $user->regency_id }}">{{ $user->regency_name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="district_id" id="in_district_id" required>
                                    <option value="{{ $user->district_id }}">{{ $user->district_name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Kelurahan</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="village_id" id="in_village_id" required>
                                    <option value="{{ $user->village_id }}">{{ $user->village_name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="gender">
                                    <option @if($user->gender == 'Perempuan') selected @endif >Perempuan</option>
                                    <option @if($user->gender == 'Laki-laki') selected @endif>Laki-laki</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Status Perkawinan</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="perkawinan">
                                    <option @if($user->perkawinan == 'Belum Menikah') selected @endif >Belum Menikah
                                    </option>
                                    <option @if($user->perkawinan == 'Menikah') selected @endif>Menikah</option>
                                    <option @if($user->perkawinan == 'Pernah Menikah') selected @endif>Pernah Menikah
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input name="email" class="form-control" id="inputEmail" type="email"
                                    placeholder="Email" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">No. Telepon</label>
                            <div class="col-sm-9">
                                <input name="phone" class="form-control" type="text"
                                    placeholder="No. Telepon" value="{{ $user->phone }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label fw-bold txt-primary">Jabatan Partai</label>
                            <div class="col-sm-9">
                                <input name="jabatan" class="form-control fw-bold txt-primary" type="text"
                                    placeholder="Jabatan" value="{{ $user->jabatan }}">
                            </div>
                        </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary m-r-10" type="submit">Submit</button>
                    <input class="btn btn-light" type="reset" value="Cancel"></div>
                </form>
            </div>
        </div>
        <!-- Zero Configuration  Ends-->
    </div>
</div>
<!-- /Row -->
@endsection
@section('script')
<script type="text/javascript">
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
                option.value = data.id;
                option.text = data.name;
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
                option.value = data.id;
                option.text = data.name;
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
                option.value = data.id;
                option.text = data.name;
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
