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
                    <div class="col-xl-12 col-lg-12 ">
                        <!-- blog start -->
                        <div class="blog-post blog-single">
                            <div class="dlab-post-meta">
                                <ul>
                                    <li class="post-date">
                                        <strong>{{ \Carbon\Carbon::parse($project->created_at)->format('d') }}
                                            @if (App::getLocale() == 'vi')
                                                TH{{ \Carbon\Carbon::parse($project->created_at)->format('n') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($project->created_at)->format('M') }}
                                            @endif
                                        </strong>
                                        <span>
                                            {{ \Carbon\Carbon::parse($project->created_at)->format('Y') }}</span>
                                    </li>
                                    {{-- <li class="post-author"> Bởi <a href="javascript:void(0);">{{ $project->author }}</a> </li> --}}
                                </ul>
                            </div>
                            <div class="dlab-post-title mb-4">
                                <h1 class="post-title mt-0">{{ $project->title }}</h1>
                            </div>
                            <div class="dlab-post-media dlab-img-effect zoom-slow">
                                @if ($image != '')
                                    @php
                                        $urlImage = $image->path_string;
                                    @endphp
                                    <a href="#"><img src="{{ $urlImage }}" alt=""></a>
                                @else
                                    <a href="#"><img src="#" alt=""></a>
                                @endif
                            </div>
                            <div class="dlab-post-text">
                                {!! $project->body !!}
                            </div>
                        </div>
                    </div>
                    <!-- Left part END -->
                </div>
                <div class="section-full content-inner-2 bg-white">
                    <div class="container">
                        <div class="section-head text-center">
                            <h2 class="title">Dự án liên quan</h2>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div
                                    class="img-carousel-dots-nav owl-theme owl-dots-none owl-carousel owl-btn-center-lr owl-btn-3">
                                    @foreach ($relatedProjects as $project)
                                        @php
                                            $delay = 0.2;
                                            $image = $project->getAvatar();
                                            if ($image != '') {
                                                $urlImage = $image->path_string;
                                            } else {
                                                $urlImage = Theme::url('images/demo-image/DichVu4.WebP');
                                            }
                                        @endphp
                                        <div class="item wow bounceInUp" data-wow-duration="2s"
                                            data-wow-delay="{{ $delay }}s">
                                            <div class="dlab-box project-bx">
                                                <div class="dlab-media radius-sm dlab-img-overlay1 dlab-img-effect zoom">
                                                    <a
                                                        href="{{ route('fe.project.project.detail', ['slug' => $project->slug]) }}">
                                                        <img src="{{ $urlImage }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="dlab-info">
                                                    <h5 class="dlab-title"><a
                                                            href="{{ route('fe.project.project.detail', ['slug' => $project->slug]) }}">{{ $project->title }}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $delay += 0.2;
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
