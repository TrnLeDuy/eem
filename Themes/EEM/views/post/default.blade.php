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
        <!-- contact area -->
        <div class="content-area">
            <div class="container">
                <div class="row">
                    <!-- Left part start -->
                    <div class="col-xl-8 col-lg-8 ">
                        <!-- blog start -->
                        <div class="blog-post blog-single">
                            <div class="dlab-post-meta">
                                <ul>
                                    <li class="post-date">
                                        <strong>{{ \Carbon\Carbon::parse($page->created_at)->format('d') }}
                                            @if(App::getLocale() == 'vi')
                                                TH{{ \Carbon\Carbon::parse($page->created_at)->format('n') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($page->created_at)->format('M') }}
                                            @endif
                                        </strong>
                                        <span>
                                            {{ \Carbon\Carbon::parse($page->created_at)->format('Y') }}</span>
                                    </li>
                                    <li class="post-author"> Bởi <a href="javascript:void(0);">{{ $page->author }}</a> </li>
                                </ul>
                            </div>
                            <div class="dlab-post-title mb-4">
                                <h1 class="post-title mt-0">{{ $page->title }}</h1>
                            </div>
                            @php
                                $image = $page->getImageAttribute();
                                // dd($image);
                            @endphp
                            <div class="dlab-post-media dlab-img-effect zoom-slow">
                                @if ($image != '')
                                    @php
                                        $urlImage = $image->path_string;
                                    @endphp
                                    <a href="{{ route('page', $page->slug) }}"><img src="{{ $urlImage }}" alt=""></a>
                                @else
                                    <a href="{{ route('page', $page->slug) }}"><img src="#" alt=""></a>
                                @endif
                            </div>
                            <div class="dlab-post-text">
                                {!! $page->body !!}
                            </div>
                            {{-- <div class="dlab-post-tags clear">
                                <div class="post-tags">
                                    <a href="javascript:void(0);">Child </a> <a href="javascript:void(0);">Eduction </a> <a
                                        href="javascript:void(0);">Money </a> <a href="javascript:void(0);">Resturent </a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <!-- Left part END -->
                    <!-- Side bar start -->
                    <div class="col-xl-4 col-lg-4 ">
                        <aside class="side-bar sticky-top">
                            <div class="widget recent-posts-entry">
                                <h5 class="widget-title style-1">Bài viết tương tự</h5>
                                <div class="widget-post-bx">
                                    @foreach ($relatePosts as $relatePost)
                                        @php
                                            $image = $relatePost->getImageAttribute();
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
                                                            <strong>{{ \Carbon\Carbon::parse($relatePost->created_at)->format('d') }}
                                                                @if (App::getLocale() == 'vi')
                                                                    TH{{ \Carbon\Carbon::parse($relatePost->created_at)->format('n') }}
                                                                @else
                                                                    {{ \Carbon\Carbon::parse($relatePost->created_at)->format('M') }}
                                                                @endif
                                                            </strong>
                                                        </li>
                                                        <li class="post-author"> Bởi <a
                                                                href="javascript:void(0);">{{ $relatePost->author }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="dlab-post-header">
                                                    <h6 class="post-title"><a
                                                            href="{{ route('page', $relatePost->slug) }}">{{ $relatePost->title }}</a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
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
                                        <li><a
                                                href="{{ route('category.posts', ['slug' => $category->slug]) }}">{{ $category->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>
                    </div>
                    <!-- Side bar END -->
                </div>
            </div>
        </div>
    </div>
@stop
