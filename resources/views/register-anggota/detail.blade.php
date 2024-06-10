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
                    <h4>Action Detail</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('register-anggota.updatestatus',$user->id) }}" id="form-konfirmasi-anggota"
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
                                                @if($user->status == 'Waiting')
                                                <span class="badge badge-info blinking">Menunggu Konfirmasi</span>
                                                @elseif($user->status == 'Approve')
                                                <span class="badge badge-success">Anggota Telah Aktif Hingga {{ \Carbon\Carbon::parse($user->date_active)->format('d/m/Y')}}</span>
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
                                            <p>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y H:i:00') }}
                                            </p>
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

                        <div class="m-t-15 btn-group">
                            @if($user->status != 'Approve')
                            <a class="btn btn-block btn-info" href="javascript:void();" onclick="updatestat('Approve')">
                                <i class="fa fa-check-square me-1"></i>Setujui Pendaftaran
                            </a>
                            @endif
                            <div class="btn-group" role="group">
                                <button class="btn btn-danger dropdown-toggle" id="btnGroupDrop1" type="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="fa fa-times-circle me-1"></i>Tolak Pendaftaran</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="javascript:void();"
                                        onclick="updatestat('Decline')">Tolak Pendaftaran</a>
                                    <a class="dropdown-item" href="javascript:void();"
                                        onclick="updatestat('Blacklist')">Block Anggota</a>
                                    <a class="dropdown-item" href="javascript:void();"
                                        onclick="updatestat('Overdue')">Nonaktif Anggota</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr />
                    <div class="mt-1">
                        <h5 class="my-1"><i class="fa fa-info-circle me-1 text-primary"></i>Langkah menyetujui
                            pendaftaran anggota</h5>
                        <ol>
                            <li>Pastikan sebelum menyetujui permintaan pendaftaran anggota, seluruh data harap di
                                <b>Verifikasi secara manual</b> terlebih dahulu
                            </li>
                            <li>Hubungi Calon Anggota melalui nomor kontak yang telah di dimasukkan</li>
                            <li>Setelah Menyetujui Pendaftaran anggota, sistem akan memberikan nomor induk serta satu
                                link aktif sebagai bukti / Kartu Anggota Digital</li>
                            <li>
                                <ol>
                                    <li>Kirimkan Surat/ Ebook Terkait Hak, Kewajiban serta Aturan Anggota Partai</li>
                                    <li>Kirimkan Gambar Kartu Anggota Partai kepada anggota</li>
                                    <li>Kirimkan Link tersebut sebagai bukti sah</li>
                                </ol>
                            </li>
                            <li>Proses Pengiriman Kartu Anggota serta Ebook Terkait <b>dikirimkan secara Manual Oleh
                                    Admin Partai</b></li>
                        </ol>
                    </div>

                    <div class="mt-2 row">
                        <a class="btn btn-block btn-success btn-air-success btn-lg"
                            href="//wa.me/{{ fWaNumber($user->phone) }}" title="">
                            <i class="fa fa-whatsapp me-1"></i>Kirim Pesan WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header bg-danger" style="background: #990000 !important;">
                    <div class="media">
                        <img class="img-100 img-fluid m-r-20 rounded-circle update_img_6"
                            src="{{ asset('/assets/img/body-2.png') }}" alt="">
                        <div class="media-body mt-0 f-w-700">
                            <h4>{{ $user->fullname }}</h4>
                            <p>{{ $user->nik }}</p>
                            <ul>
                                <li><a href="{{ route('anggota.profile', $user->nik) }}" target="_blank" class="txt-light">Buka Kartu Anggota Digital</a></li>
                                <li><a href="{{ route('register-anggota.kartu-anggota', $user->nik) }}" target="_blank" class="txt-light">Download File Kartu Anggota</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body list-persons">
                    <div class="profile-mail">
                        <div class="email-general p-5 f-w-600 f-16">
                            <h5 class="mb-3 txt-primary f-w-700">Biodata Diri</h5>
                            <ul class="biodata">
                                <li>Nomor Anggota Partai<span class="font-danger">{{ $user->nik }}</span></li>
                                <li>Nama Lengkap <span class="font-primary">{{ $user->fullname }}</span></li>
                                <li>NIK <span class="font-primary">{{ $user->nik }}</span></li>
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
                                <li>Kecamatan<span class="font-primary">{{ $user->regency_name }}</span></li>
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
    function updatestat(params) {
        document.getElementById("set_user_status").value=params;
        if(confirm('Apakah anda yakin untuk mengkonfirmasi pendaftaran anggota Partai X?')) {
                $('#form-konfirmasi-anggota').submit();
        }
    }
</script>
@endsection
