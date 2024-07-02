@extends('frontend.layouts.master')
@section('meta-seo')
<meta name="title" content="{{ ($blog->meta_title != '') ? $blog->meta_title : $blog->title }}" />
<meta name="description"
    content="{{ ($blog->meta_description != '') ? $blog->meta_description : \Str::limit($blog->excerpt,160) }}" />
<meta name="keywords" content="IWPI, Ikatan Wajib Pajak Indonesia, Wajib Pajak, Asosiasi Wajib Pajak, Perkumpulan Wajib Pajak, Pajak Indonesia, DJP, Melawan DJP, Pajak Transparan, Organisasi Pajak" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://iwipi.info/" />
<meta property="og:title" content="{{ ($blog->meta_title != '') ? $blog->meta_title : $blog->title }}" />
<meta property="og:description"
    content="{{ ($blog->meta_description != '') ? $blog->meta_description : \Str::limit($blog->excerpt, 160) }}" />
<meta property="og:image" content="{{ asset('meta-seo.webp') }}" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="https://iwipi.info/" />
<meta property="twitter:title" content="{{ ($blog->meta_title != '') ? $blog->meta_title : $blog->title }}" />
<meta property="twitter:description"
    content="{{ ($blog->meta_description != '') ? $blog->meta_description : \Str::limit($blog->excerpt,160) }}" />
<meta property="twitter:image" content="{{ asset('meta-seo.webp') }}" />
@endsection
@section('header')
@include('frontend.layouts.header')
@stop
@section('title', $blog->title)
@section('content')

<!--Start Page Header-->
<section class="page-header">
    <div class="shape1 rotate-me"><img src="{{ asset('assets/img/shape/page-header-shape1.png') }}" alt=""></div>
    <div class="shape2 float-bob-x"><img src="{{ asset('assets/img/shape/page-header-shape2.png') }}" alt=""></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>Blog Details</h2>
            <ul class="thm-breadcrumb">
                <li><a href="{{ route('/') }}"><span class="fa fa-home"></span> Home</a></li>
                <li><i class="icon-right-arrow-angle"></i></li>
                <li class="color-base">Blog Details</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->
<!--Start Blog Details-->
<section class="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 wow fadeInUp" data-wow-delay=".3s">
                <div class="blog-details__content">
                    <div class="blog-details__img-box1">
                        @if( file_exists("uploads/".$blog->featured_img) )
                        <div class="blog-details__img1">
                            <img src="{{ file_exists("uploads/".$blog->featured_img) ?
                            asset("uploads/".$blog->featured_img) : asset('assets/img/default-blog-potrait.png') }}"
                            alt="image">
                        </div>
                        @endif
                        <div class="blog-details-img1__content">
                            <div class="meta-box">
                                <ul class="meta-info">
                                    <li>
                                        <div class="icon">
                                            <span class="icon-user"></span>
                                        </div>
                                        <p><a href="#">Admin</a></p>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-calendar"></span>
                                        </div>
                                        <p><a href="#">{{ \Carbon\Carbon::parse($blog->created_at)->format('d F Y')
                                                }}</a></p>
                                    </li>
                                </ul>
                            </div>
                            <div class="title-box">
                                <h2>
                                    <a href="#">{{ $blog->title }}</a>
                                </h2>
                            </div>
                            <div class="text-box">
                                {!! $blog->content !!}
                            </div>
                        </div>
                    </div>
                    <div class="blog-details__tag-share">
                        <div class="tag2">
                            <div class="text">
                                <p>Kategori:</p>
                            </div>
                            <ul class="tag2-list">
                                <li>
                                    <a href="#">{{ $blog->category->name ? Str::title($blog->category->name) : 'Artikel'
                                        }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="share-link">
                            <div class="text">
                                <p>Share:</p>
                            </div>
                            <ul class="share-link-list clearfix">
                                <li>
                                    <a href="www.facebook.com">
                                        <span class="icon-facebook"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="www.twitter.com" class="bg-color1">
                                        <span class="icon-twitter"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="www.pinterest.com" class="bg-color2">
                                        <span class="fa-brands fa-whatsapp"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="blog-details__prev-next-option">
                        <div class="single-box left">
                            <div class="icon">
                                <a href="{{ ($previous) ? route('news.detail', $previous->slug) : '#'}}"><span
                                        class="icon-left-arrow"></span></a>
                            </div>
                            <div class="text">
                                <p>Prev Blog</p>
                                <h3><a href="{{ ($previous) ? route('news.detail', $previous->slug) : '#'}}">{{
                                        ($previous) ? $previous->title : ''}}</a></h3>
                            </div>
                        </div>
                        <div class="single-box right">
                            <div class="text">
                                <p>Next Blog</p>
                                <h3><a href="{{ ($next) ? route('news.detail', $next->slug) : '#' }}">{{ ($next) ?
                                        $next->title : '' }}</a></h3>
                            </div>
                            <div class="icon">
                                <a href="{{ ($next) ? route('news.detail', $next->slug) : '#' }}"><span
                                        class="icon-right-arrow-angle"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('frontend.right-sidebar')
        </div>
    </div>
</section>
<!--End Blog Details-->

@endsection
