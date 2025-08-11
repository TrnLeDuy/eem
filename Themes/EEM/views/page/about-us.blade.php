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
        <!-- Banner trang trong -->
        <div class="dlab-bnr-inr overlay-black-middle text-center bg-pt"
            style="background-image:url({{ !empty($dynamicfields['breadcrumb-banner']) ? app(Modules\Media\Repositories\FileRepository::class)->find($dynamicfields['breadcrumb-banner'])->path : Theme::url('images/demo-image/banner/bnr3.jpg') }});">
            <div class="container">
                <div class="dlab-bnr-inr-entry align-m text-center">
                    <h1 class="text-white">{{ $page->title }}</h1>
                    <!-- Breadcrumb -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ route('homepage') }}">Trang chủ</a></li>
                            <li>{{ $page->title }}</li>
                        </ul>
                    </div>
                    <!-- Kết thúc Breadcrumb -->
                </div>
            </div>
        </div>
        <!-- Kết thúc banner trang trong -->
        <!-- Khu vực nội dung -->
        <div class="content-block">
            <!-- Thông tin Dịch vụ -->
            @if (isset($dynamicfields['about-us-background']) ||
                    isset($dynamicfields['about-us-image']) ||
                    isset($dynamicfields['about-us-signature']) ||
                    isset($dynamicfields['about-us-title']) ||
                    isset($dynamicfields['about-us-subtitle']) ||
                    isset($dynamicfields['about-us-description']) ||
                    isset($dynamicfields['about-us-signature-name']) ||
                    isset($dynamicfields['about-us-signature-position']))
                <div class="section-full content-inner bg-white video-section"
                    style="background-image:url({{ !empty($dynamicfields['about-us-background']) ? app(Modules\Media\Repositories\FileRepository::class)->find($dynamicfields['about-us-background'])->path : Theme::url('images/background/bg-video.png') }});">
                    <div class="container">
                        <div class="section-content">
                            <div class="row d-flex">
                                <div class="col-lg-6 col-md-12 m-b30">
                                    <div class="video-bx">
                                        <img src="{{ !empty($dynamicfields['about-us-image']) ? app(Modules\Media\Repositories\FileRepository::class)->find($dynamicfields['about-us-image'])->path : '' }}"
                                            alt="Hình ảnh dịch vụ">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 m-b30 align-self-center video-infobx">
                                    <div class="content-bx1">
                                        <h2 class="m-b15 title">{{ $dynamicfields['about-us-title'] ?? '' }}<br><span
                                                class="text-primary">{{ $dynamicfields['about-us-subtitle'] ?? '' }}</span>
                                        </h2>
                                        <p class="m-b30">{{ $dynamicfields['about-us-description'] ?? '' }}</p>
                                        @if (!empty($dynamicfields['about-us-signature']))
                                            <img src="{{ app(Modules\Media\Repositories\FileRepository::class)->find($dynamicfields['about-us-signature'])->path }}"
                                                width="200" alt="Chữ ký giám đốc">
                                        @endif
                                        <h4 class="m-b0">{{ $dynamicfields['about-us-signature-name'] ?? '' }}</h4>
                                        <span
                                            class="font-14">{{ $dynamicfields['about-us-signature-position'] ?? '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Kết thúc Thông tin Dịch vụ -->
            <!-- Số liệu thống kê -->
            @isset($dynamicfields['about-us-number-group'])
                <div class="section-full content-inner overlay-black-dark bg-img-fix"
                    style="background-image:url({{ !empty($dynamicfields['about-us-number-group-background']) ? app(Modules\Media\Repositories\FileRepository::class)->find($dynamicfields['about-us-number-group-background'])->path : Theme::url('images/background/bg1.jpg') }});">
                    <div class="container">
                        <div class="section-content text-center text-white">
                            <div class="row">
                                @php
                                    $delay = 0.2;
                                @endphp
                                @foreach ($dynamicfields['about-us-number-group'] as $key => $item)
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 m-b30">
                                        <div class="counter-style-5 wow fadeInUp" data-wow-delay="{{ $delay }}s">
                                            <div>
                                                <span
                                                    style="font-size: 40px; line-height: 60px; font-weight: 600; letter-spacing: 3px; margin-bottom: 10px ;">{{ $item['value'] }}</span>
                                            </div>
                                            <span class="counter-text">{{ $item['title'] }}</span>
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
            @endisset
            <!-- Kết thúc Số liệu thống kê -->
            @isset($dynamicfields['services-instructions'])
                <div class="section-full content-inner bg-white">
                    <div class="container">
                        <div class="section-full content-inner bg-white">
                            <div class="container">
                                <div class="section-head text-black text-center">
                                    <h2 class="title">{{ $dynamicfields['services-instructions'] ?? '' }}</h2>
                                    <p>{{ $dynamicfields['services-instructions-description'] ?? '' }}</p>
                                </div>
                                <div class="row">
                                    @foreach ($dynamicfields['services-card'] as $key => $item)
                                        <div class="col-lg-4 col-md-6 col-sm-12 m-b50 wow fadeInLeft" data-wow-duration="2s"
                                            data-wow-delay="0.3s">
                                            <div class="dlab-box service-box-3">
                                                <div class="dlab-media radius-sm dlab-img-overlay1 zoom dlab-img-effect">
                                                    <a href="{{ $item['services-link'] ?? '#' }}"><img
                                                            src="{{ !empty($item['services-avatar']) ? app(Modules\Media\Repositories\FileRepository::class)->find($item['services-avatar'])->path : '#' }}"
                                                            alt=""></a>
                                                </div>
                                                <a class="dlab-info" href="{{ $item['services-link'] ?? '#' }}">
                                                    <div>
                                                        <h4 class="title">
                                                            {{ $item['services-card-title'] }}
                                                        </h4>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
        <div class="section-full bg-gray content-inner-2 about-carousel-ser">
            <div class="container">
                <div class="section-head text-center">
                    <h2 class="title">Sản phẩm</h2>
                </div>
                <div
                    class="about-ser-carousel owl-carousel owl-theme owl-btn-center-lr owl-dots-primary-full owl-dots-none owl-btn-3">
                    @foreach ($products as $product)
                        @php
                            $delay = 0.3;
                            $image = $product->getAvatar();
                            if ($image != '') {
                                $urlImage = $image->path_string;
                            } else {
                                $urlImage = Theme::url('images/demo-image/DichVu1.WebP');
                            }
                        @endphp
                        <div class="item wow fadeInUp" data-wow-duration="2s" data-wow-delay="{{ $delay }}s">
                            <div class="dlab-box service-media-bx">
                                <div class="dlab-media dlab-img-effect zoom">
                                    <a href="{{ route('fe.product.product.detail', ['slug' => $product->slug]) }}"><img
                                            src="{{ $urlImage }}" alt=""></a>
                                </div>
                                <div class="dlab-info text-center">
                                    <h2 class="dlab-title" style="height: 70px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;"><a
                                            href="{{ route('fe.product.product.detail', ['slug' => $product->slug]) }}">{{ $product->title }}</a>
                                    </h2>
                                    <p style="height: 120px; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">{{ $product->sumary }}</p>
                                    <a href="{{ route('fe.product.product.detail', ['slug' => $product->slug]) }}"
                                        class="site-button btnhover15">Đọc thêm</a>
                                </div>
                            </div>
                        </div>
                        @php
                            $delay += 0.3;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Latest Projects -->
        <div class="section-full content-inner-2 bg-white">
            <div class="container">
                <div class="section-head text-center">
                    <h2 class="title">Dự án</h2>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="img-carousel-dots-nav owl-theme owl-dots-none owl-carousel owl-btn-center-lr owl-btn-3">
                            @foreach ($projects as $project)
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
                                            <a href="{{ route('fe.project.project.detail', ['slug' => $project->slug]) }}">
                                                <img style="height: 250px; object-fit: cover;" src="{{ $urlImage }}" alt="">
                                            </a>
                                        </div>
                                        <div class="dlab-info">
                                                <h5 class="dlab-title" style="height: 40px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;"><a
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
        <!-- Latest Projects End -->
    </div>
    <!-- Kết thúc khu vực nội dung -->
    </div>
@stop
