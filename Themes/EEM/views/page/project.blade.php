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
        <!-- banner trang trong -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt"
            style="background-image:url({{ Theme::url('images/demo-image/banner/bnr4.jpg') }});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{ $page->title }}</h1>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="javascript:void(0);">Trang chủ</a></li>
                            <li>{{ $page->title }}</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- banner trang trong END -->
        <!-- khu vực nội dung -->
        <div class="content-block">
            <!-- Danh mục dự án -->
            <div class="section-full content-inner-2 portfolio text-uppercase bg-gray" id="portfolio">
                <div class="container">
                    <div class="site-filters clearfix center m-b40">
                        <ul class="filters" data-bs-toggle="buttons">
                            <li data-filter="" class="btn active">
                                <input type="radio">
                                <a href="javascript:void(0);"
                                    class="site-button-secondry button-sm radius-xl"><span>Tất cả</span></a>
                            </li>
                            @foreach ($categories as $item)    
                            <li data-filter="{{ $item->slug }}" class="btn">
                                <input type="radio">
                                <a href="javascript:void(0);"
                                    class="site-button-secondry button-sm radius-xl"><span>{{ $item->title }}</span></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="clearfix" id="lightgallery">
                        <ul id="masonry"
                            class="portfolio-ic dlab-gallery-listing gallery-grid-4 gallery row p-l0 sp10 lightgallery text-center">
                            @foreach ($projects as $project)
                            <li class="{{ $project->category->slug }} card-container col-lg-4 col-md-6 col-sm-6 p-a0">
                                @php
                                    $image = $project->getAvatar();
                                    if ($image != '') {
                                        $urlImage = $image->path_string;
                                    } else {
                                        $urlImage = Theme::url('images/demo-image/banner/image_1.jpg');
                                    }
                                @endphp
                                <div class="dlab-box dlab-gallery-box">
                                    <div class="dlab-media dlab-img-overlay1 dlab-img-effect">
                                        <a href="{{ route('fe.project.project.detail', ['slug' => $project->slug]) }}"> <img
                                                src="{{ $urlImage }}"
                                                alt=""> </a>
                                        <div class="overlay-bx">
                                            <div class="overlay-icon">
                                                <div class="text-white">
                                                    <a href="{{ route('fe.project.project.detail', ['slug' => $project->slug]) }}"><i
                                                            class="fas fa-link icon-bx-xs"></i></a>
                                                    <span
                                                        data-exthumbimage="{{ $urlImage }}"
                                                        data-src="{{ $urlImage }}"
                                                        class="check-km" title="{{ $project->title }}">
                                                        <i class="far fa-image icon-bx-xs"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dez-info p-a30 bg-white">
                                        <p class="dez-title m-t0"><a href="{{ route('fe.project.project.detail', ['slug' => $project->slug]) }}">{{ $project->title }}</a></p>
                                        <p><small>{{ $project->category->title }}</small></p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop