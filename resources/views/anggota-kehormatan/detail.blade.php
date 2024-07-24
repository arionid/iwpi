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
<li class="breadcrumb-item">Anggota Kehormatan</li>
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
                    <form action="{{ route('anggota-kehormatan.destroy',$user->id) }}" id="anggota-kehormatan-destroy"
                        class="theme-form" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="status" id="set_user_status">
                        <div class="collection-filter-block">
                            <ul class="pro-services ">
                                <li>
                                    <div class="media"><i data-feather="user"></i>
                                        <div class="media-body">
                                            <h5>Status Keanggotaan <br>
                                                @if($user->tgl_akhir)
                                                <span class="badge badge-success">Anggota Telah Aktif Hingga {{
                                                    \Carbon\Carbon::parse($user->tgl_akhir)->format('d/m/Y')}}</span>
                                                @endif
                                            </h5>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><i data-feather="mail"></i>
                                        <div class="media-body">
                                            <h5>Bidang Pekerjaan</h5>
                                            <p>{{ $user->bidang_pekerjaan }}</p>
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
                                            <p>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y H:i:00') }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><i data-feather="image"></i>
                                        <div class="media-body">
                                            <h5>Foto KTP</h5>
                                            <img src="{{ file_exists("uploads/".$user->file_ktp) ?
                                            asset("uploads/".$user->file_ktp) :
                                            "https://placehold.co/600x350/e8e5ff/7366ff?text=FOTO+KTP&font=Playfair+Displayn"
                                            }}" class="img-fluid">
                                            <p><a href="{{ asset("uploads/".$user->file_ktp) }}" target="_blank"
                                                    class="text-underline">Lihat Foto KTP </a></p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><i data-feather="image"></i>
                                        <div class="media-body">
                                            <h5>Foto NPWP</h5>
                                            <img src="{{ file_exists("uploads/".$user->file_npwp) ?
                                            asset("uploads/".$user->file_npwp) :
                                            "https://placehold.co/600x350/e8e5ff/7366ff?text=FOTO+KTP&font=Playfair+Displayn"
                                            }}" class="img-fluid">
                                            <p><a href="{{ asset("uploads/".$user->file_npwp) }}" target="_blank"
                                                    class="text-underline">Lihat Foto NPWP </a></p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><i data-feather="image"></i>
                                        <div class="media-body">
                                            <h5>Foto Bukti Dukung</h5>
                                            <img src="{{ file_exists("uploads/".$user->file_bukti_pekerjaan) ?
                                            asset("uploads/".$user->file_bukti_pekerjaan) :
                                            "https://placehold.co/600x350/e8e5ff/7366ff?text=FOTO+KTP&font=Playfair+Displayn"
                                            }}" class="img-fluid">
                                            <p><a href="{{ asset("uploads/".$user->file_bukti_pekerjaan) }}" target="_blank"
                                                    class="text-underline">Lihat File Bukti Dukung </a></p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                    <hr />

                    <div class="mt-2 row">
                        <a class="btn btn-block btn-success btn-air-success btn-lg"
                            href="//wa.me/{{ fWaNumber($user->phone) }}" title="">
                            <i class="fa fa-whatsapp me-1"></i>Kirim Pesan WhatsApp
                        </a>
                        <a class="btn btn-block btn-danger btn-air-danger btn-lg mt-2"
                            href="javascript:void(0);" onclick="updatestat()" title="">
                            <i class="fa fa-trash me-1"></i>Hapus Anggota Ini
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
                            <h4>{{ $user->fullname }}</h4>
                            <p>{{ $user->no_kta_kehormatan }}</p>
                            @if(!empty($user->no_kta_kehormatan))
                            <ul>
                                <li><a href="{{ route('anggota-kehormatan.kartu-anggota', $user->no_kta_kehormatan) }}" target="_blank" class="txt-light">Download File Kartu Anggota</a></li>
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body list-persons">
                    <div class="profile-mail">
                        <div class="email-general p-5 f-w-600 f-16">
                            <h5 class="mb-3 txt-primary f-w-700">Biodata Diri</h5>
                            <ul class="biodata">
                                <li>Nomor Anggota IWPI<span class="font-danger">{{ $user->no_kta_kehormatan }}</span></li>
                                <li>Nama Lengkap <span class="font-primary">{{ $user->fullname }}</span></li>
                                <li>NPWP 15 Digit <span class="font-primary">{{ $user->npwp }}</span></li>
                                <li>NIK <span class="font-primary">{{ $user->nik }}</span></li>
                                <li>Bidang Pekerjaan <span class="font-danger">{{ $user->bidang_pekerjaan }}</span></li>
                                <li>Jenis Kelamin <span class="font-primary">{{ $user->gender }}</span></li>
                                <li>Status Perkawinan <span class="font-primary">{{ $user->perkawinan }}</span></li>
                                <li>Tempat Tanggal Lahir <span class="font-primary">{{ $user->city_born.'
                                        '.\Carbon\Carbon::parse($user->born)->format('d/m/Y') }}</span></li>
                                <li>Usia <span class="font-primary">{{
                                        \Carbon\Carbon::parse($user->born)->diff(\Carbon\Carbon::now())->format('%y
                                        Tahun,
                                        %m Bulan and %d Hari'); }}</span></li>
                                <li>Alamat KTP<span class="font-primary"> <span>{!! $user->address !!}</span></li>
                                <li>Provinsi<span class="font-primary">{{ $user->provinces_name }}</span></li>
                                <li>Kota/Kabupaten<span class="font-primary">{{ $user->regency_name }}</span></li>
                                <li>Kecamatan<span class="font-primary">{{ $user->district_name }}</span></li>
                                <li>Kelurahan<span class="font-primary">{{ $user->village_name }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Zero Configuration  Ends-->
    </div>
</div>
<!-- /Row -->
@endsection

@section('script')
<script>
    function updatestat() {
        if(confirm('Apakah anda yakin untuk Menghapus anggota ini?')) {
                $('#anggota-kehormatan-destroy').submit();
        }
    }

</script>
@endsection
