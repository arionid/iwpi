@extends('layouts.master')
@section('title', 'Blog')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>
        Dashboard</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Dasboard</li>
@endsection

@section('content')
    <div class="container-fluid">
        @if (isset($blog))
            <div class="row">
                <div class="col-xl-6 set-col-12 box-col-12">
                    <div class="card">
                        <div class="blog-box blog-shadow">
                            <img class="img-fluid"
                                src="{{ file_exists('uploads/' . $blog[0]->featured_img) ? asset('uploads/' . $blog[0]->featured_img) : 'https://via.placeholder.com/756x423?text=' . $blog[0]->category->name ?? 'Article' }}"
                                onerror="this.src='https://via.placeholder.com/756x423?text={{ $item->category->name ?? 'Article' }}';" alt="{{ $blog[0]->title }}">
                            <div class="blog-details">
                                <p class="digits">{{ \Carbon\Carbon::parse($blog[0]->created_at)->format('F, d Y') }}</p>
                                <h4>{{ $blog[0]->title }} </h4>
                                <ul class="blog-social">
                                    <li><i class="icofont icofont-user"></i>{{ $blog[0]->author->name ?? 'System' }}</li>
                                    <li class="digits"><i class="icofont icofont-contrast"></i>
                                        @if ($blog[0]->status == '1')
                                            <b>Published</b>
                                        @elseif($blog[0]->status == '2')
                                            One Schedule
                                        @else
                                            <b class="text-danger">Draft</b>
                                        @endif
                                    </li>
                                    <li class="digits"><i class="icofont icofont-filter"></i>{{ $blog[0]->categories }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @if (count($blog) >= 3)
                    <div class="col-xl-6 set-col-12 box-col-12">
                        @foreach ($blog as $item)
                            @if ($loop->first)
                                @continue
                            @endif
                            <div class="card">
                                <div class="blog-box blog-list row">
                                    <div class="col-sm-5"><img class="img-fluid sm-100-w"
                                            src="{{ file_exists('uploads/' . $item->featured_img) ? asset('uploads/' . $item->featured_img) : 'https://via.placeholder.com/756x423?text=' . $item->category->name ?? 'Article' }}"
                                            onerror="this.src='https://via.placeholder.com/756x423?text={{ $item->category->name ?? 'Article' }}';" alt="{{ $item->title }}"></div>
                                    <div class="col-sm-7">
                                        <div class="blog-details">
                                            <div class="blog-date digits"><span>{{ \Carbon\Carbon::parse($item->published_at)->format('d') }}</span>
                                                {{ \Carbon\Carbon::parse($item->published_at)->format('F Y') }}</div>
                                            <h6>{{ $item->title }}</h6>
                                            <div class="blog-bottom-content">
                                                <ul class="blog-social">
                                                    <li>by: {{ $item->author->name ?? 'System' }}</li>
                                                    <li>
                                                        @if ($item->status == '1')
                                                            <b class="txt-success">Published</b>
                                                        @elseif($blog[0]->status == '2')
                                                            <b class="txt-primary">One Schedule</b>
                                                        @else
                                                            <b class="txt-danger">Draft</b>
                                                        @endif
                                                    </li>
                                                </ul>
                                                <hr>
                                                <p class="mt-0">{{ $item->excerpt }}.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($loop->iteration >= 3)
                                @break
                            @endif
                        @endforeach
                    </div>
                @endif

                @if (count($blog) >= 4)
                    @foreach ($blog as $item)
                        @if ($loop->iteration < 3)
                            @continue
                        @endif
                        <div class="col-md-6 col-xl-3 set-col-6">
                            <div class="card">
                                <div class="blog-box blog-grid text-center">
                                    <img class="img-fluid top-radius-blog"
                                        src="{{ file_exists('uploads/' . $item->featured_img) ? asset('uploads/' . $item->featured_img) : 'https://via.placeholder.com/756x423?text=' . $item->category->name ?? 'Article' }}"
                                        onerror="this.src='https://via.placeholder.com/756x423?text={{ $item->category->name ?? 'Article' }}';" alt="{{ $item->title }}">
                                    <div class="blog-details-main">
                                        <ul class="blog-social">
                                            <li class="digits">{{ \Carbon\Carbon::parse($item->published_at)->format('F, d Y') }}</li>
                                            <li class="digits">by: {{ $item->author->name ?? 'System' }}</li>
                                            <li class="digits">
                                                @if ($item->status == '1')
                                                    <b class="text-success">Published</b>
                                                @else
                                                    <b class="text-danger">Draft</b>
                                                @endif
                                            </li>
                                        </ul>
                                        <hr>
                                        <h6 class="blog-bottom-details">{{ $item->title }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    </div>
@endsection

@section('script')

@endsection
