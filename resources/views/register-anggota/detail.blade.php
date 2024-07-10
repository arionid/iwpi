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
                                                    <span class="badge badge-info blinking">{{ $user->detail->status }}</span>
                                                @elseif($user->status == 'Approve')
                                                <span class="badge badge-success">Anggota Telah Aktif Hingga {{
                                                    \Carbon\Carbon::parse($user->date_active)->format('d/m/Y')}}</span>
                                                @else
                                                <span class="badge badge-secondary">{{ $user->status }}</span>
                                                @endif
                                            </h5>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><i data-feather="mail"></i>
                                        <div class="media-body">
                                            <h5>Jenis Layanan</h5>
                                            <p>{{ $user->detail->layanan }}</p>
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
                            </ul>
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
                                    <li>Kirimkan Surat/ Ebook Terkait Hak, Kewajiban serta Aturan Organisasi</li>
                                    <li>Kirimkan Gambar Kartu Anggota kepada anggota</li>
                                    <li>Kirimkan Link tersebut sebagai bukti sah</li>
                                </ol>
                            </li>
                            <li>Proses Pengiriman Kartu Anggota serta Ebook Terkait <b>dikirimkan secara Manual Oleh Admin</b></li>
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
            @if($user->status == "Waiting" && ($user->detail->status =="Menunggu Validasi" ))
            <div class="card">
                <div class="card-header">
                    <h4>Bukti Pembayaran</h4>
                </div>
                <div class="card-body">
                    <div class="collection-filter-block">
                        <ul class="pro-services">
                            <li>
                                <div class="media"><i data-feather="image"></i>
                                    <div class="media-body">
                                        <h5>Bukti Pembayaran</h5>
                                        <img src="{{ file_exists("uploads/".$user->detail->bukti_bayar) ?
                                        asset("uploads/".$user->detail->bukti_bayar) :
                                        "https://placehold.co/600x350/e8e5ff/7366ff?text=FOTO+KTP&font=Playfair+Displayn"
                                        }}" class="img-fluid">
                                        <p><a href="{{ asset("uploads/".$user->detail->bukti_bayar) }}" target="_blank"
                                                class="text-underline">Lihat Bukti Bayar </a></p>
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
                </div>
            </div>
            @endif

            @if($user->status == "Waiting" && ( isset($user->payment_detail) && $user->payment_detail->status != 'payment_detail') )
            <div class="card">
                <div class="card-header bg-info">
                    <h4>Midtrans Payment</h4>
                </div>
                <div class="card-body">
                    <div class="collection-filter-block">
                        <ul class="pro-services ">
                            <li>
                                <div class="media"><i data-feather="info"></i>
                                    <div class="media-body">
                                        <h5>Status Pembayaran <br>
                                            @if(in_array($user->payment_detail->status, array('deny','expired','cancel')))
                                                <span class="badge badge-danger blinking">{{ $user->payment_detail->status }}</span>
                                            @else
                                            <span class="badge badge-success">{{ $user->payment_detail->status }}</span>
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media"><i data-feather="link"></i>
                                    <div class="media-body">
                                        <h5>Link Pembayaran</h5>
                                        <a href="{{ $user->payment_detail->payment_link_id }}" target="_blank">Buka link</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media"><i data-feather="mail"></i>
                                    <div class="media-body">
                                        <h5>Order ID</h5>
                                        <p>{{ $user->payment_detail->order_id }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media"><i data-feather="clock"></i>
                                    <div class="media-body">
                                        <h5>Waktu expired</h5>
                                        <p>{{ \Carbon\Carbon::parse($user->payment_detail->expired_at)->format('d M Y H:i:00') }}<br>
                                            <i>{{ \Carbon\Carbon::parse($user->payment_detail->expired_at)->diffForHumans() }}</i>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="m-t-15 btn-group">
                        @if(in_array($user->payment_detail->status, array('deny','expired','cancel')))
                        <a class="btn btn-block btn-info" href="javascript:void();" onclick="newrequest({{ $user->payment_detail->id }})">
                            <i class="fa fa-check-square me-1"></i>Request Link Pembayaran
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header bg-danger" style="background: #394f89 !important;">
                    <div class="media">
                        <img class="img-100 img-fluid m-r-20 rounded-circle update_img_6"
                            src="{{ asset('/assets/img/logo-white.webp') }}" alt="">
                        <div class="media-body mt-0 f-w-700">
                            <h4>{{ $user->fullname }}</h4>
                            <p>{{ $user->npwp }}</p>
                            @if(!empty($user->detail->nomor_anggota))
                            <ul>
                                <li><a href="{{ route('register-anggota.kartu-anggota', $user->detail->nomor_anggota) }}" target="_blank" class="txt-light">Download File Kartu Anggota</a></li>
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
                                <li>Nomor Anggota IWPI<span class="font-danger">{{ (!empty($user->detail->nomor_anggota)) ? $user->detail->nomor_anggota : $user->village_id.".".sprintf( '%04d', $user->id ) }}</span></li>
                                <li>Nama Lengkap <span class="font-primary">{{ $user->fullname }}</span></li>
                                <li>NPWP 15 Digit <span class="font-primary">{{ $user->npwp }}</span></li>
                                <li>NIK <span class="font-primary">{{ $user->nik }}</span></li>
                                <li>Perusahaan / Perseorangan <span class="font-primary">{{ $user->perusahaan ?? "Perseorangan" }}</span></li>
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
<form id="new-request" action="{{ route('midtrans.request-new-payment-link') }}" method="POST" class="d-none">
    <input type="hidden" name="payment_id" value="{{ $user->payment_detail->id ?? '' }}">
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    @csrf
</form>

@endsection

@section('script')
<script>
    function updatestat(params) {
        document.getElementById("set_user_status").value=params;
        if(confirm('Apakah anda yakin untuk merubah status Akun ini?')) {
                $('#form-konfirmasi-anggota').submit();
        }
    }

    function newrequest(params) {
        if(confirm('Apakah anda yakin untuk membuat link pembayaran baru?')) {
                $('#new-request').submit();
        }
    }
</script>
@endsection
