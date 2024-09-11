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

    ul.biodata li {
        color: #000 !important;
        border-bottom: 1px solid #e6e6e6;
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
                    <h4>Detail Pengaduan</h4>
                </div>
                <div class="card-body">
                    <form class="theme-form" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $data->id }}">
                        <input type="hidden" name="status" id="set_user_status">
                        <div class="collection-filter-block">
                            <ul class="pro-services ">
                                <li>
                                    <div class="media"><i data-feather="chevrons-right"></i>
                                        <div class="media-body">
                                            <h5>Status Pengaduan <br>
                                                @if($data->status == 0)
                                                    <span class="badge badge-info blinking">UNPUBLISH</span>
                                                @elseif($data->status ==1)
                                                <span class="badge badge-success">PUBLISH</span>
                                                @endif
                                            </h5>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><i data-feather="chevrons-right"></i>
                                        <div class="media-body">
                                            <h5>Jenis Pengaduan</h5>
                                            <p>{{ $data->jenis_pengaduan }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><i data-feather="chevrons-right"></i>
                                        <div class="media-body">
                                            <h5>Kategori</h5>
                                            <p>{{ $data->unit_djp }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><i data-feather="phone"></i>
                                        <div class="media-body">
                                            <h5>Kontak Pelapor</h5>
                                            {{ $data->pelapor }}
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><i data-feather="clock"></i>
                                        <div class="media-body">
                                            <h5>Waktu Pengaduan</h5>
                                            <p>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:00') }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                    <hr />

                    <div class="mt-2 row">
                        <a class="btn btn-block  @if($data->status == 1) btn-warning btn-air-warning @else btn-success btn-air-success @endif btn-lg"
                            href="javascript:void(0);" onclick="updatestat()" title="Update Status Pengaduan">
                            @if($data->status == 1) <i class="fa fa-exclamation-circle"></i> @else<i class="fa fa-check-circle"></i>@endif Update Status Pengaduan
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header bg-danger" style="background: #394f89 !important;">
                    <div class="media">
                        <img class="img-100 img-fluid m-r-20 rounded-circle update_img_6"
                            src="{{ asset('/assets/img/logo-white.webp') }}" alt="">
                        <div class="media-body mt-0 f-w-700">
                            <h4>DATA TERLAPOR</h4>
                            <p>Data terlapor dan kronologi kejadian</p>
                        </div>
                    </div>
                </div>
                <div class="card-body list-persons">
                    <div class="profile-mail">
                        <div class="email-general p-5 f-w-600 f-16">
                            <h5 class="mb-3 txt-primary f-w-700">Detail Data</h5>
                            <ul class="biodata">
                                <li>Nama Lengkap <span class="font-primary">{{ $data->fullname }}</span></li>
                                <li>NIP <span class="font-primary">{{ $data->nip }}</span></li>
                                <li>Jabatan <span class="font-primary">{{ $data->jabatan }}</span></li>
                                <li>Jenis Kelamin <span class="font-primary">{{ $data->gender }}</span></li>
                                <li>Provinsi<span class="font-primary">{{ $data->provinces_name }}</span></li>
                                <li>Kota/Kabupaten<span class="font-primary">{{ $data->regency_name }}</span></li>
                            </ul>
                            <h5 class="mt-5 mb-3 txt-primary f-w-700">Kronologi: </h5>
                            {!! $data->kronologi !!}


                            <h5 class="mt-5 mb-3 txt-primary f-w-700">Bukti Dokumen: </h5>
                            <ol>
                                @foreach ($bukti as $item)
                                <li>
                                    <a href="{{ asset('/uploads/'. $item) }}" target="_blank">Dokumen Bukti</a>
                                </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Zero Configuration  Ends-->
    </div>
</div>
<!-- /Row -->
<form id="form-konfirmasi-anggota" action="{{ route('pengaduan-yellow-page.publish-status') }}" method="POST">
    @csrf
    @method('post')
    <input type="hidden" name="id" value="{{ $data->id }}" id="dataPelapor" />
</form>
@endsection
@section('script')
<script>
    function updatestat(params) {
        if(confirm('Apakah anda yakin untuk merubah status pengaduan ini?')) {
            $('#form-konfirmasi-anggota').submit();
        }
    }
</script>
@endsection
