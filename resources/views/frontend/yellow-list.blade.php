@extends('frontend.layouts.master')
@section('meta-seo')
<meta name="title" content="Yellow List - Ikatan Wajib Pajak Indonesia" />
<meta name="description" content="Yellow List - Ikatan Wajib Pajak Indonesia" />
<meta name="keywords"
    content="IWPI, Ikatan Wajib Pajak Indonesia, Wajib Pajak, Asosiasi Wajib Pajak, Perkumpulan Wajib Pajak, Pajak Indonesia, DJP, Melawan DJP, Pajak Transparan, Organisasi Pajak" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://iwipi.info/" />
<meta property="og:title" content="Yellow List - Ikatan Wajib Pajak Indonesia" />
<meta property="og:description" content="Yellow List - Ikatan Wajib Pajak Indonesia" />
<meta property="og:image" content="{{ asset('meta-seo.webp') }}" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="https://iwipi.info/" />
<meta property="twitter:title" content="Yellow List - Ikatan Wajib Pajak Indonesia" />
<meta property="twitter:description" content="Yellow List - Ikatan Wajib Pajak Indonesia" />
<meta property="twitter:image" content="{{ asset('meta-seo.webp') }}" />
@endsection
@section('header')
@include('frontend.layouts.header')
<style>
    .custom-table {
        min-width: 900px;
        /* font-family: var(--thm-heading-font); */
        font-family: 'Inter Tight', sans-serif;
    }

    .custom-table thead tr,
    .custom-table thead th {
        border-top: none;
        border-bottom: none !important;
    }

    .custom-table tbody th,
    .custom-table tbody td {
        color: #1b1b1b;
        font-weight: 600;
        padding-bottom: 20px;
        padding-top: 20px;
    }

    .custom-table tbody th small,
    .custom-table tbody td small {
        color: #707070;
        /* font-weight: 500; */
    }

    .custom-table tbody tr:not(.spacer) {
        border-radius: 7px;
        overflow: hidden;
        -webkit-transition: .3s all ease;
        -o-transition: .3s all ease;
        transition: .3s all ease;
    }

    .custom-table tbody tr:not(.spacer):hover {
        -webkit-box-shadow: 0 2px 10px -5px rgba(0, 0, 0, 0.1);
        box-shadow: 0 2px 10px -5px rgba(0, 0, 0, 0.1);
    }

    .custom-table tbody tr th,
    .custom-table tbody tr td {
        border: none;
    }
    .custom-table tbody tr td a{
        color: var(--thm-secondary);
    }

    .custom-table tbody tr th:first-child,
    .custom-table tbody tr td:first-child {
        border-top-left-radius: 7px;
        border-bottom-left-radius: 7px;
    }

    .custom-table tbody tr th:last-child,
    .custom-table tbody tr td:last-child {
        border-top-right-radius: 7px;
        border-bottom-right-radius: 7px;
    }

    .custom-table tbody tr.spacer td {
        padding: 0 !important;
        height: 10px;
        border-radius: 0 !important;
        background: transparent !important;
    }
</style>
@stop
@section('title', "Yellow List - Ikatan Wajib Pajak Indonesia")
@section('content')

<!--Start Page Header-->
<section class="page-header">
    <div class="shape1 rotate-me"><img src="{{ asset('assets/img/shape/page-header-shape1.png') }}" alt=""></div>
    <div class="shape2 float-bob-x"><img src="{{ asset('assets/img/shape/page-header-shape2.png') }}" alt=""></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>Yellow List</h2>
            <ul class="thm-breadcrumb">
                <li><a href="{{ route('/') }}"><span class="fa fa-home"></span> Home</a></li>
                <li><i class="icon-right-arrow-angle"></i></li>
                <li class="color-base">Yellow List</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->
 <!--Start Team One-->
 <section class="team-one">
    <div class="container">
        <div class="sec-title-four">
            <div class="sub-title">
                <h4>Keterangan Data</h4>
            </div>
            <h2>
                Anggota Fiskus / Praktisi Pajak<br>Terlapor di Organisasi
            </h2>
        </div>
        <div class="text">
            <p>Data dibawah ini merupakan hasil dari laporan masyarakat melalui form pelaporan Yellow list.<br />
                Oknum Fiskus / Praktisi yang terdata di list kami, patut untuk menjadi perhatian bagi wajib pajak<br />
                <b>
                    Jika anda mengalami kendala terkait perpajakan dapat melaporkan kepada kami melaui form degan cara klik
                    <a href="" class="fw-bold">disini</a></b>
            </p>
        </div>
        <div class="row mt-5">
            @for($i = 0; $i < 2; $i++)
            <!--Start Single Team One-->
            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="team-one__single">
                    <div class="team-one__single-img">
                        <img src="{{ asset('assets/img/icon/icon-man.webp') }}" alt="image">
                    </div>
                    <div class="team-one__single-title">
                        <h3><a href="#">Stiphen Jhonson</a></h3>
                        <p>KPP Madya Malang</p>
                    </div>
                </div>
            </div>
            <!--End Single Team One-->
            <!--Start Single Team One-->
            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInDown" data-wow-delay=".3s">
                <div class="team-one__single">
                    <div class="team-one__single-img">
                        <img src="{{ asset('assets/img/icon/icon-women.webp') }}" alt="image">
                    </div>
                    <div class="team-one__single-title">
                        <h3><a href="#">Michle Jhon Doe</a></h3>
                        <p>KPP Pratama Malang Utara</p>
                    </div>
                </div>
            </div>
            @endfor
            <!--End Single Team One-->
        </div>
    </div>
</section>
<!--End Team One-->
<!--Start Team One-->
<section class="team-one py-5">
    <div class="container">
        <div class="sec-title-four">
            <div class="sub-title">
                <h4>List Tabel Yellow List</h4>
            </div>
            <h2>
                Daftar Lengkap <br>Yellow Page Terlapor...
            </h2>
        </div>
        <table class="table custom-table">
            <thead>
                <tr>
                    <th scope="col">NIP</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Kantor/Jabatan</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr scope="row">
                    <td>
                        1392
                    </td>
                    <td><a href="#">James Yates</a></td>
                    <td>
                        Kantor Wilayah DJP Jawa Timur III
                        <small class="d-block">KPP Madya Malang</small>
                    </td>
                    <td>+63 983 0962 971</td>
                    <td>FISKUS</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<!--End Team One-->

@endsection
