@extends('layouts.master')

@section('title')
    {{ $page->title }} | @parent
@stop

@section('meta')
    <meta name="title" content="{{ $page->meta_title }}" />
    <meta name="description" content="{{ $page->meta_description }}" />
@stop

@section('content')
    <div class="page-content bg-white">
        <!-- Khu vực liên hệ -->
        <!-- Banner trang trong -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt"
            style="background-image:url({{ Theme::url('images/demo-image/banner/bnr1.jpg') }});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{ $page->title }}</h1>
                    <!-- Dòng điều hướng -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ route('homepage') }}">Trang chủ</a></li>
                            <li>{{ $page->title }}</li>
                        </ul>
                    </div>
                    <!-- Kết thúc dòng điều hướng -->
                </div>
            </div>
        </div>
        <!-- Kết thúc banner trang trong -->
        <div class="content-area">
            <div class="container">
                <div class="row">
                    <!-- Bắt đầu thanh bên -->
                    <div class="col-xl-4 col-lg-4 order-lg-1 order-2">
                        <aside class="side-bar sticky-top">
                            <div class="widget recent-posts-entry">
                                <h5 class="widget-title style-1">Bài viết gần đây</h5>
                                <div class="widget-post-bx">
                                    @foreach ($latestBlogs as $latestBlog)
                                        @php
                                            $image = $latestBlog->getImageAttribute();
                                        @endphp
                                        <div class="widget-post clearfix">
                                            <div class="dlab-post-media">
                                                @if ($image != '')
                                                    @php
                                                        $urlImage = $image->path_string;
                                                    @endphp
                                                    <img src="{{ $urlImage }}" width="200" height="143"
                                                        alt="">
                                                @else
                                                    <img src="{{ Theme::url('images/demo-image/news-1.jpg') }}"
                                                        width="200" height="143" alt="">
                                                @endif
                                            </div>
                                            <div class="dlab-post-info">
                                                <div class="dlab-post-meta">
                                                    <ul>
                                                        <li class="post-date">
                                                            <strong>{{ \Carbon\Carbon::parse($latestBlog->created_at)->format('d') }}
                                                                @if (App::getLocale() == 'vi')
                                                                    TH{{ \Carbon\Carbon::parse($latestBlog->created_at)->format('n') }}
                                                                @else
                                                                    {{ \Carbon\Carbon::parse($latestBlog->created_at)->format('M') }}
                                                                @endif
                                                            </strong>
                                                        </li>
                                                        <li class="post-author"> Bởi <a
                                                                href="javascript:void(0);">{{ $latestBlog->author }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="dlab-post-header">
                                                    <h6 class="post-title"><a
                                                            href="{{ route('page', $latestBlog->slug) }}">{{ $latestBlog->title }}</a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="widget widget_archive">
                                <h5 class="widget-title style-1">Danh mục</h5>
                                <ul>
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="{{ route('category.posts', ['slug' => $category->slug]) }}">{{ $category->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="widget widget_tag_cloud radius">
                                <h5 class="widget-title style-1">Thẻ</h5>
                                <div class="tagcloud">
                                    @foreach ($tags as $tag)
                                        <a href="{{ route('tag.posts', ['slug' => $tag->slug]) }}">{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </aside>
                    </div>
                    <!-- Kết thúc thanh bên -->
                    <!-- Bắt đầu phần bên trái -->
                    <div class="col-xl-8 col-lg-8 order-lg-2 order-1">
                        <!-- Bắt đầu blog -->
                        <div id="masonry" class="dlab-blog-grid-3 row">
                            @foreach ($blogs as $blog)
                                @php
                                    $image = $blog->getImageAttribute();
                                @endphp

                                <div class="post card-container col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="blog-post blog-grid blog-rounded blog-effect1">
                                        <div class="dlab-post-media dlab-img-effect">
                                            <a href="{{ route('page', $blog->slug) }}">
                                                @if ($image != '')
                                                    @php
                                                        $urlImage = $image->path_string;
                                                    @endphp
                                                    <img style="height: 250px; object-fit: cover;" src="{{ $urlImage }}" alt="">
                                                @else
                                                    <img style="height: 250px; object-fit: cover;" src="{{ Theme::url('images/demo-image/news-2.jpg') }}"
                                                        alt="">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="dlab-info p-a20 border-1">
                                            <div class="dlab-post-meta">
                                                <ul>
                                                    <li class="post-date">
                                                        <strong>{{ \Carbon\Carbon::parse($blog->created_at)->format('d') }}
                                                            @if (App::getLocale() == 'vi')
                                                                TH{{ \Carbon\Carbon::parse($blog->created_at)->format('n') }}
                                                            @else
                                                                {{ \Carbon\Carbon::parse($blog->created_at)->format('M') }}
                                                            @endif
                                                        </strong>
                                                        <span>
                                                            {{ \Carbon\Carbon::parse($blog->created_at)->format('Y') }}</span>
                                                    </li>
                                                    <li class="post-author"> Bởi {{ $blog->author }}</li>
                                                </ul>
                                            </div>
                                            <div class="dlab-post-title" style="height: 75px; overflow: hidden;">
                                                <h5 class="post-title" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;"><a
                                                        href="{{ route('page', $blog->slug) }}">{{ $blog->title }}</a></h5>
                                            </div>
                                            <div class="dlab-post-text"  style="height: 140px; overflow: hidden;">
                                                <p style="display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">{{ $blog->sumary }}</p>
                                            </div>
                                            <div class="dlab-post-readmore">
                                                <a href="{{ route('page', $blog->slug) }}" title="ĐỌC THÊM" rel="bookmark"
                                                    class="site-button">ĐỌC THÊM
                                                    <i class="ti-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {!! $blogs->links('partials.pagination') !!}
                    </div>
                    <!-- Left part END -->
                </div>
            </div>
        </div>
    </div>
@stop
