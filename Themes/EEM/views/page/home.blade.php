@extends('layouts.master')

@section('title')
    {{ $page->title }} | @parent
@stop

@section('meta')
    <meta name="title" content="{{ $page->meta_title }}" />
    <meta name="description" content="{{ $page->meta_description }}" />
@stop

@section('homepage-slider')
    <!-- Slider -->
    <div class="main-slider style-two default-banner" id="home">
        <div class="tp-banner-container">
            <div class="tp-banner">
                <div id="welcome_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="reveal-add-on36"
                    data-source="gallery" style="background:#ffffff;padding:0px;">
                    <!-- START REVOLUTION SLIDER 5.4.7.2 fullscreen mode -->
                    <div id="welcome" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.7.2">
                        <ul>
                            <!-- SLIDE  -->
                            <li data-index="rs-100" data-transition="slidingoverlayhorizontal" data-slotamount="default"
                                data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default"
                                data-easeout="default" data-masterspeed="default" data-thumb="" data-rotate="0"
                                data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3=""
                                data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9=""
                                data-param10="" data-description="">
                                <!-- MAIN IMAGE -->
                                <img src="{{ Theme::url('images/dummy.png') }}" alt=""
                                    data-lazyload="{{ !empty($dynamicfields['banner']) ? app(Modules\Media\Repositories\FileRepository::class)->find($dynamicfields['banner'])->path : Theme::url('images/demo-image/Banner2.WebP') }}"
                                    data-bgposition="center center" data-kenburns="on" data-duration="4000"
                                    data-ease="Power3.easeInOut"
                                    data-rotatestart="0" data-rotateend="0" data-blurstart="0" data-blurend="0"
                                    data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="4" class="rev-slidebg"
                                    data-no-retina>
                                <!-- LAYER NR. 1 -->
                                <div class="tp-caption tp-shape tp-shapewrapper " id="slide-100-layer"
                                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                    data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                                    data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape"
                                    data-basealign="slide" data-responsive_offset="on" data-responsive="on"
                                    data-frames='[{"from":"opacity:0;","speed":1000,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"delay":"wait","speed":1000,"to":"opacity:0;","ease":"Power4.easeOut"}]'
                                    data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]"
                                    data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                    data-paddingleft="[0,0,0,0]"
                                    style="z-index: 2;background-color:rgba(0, 0, 0, 0.2);border-color:rgba(0, 0, 0, 0);border-width:0px; background-image:url({{ Theme::url('images/overlay/rrdiagonal-line.png') }})">
                                </div>
                                <div class="tp-caption tp-shape tp-shapewrapper ov-tp " id="slide-200-layer-1"
                                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                    data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                                    data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape"
                                    data-basealign="slide" data-responsive_offset="on" data-responsive="on"
                                    data-frames='[{"delay":10,"speed":1000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":1500,"frame":"999","to":"opacity:0;","ease":"Power4.easeIn"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]"
                                    data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                    data-paddingleft="[0,0,0,0]" style="z-index: 5;">
                                </div>
                                <div class="tp-caption " id="slide-200-layer-3"
                                    data-x="['center','center','center','center']" data-hoffset="['-90','-70','0','0']"
                                    data-y="['middle','middle','middle','middle']"
                                    data-voffset="['-90','-100','-80','-90']" data-fontsize="['65','50','40','30']"
                                    data-lineheight="['75','60','50','40']" data-letterspacing="['2','2','2','2']"
                                    data-width="['1000','700','600','360']" data-height="none"
                                    data-whitespace="['normal','normal','normal','normal']" data-type="text"
                                    data-responsive_offset="on" data-responsive="on"
                                    data-frames='[{"delay":900,"speed":2000,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:1.1;sY:1.1;skX:0;skY:0;opacity:0;","color":"#000000","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","color":"#000000","to":"opacity:0;","ease":"nothing"}]'
                                    data-textAlign="['left','left','center','center']" data-paddingtop="[0,0,0,0]"
                                    data-paddingright="[10,10,10,10]" data-paddingbottom="[0,0,0,0]"
                                    data-paddingleft="[10,10,10,10]"
                                    style="z-index: 6; max-width: 800px; font-weight: 600; white-space: normal; color: #fff;">
                                    {{ $dynamicfields['banner-title'] ?? '' }}
                                </div>
                                <!-- LAYER NR. 3 -->
                                @isset($dynamicfields['banner-description'])
                                    <div class="tp-caption" id="slide-200-layer-4"
                                        data-x="['center','center','center','center']" data-hoffset="['-265','-165','0','0']"
                                        data-y="['middle','middle','middle','middle']" data-voffset="['50','15','20','10']"
                                        data-fontsize="['18','16','14','14']" data-lineheight="['30','30','26','26']"
                                        data-width="['640','481','500','300']" data-height="none" data-whitespace="normal"
                                        data-type="text" data-responsive_offset="on" data-responsive="on"
                                        data-frames='[{"delay":900,"speed":2000,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:1.1;sY:1.1;skX:0;skY:0;opacity:0;","color":"#000000","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","color":"#000000","to":"opacity:0;","ease":"nothing"}]'
                                        data-textAlign="['left','left','center','center']" data-paddingtop="[0,0,0,0]"
                                        data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                        data-paddingleft="[0,0,0,0]"
                                        style="z-index: 7; min-width: 640px; max-width: 640px; font-weight: 700; font-size: 18px; line-height: 30px; font-weight: 400; color: #fff;">
                                        {{ $dynamicfields['banner-description'] ?? '' }}
                                    </div>
                                @endisset
                                <!-- LAYER NR. 5 -->
                                @isset($dynamicfields['banner-button-left'])
                                    <a class="tp-caption rev-btn tc-btnshadow tp-rs-menulink bg-primary"
                                        href="{{ $dynamicfields['banner-button-left-link'] ?? '#' }}" target="_blank"
                                        id="slide-200-layer-5" data-x="['center','center','center','center']"
                                        data-hoffset="['-515','-340','-85','-65']"
                                        data-y="['middle','middle','middle','middle']"
                                        data-voffset="['140','100','100','100']" data-lineheight="['18','18','18','18']"
                                        data-whitespace="nowrap" data-type="button" data-actions=''
                                        data-responsive_offset="on" data-responsive="on"
                                        data-frames='[{"delay":900,"speed":2000,"frame":"0","from":"x:-50px;z:0;rX:0;rY:0;rZ:0;sX:1.1;sY:1.1;skX:0;skY:0;opacity:0;fbr:100;","bgcolor":"#000000","to":"o:1;fbr:100;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","bgcolor":"#000000","to":"opacity:0;fbr:100;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"150","ease":"Power1.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;fbr:90%;","style":"c:rgba(255,255,255,1);"}]'
                                        data-textAlign="['center','center','center','center']" data-paddingtop="[15,15,15,10]"
                                        data-paddingright="[30,30,30,20]" data-paddingbottom="[15,15,15,10]"
                                        data-paddingleft="[30,30,30,20]"
                                        style="z-index: 8;letter-spacing: 2px; white-space: nowrap; font-size: 12px; font-weight: 600; color: rgba(255,255,255,1);  text-transform: uppercase;">
                                        {{ $dynamicfields['banner-button-left'] }}
                                    </a>
                                @endisset
                                <!-- LAYER NR. 5 -->
                                @isset($dynamicfields['banner-button-right'])
                                    <a class="tp-caption rev-btn tc-btnshadow tp-rs-menulink bg-primary"
                                        href="{{ $dynamicfields['banner-button-right-link'] ?? '#' }}" target="_blank"
                                        id="slide-200-layer-6" data-x="['center','center','center','center']"
                                        data-hoffset="['-360','-180','70','65']"
                                        data-y="['middle','middle','middle','middle']"
                                        data-voffset="['140','100','100','100']" data-lineheight="['18','18','18','18']"
                                        data-whitespace="nowrap" data-type="button" data-actions=''
                                        data-responsive_offset="on" data-responsive="on"
                                        data-frames='[{"delay":900,"speed":2000,"frame":"0","from":"x:-50px;z:0;rX:0;rY:0;rZ:0;sX:1.1;sY:1.1;skX:0;skY:0;opacity:0;fbr:100;","bgcolor":"#000000","to":"o:1;fbr:100;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","bgcolor":"#000000","to":"opacity:0;fbr:100;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"150","ease":"Power1.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;fbr:90%;","style":"c:rgba(255,255,255,1);"}]'
                                        data-textAlign="['center','center','center','center']" data-paddingtop="[15,15,15,10]"
                                        data-paddingright="[30,30,30,20]" data-paddingbottom="[15,15,15,10]"
                                        data-paddingleft="[30,30,30,20]"
                                        style="z-index: 8;letter-spacing: 2px; white-space: nowrap; font-size: 12px; font-weight: 600; color: rgba(255,255,255,1);  text-transform: uppercase;">
                                        {{ $dynamicfields['banner-button-right'] }}
                                    </a>
                                @endisset
                            </li>
                        </ul>
                        <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="page-content bg-white">
        <div class="content-block">
            @isset($dynamicfields['services-instructions'])
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
                                        <a href="{{ $item['services-link'] ?? '#' }}">
                                            <div class="dlab-info">
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
            @endisset

            @isset($dynamicfields['services-title'])
                <div class="section-full content-inner-2 bg-gray wow fadeIn" data-wow-duration="2s" data-wow-delay="0.6s">
                    <div class="container">
                        <div class="section-head text-black text-center">
                            <h2 class="title">{{ $dynamicfields['services-title'] ?? '' }}</h2>
                            <p>{{ $dynamicfields['services-description'] ?? '' }}</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                @php
                                    $count = 1;
                                @endphp
                                <div
                                    class="img-carousel-dots owl-theme owl-dots-none owl-carousel owl-btn-center-lr owl-btn-3">
                                    @foreach ($dynamicfields['services'] as $key => $item)
                                        <div class="item">
                                            <div class="service-box style4">
                                                <div class="icon-lg m-b5 text-primary radius">
                                                    <a href="javascript:void(0);" class="icon-cell"><i
                                                            class="{{ $item['flaticon'] }}"></i></a>
                                                </div>
                                                <h3 class="title" style="height: 70px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">{{ $item['title'] ?? '' }}</h3>
                                                <div class="no">{{ $count }}</div>
                                            </div>
                                        </div>
                                        @php
                                            $count++;
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset

            <div class="section-full content-inner-2 bg-white">
                <div class="container">
                    <div class="section-head text-center">
                        <h2 class="title">Dự án</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div
                                class="img-carousel-dots-nav owl-theme owl-dots-none owl-carousel owl-btn-center-lr owl-btn-3">
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
                                                <a
                                                    href="{{ route('fe.project.project.detail', ['slug' => $project->slug]) }}">
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

            @isset($dynamicfields['rating-title'])
                <div class="section-full content-inner bg-gray">
                    <div class="container">
                        <div class="section-head text-center">
                            <h2 class="title">{!! $dynamicfields['rating-title'] ?? '' !!}</h2>
                        </div>
                        <div
                            class="testimonial-six owl-carousel owl-btn-center-lr testimonial-13-area owl-btn-2 primary dots-style-3 owl-theme">
                            @foreach ($dynamicfields['rating'] as $key => $item)
                                <div class="item wow bounceInUp" data-wow-duration="2s"
                                    data-wow-delay="{{ 0.3 * $loop->iteration }}s">
                                    <div class="testimonial-13">
                                        <div class="testimonial-text">
                                            <div class="quote-left"></div>
                                            <p>{!! $item['context'] ?? '' !!}</p>
                                        </div>
                                        <div class="testimonial-detail clearfix">
                                            <div class="testimonial-pic radius shadow">
                                                <img src="{{ !empty($item['avatar']) ? app(Modules\Media\Repositories\FileRepository::class)->find($item['avatar'])->path : Theme::url('images/avatar.png') }}"
                                                    alt="">
                                            </div>
                                            <h5 class="testimonial-name m-t10 m-b5">{!! $item['name'] ?? '' !!}</h5>
                                            <span class="testimonial-position text-primary">{!! $item['position'] ?? '' !!}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endisset

            <div class="section-full content-inner bg-white">
                <div class="container">
                    <div class="section-head text-black text-center">
                        <h2 class="title text-capitalize">Tin tức mới nhất</h2>
                    </div>
                    <div class="row">
                        @foreach ($latestBlogs as $latestBlog)
                            @php
                                $delay = 0.3;
                                $image = $latestBlog->getImageAttribute();
                            @endphp
                            <div class="col-lg-4 col-md-6 wow bounceInLeft" data-wow-duration="2s"
                                data-wow-delay="{{ $delay }}s">
                                <div class="blog-post blog-grid blog-rounded blog-effect1">
                                    <div class="dlab-post-media dlab-img-effect zoom">
                                        <a href="{{ route('page', $latestBlog->slug) }}">
                                            @if ($image != '')
                                                @php
                                                    $urlImage = $image->path_string;
                                                @endphp
                                                <img style="height: 250px; object-fit: cover;" src="{{ $urlImage }}" alt="">
                                            @else
                                                <img style="height: 250px; object-fit: cover;" src="{{ Theme::url('images/demo-image/news-1.jpg') }}"
                                                    alt="">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="dlab-info p-a20 border-1 bg-white">
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
                                                    <span>
                                                        {{ \Carbon\Carbon::parse($latestBlog->created_at)->format('Y') }}</span>
                                                </li>
                                                <li class="post-author"> Bởi <a
                                                        href="javascript:void(0);">{{ $latestBlog->author }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dlab-post-title">
                                            <h4 class="post-title" style="height: 92px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;"><a
                                                    href="{{ route('page', $latestBlog->slug) }}">{{ $latestBlog->title }}</a>
                                            </h4>
                                        </div>
                                        <div class="dlab-post-text">
                                            <p style="height: 115px; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">{{ $latestBlog->sumary }}</p>
                                        </div>
                                        <div class="dlab-post-readmore">
                                            <a href="{{ route('page', $latestBlog->slug) }}" title="ĐỌC THÊM"
                                                rel="bookmark" class="site-button btnhover15">ĐỌC THÊM
                                                <i class="ti-arrow-right"></i>
                                            </a>
                                        </div>
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
            <!-- Latest From Blog End -->
        </div>
        <!-- contact area END -->
    </div>
@stop
