@extends('frontend.layouts.master')
@section('meta-seo')
    <meta name="title" content="Download Dokumen - Ikatan Wajib Pajak Indonesia" />
    <meta name="description" content="Download Dokumen - Ikatan Wajib Pajak Indonesia" />
    <meta name="keywords"
        content="IWPI, Ikatan Wajib Pajak Indonesia, Wajib Pajak, Asosiasi Wajib Pajak, Perkumpulan Wajib Pajak, Pajak Indonesia, DJP, Melawan DJP, Pajak Transparan, Organisasi Pajak" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://iwipi.info/" />
    <meta property="og:title" content="Download Dokumen - Ikatan Wajib Pajak Indonesia" />
    <meta property="og:description" content="Download Dokumen - Ikatan Wajib Pajak Indonesia" />
    <meta property="og:image" content="{{ asset('meta-seo.webp') }}" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://iwipi.info/" />
    <meta property="twitter:title" content="Download Dokumen - Ikatan Wajib Pajak Indonesia" />
    <meta property="twitter:description" content="Download Dokumen - Ikatan Wajib Pajak Indonesia" />
    <meta property="twitter:image" content="{{ asset('meta-seo.webp') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! htmlScriptTagJsApi([
        'action' => 'homepage',
    ]) !!}
@endsection
@section('header')
    @include('frontend.layouts.header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
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

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 15px;
            right: 5px;
        }

        tbody>tr>td:nth-child(1),
        tr>th {
            text-align: center;
        }
    </style>
@stop
@section('title', 'Download Dokumen - Ikatan Wajib Pajak Indonesia')
@section('content')

    <!--Start Page Header-->
    <section class="page-header">
        <div class="shape1 rotate-me"><img src="{{ asset('assets/img/shape/page-header-shape1.png') }}" alt=""></div>
        <div class="shape2 float-bob-x"><img src="{{ asset('assets/img/shape/page-header-shape2.png') }}" alt=""></div>
        <div class="container">
            <div class="page-header__inner">
                <h2>Download Dokumen</h2>
                <ul class="thm-breadcrumb">
                    <li><a href="{{ route('/') }}"><span class="fa fa-home"></span> Home</a></li>
                    <li><i class="icon-right-arrow-angle"></i></li>
                    <li class="color-base">Download Dokumen</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Header-->
    <!--Start Contact Page-->
    <section class="contact-page pt-0">
        <div class="contact-page__bottom">
            <!--Start Contact Two-->
            <div class="contact-page__bottom-form">
                <div class="container">
                    <div class="contact-page__bottom-form-inner">
                        <div class="title-box">
                            <h2>Halaman <br />Download Dokumen</h2>
                            <p>Dokumen dibawah ini merupakan dokumen milik <b class="text-primary">Ikatan Wajib Pajak Indonesia</b>
                                harap menggunakan dokumen secara bijak
                            </p>

                        </div>
                        @if ($errors->any())
                            <div>
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Pemberitahuan</h4>
                                    <hr>
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="contact-page__bottom-form-inner-box">
                            <div class="row mt-5">
                                {{-- @foreach ($document as $item)
                                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                        <div class="team-one__single">
                                            <div class="team-one__single-img">
                                                <img src="{{ asset('assets/img/icon/icon-man.webp') }}" alt="">
                                            </div>
                                            <div class="team-one__single-title">
                                                <h3><a href="#">{{ $item['name'] }}</a></h3>
                                                <a href="{{ $item['loc'] }}" target="_blank" class="text-primary"><i class="fa fa-download"></i> Download
                                                    Dokumen</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach --}}
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Nama Dokumen</th>
                                                <th>Jenis Dokumen</th>
                                                <th>Link Download</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($document as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td class="text-lowercase">
                                                        @if ($item->jenis == 'docx' || $item->jenis == 'doc')
                                                            <i class="fa fa-file-word me-1 text-primary"></i>
                                                        @elseif($item->jenis == 'pdf')
                                                            <i class="fa fa-file-pdf me-1 text-danger"></i>
                                                        @elseif($item->jenis == 'zip')
                                                            <i class="fa fa-file-zipper me-1"></i>
                                                        @elseif($item->jenis == 'jpg')
                                                            <i class="fa fa-image me-1"></i>
                                                        @elseif($item->jenis == 'mp4')
                                                            <i class="fa fa-file-video me-1"></i>
                                                        @elseif($item->jenis == 'mp3')
                                                            <i class="fa fa-file-audio me-1"></i>
                                                        @else
                                                            <i class="fa fa-file me-1"></i>
                                                        @endif
                                                        {{ $item->jenis }}
                                                    </td>
                                                    <td class="text-center"><a href="{{ asset('/uploads/' . $item->file) }}" target="_blank" class="btn btn-sm btn-default fw-bold"><i
                                                                class="fa fa-download"></i>
                                                            Unduh Dokumen</a>
                                                    </td>
                                                    <td>{!! $item->keterangan ?? '-' !!}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Contact Two-->
                </div>
    </section>
    <!--End Contact Page-->

@endsection
