<!--Start Sidebar-->
<div class="col-xl-4">
    <div class="blog-page__sidebar">
        <!--Start Sidebar Single-->
        <div class="sidebar__single sidebar__search wow fadeInUp" data-wow-delay=".1s">
            <form action="#" class="sidebar__search-form">
                <input type="search" placeholder="Search here...">
                <button type="submit"><i class="icon-magnifying-glass"></i></button>
            </form>
        </div>
        <!--End Sidebar Single-->
        <!--Start Sidebar Single-->
        <div class="sidebar__single sidebar__latest-blog wow fadeInUp" data-wow-delay=".4s">
            <div class="title-box">
                <h2>Artikel Terbaru</h2>
            </div>
            <ul class="sidebar__latest-blog-list">
                @foreach ($recentBlog as $item)
                <li>
                    <div class="img-box">
                        <img src="{{ file_exists("uploads/".$item->featured_img) ?
                        asset("uploads/".$item->featured_img) : asset('assets/img/default-blog-sidebar.webp') }}"
                        alt="{{
                        $item->title }}">
                    </div>
                    <div class="content-box">
                        <h4><a href="{{ route('news.detail', $item->slug) }}">{{ $item->title }}</a></h4>
                        <p><span class="icon-calendar"></span> Se{{ \Carbon\Carbon::parse($item->created_at)->format('d
                            F Y') }}</p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <!--End Sidebar Single-->
    </div>
</div>
<!--End Sidebar-->
