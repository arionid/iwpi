@extends('frontend.layouts.master')
@section('meta-seo')
<!-- Primary Meta Tags -->
<meta name="title" content="Berita IWPI - Ikatan Wajib Pajak Indonesia" />
<meta name="description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta name="keywords" content="partai x, partaixid, satu bangsa satu kesatuan, partai politik, pemilu 2024" />
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://iwipi.info/" />
<meta property="og:title" content="Berita IWPI - Ikatan Wajib Pajak Indonesia" />
<meta property="og:description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta property="og:image" content="{{ asset('meta-seo.webp') }}" />
<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="https://iwipi.info/" />
<meta property="twitter:title" content="Berita IWPI - Ikatan Wajib Pajak Indonesia" />
<meta property="twitter:description"
    content="Ikatan Wajib Pajak Indonesia adalah wadah asosiasi bagi Wajib Pajak di seluruh Indonesia yang berbentuk Perkumpulan berbadan hukum" />
<meta property="twitter:image" content="{{ asset('meta-seo.webp') }}" />
@endsection
@section('header')
@include('frontend.layouts.header')
@stop
@section('title', 'Berita IWPI - Ikatan Wajib Pajak Indonesia')
@section('content')
<!--Start Page Header-->
<section class="page-header">
    <div class="shape1 rotate-me"><img src="{{ asset('assets/img/shape/page-header-shape1.png') }}" alt=""></div>
    <div class="shape2 float-bob-x"><img src="{{ asset('assets/img/shape/page-header-shape2.png') }}" alt=""></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>Artikel Terbaru</h2>
            <ul class="thm-breadcrumb">
                <li><a href="{{ route('/') }}"><span class="fa fa-home"></span> Home</a></li>
                <li><i class="icon-right-arrow-angle"></i></li>
                <li class="color-base">Artikel</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->
<!--Start Blog Page-->
<section class="blog-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 wow fadeInUp" data-wow-delay=".3s">
                <div class="blog-page__content">
                    @isset($blog)
                    @foreach ($blog as $item)
                    <!--Start Single Blog Page-->
                    <div class="blog-page__single">
                        <div class="blog-page__single-img">
                            <img src="{{ file_exists("uploads/".$item->featured_img) ?
                            asset("uploads/".$item->featured_img) : asset('assets/img/default-blog-landscape.webp') }}"
                            alt="IWPI - {{ $item->title }}">
                        </div>
                        <div class="blog-page__single-content">
                            <div class="meta-box">
                                <ul class="meta-info">
                                    <li>
                                        <div class="icon">
                                            <span class="icon-user"></span>
                                        </div>
                                        <p><a href="#">{{ $item->author->name ?? 'Admin PartaiX' }}</a></p>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-calendar"></span>
                                        </div>
                                        <p><a href="#">{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y')
                                                }}</a></p>
                                    </li>
                                </ul>
                            </div>
                            <div class="title-box">
                                <h3>
                                    <a href="{{ route('news.detail', $item->slug) }}">{{ $item->title }}</a>
                                </h3>
                                <p>{{ Str::limit(($item->excerpt ?? $item->content), 250) }}</p>
                            </div>
                            <div class="btn-box">
                                <a href="{{ route('news.detail', $item->slug) }}">
                                    Baca Selengkapnya
                                    <i class="icon-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--End Single Blog Page-->
                    @endforeach
                    @endisset
                </div>
            </div>
            <!--Start Sidebar-->
            @include('frontend.right-sidebar')
            <!--End Sidebar-->
        </div>
        {{ $blog->onEachSide(0)->links('vendor.pagination.pagination-frontend') }}
    </div>
</section>
<!--End Blog Three-->
@endsection
