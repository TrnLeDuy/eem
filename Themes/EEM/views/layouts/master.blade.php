@php
    $lang = LaravelLocalization::setLocale() ? LaravelLocalization::setLocale() : 'vi';
    $favicon_setting = json_decode(setting('core::favicon'), true);
    $favicon =
        isset($favicon_setting['medias_single']['core::favicon']) && $favicon_setting['medias_single']['core::favicon']
            ? $favicon_setting['medias_single']['core::favicon']
            : Theme::url('images/favicon.ico');
    $logo_setting = json_decode(setting('core::logo'), true);
    $header_logo =
        isset($logo_setting['medias_single']['core::logo']) && $logo_setting['medias_single']['core::logo']
            ? $logo_setting['medias_single']['core::logo']
            : Theme::url('images/logo.png');
    $footer_logo = $header_logo; // Since they use the same setting
    $banner_setting = json_decode(setting('core::banner'), true);
    $header_banner =
        isset($banner_setting['medias_single']['core::banner']) && $banner_setting['medias_single']['core::banner']
            ? $banner_setting['medias_single']['core::banner']
            : Theme::url('images/banner.png');
    $site_name = setting('core::site-name') ?: 'EEM';
    $site_description = setting('core::site-description') ?: 'EEM';
    $address = setting('core::address') ?: 'Thành phố Hồ Chí Minh, Việt Nam';
    $email = setting('core::email') ?: 'contact123@gmail.com';
    $phone = setting('core::phone') ?: '(654) 321-7654';
@endphp

<!DOCTYPE html>
<html>

<head lang="{{ $lang }}">
    <meta charset="UTF-8">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="eem" />
    <meta name="author" content="duy_dev" />
    @section('meta')
        <meta name="description" content="{{ $site_description }}" />
    @show
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content={{ config('app.url') }}>
    <title>
        @section('title') {{ $site_name }} @show
    </title>
    @if (isset($alternate))
        @foreach ($alternate as $alternateLocale => $alternateSlug)
            <link rel="alternate" hreflang="{{ $alternateLocale }}"
                href="{{ url($alternateLocale . '/' . $alternateSlug) }}">
        @endforeach
    @endif

    <link rel="canonical" href="{{ url()->current() }}" />
    <link rel="shortcut icon" href="{{ $favicon }}">

    {!! Theme::style('css/main.css') !!}

    @stack('css-stack')
    @yield('styles')
</head>

<body id="bg">
    <div class="page-wrapper">
        <div id="loading-area" class="solar-loading"></div>
        @yield('homepage-slider')
        <div id="app">
            @include('partials.nav')
            @yield('content')
            @include('partials.footer')
            <button class="scroltop style2 radius" type="button"><i class="fas fa-arrow-up"></i></button>
        </div>
    </div>

    <!-- Đảm bảo jQuery được tải trước toastr -->
    {!! Theme::script('js/jquery.min.js') !!}<!-- JQUERY.MIN JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Các script khác -->
    {!! Theme::script('js/plugins/wow/wow.js') !!}<!-- WOW JS -->
    {!! Theme::script('js/plugins/bootstrap/bootstrap.bundle.min.js') !!}<!-- BOOTSTRAP.MIN JS -->
    {!! Theme::script('js/plugins/bootstrap-select/bootstrap-select.min.js') !!}<!-- FORM JS -->
    {!! Theme::script('js/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js') !!}<!-- FORM JS -->
    {!! Theme::script('js/plugins/magnific-popup/magnific-popup.js') !!}<!-- MAGNIFIC POPUP JS -->
    {!! Theme::script('js/plugins/counter/waypoints-min.js') !!}<!-- WAYPOINTS JS -->
    {!! Theme::script('js/plugins/counter/counterup.min.js') !!}<!-- COUNTERUP JS -->
    {!! Theme::script('js/plugins/imagesloaded/imagesloaded.js') !!}<!-- IMAGESLOADED -->
    {!! Theme::script('js/plugins/masonry/masonry-3.1.4.js') !!}<!-- MASONRY -->
    {!! Theme::script('js/plugins/masonry/masonry.filter.js') !!}<!-- MASONRY -->
    {!! Theme::script('js/plugins/owl-carousel/owl.carousel.js') !!}<!-- OWL SLIDER -->
    {!! Theme::script('js/plugins/lightgallery/lightgallery-all.min.js') !!}<!-- Lightgallery -->
    {!! Theme::script('js/plugins/scroll/scrollbar.min.js') !!}<!-- scroll -->
    {!! Theme::script('js/script.js') !!}<!-- CUSTOM FUCTIONS  -->
    {!! Theme::script('js/dz.carousel.min.js') !!}<!-- SORTCODE FUCTIONS  -->
    {!! Theme::script('js/plugins/countdown/jquery.countdown.js') !!}<!-- COUNTDOWN FUCTIONS  -->
    {!! Theme::script('js/dz.ajax.js') !!}<!-- CONTACT JS  -->

    {!! Theme::script('js/jquery.lazy.min.js') !!}
    <!-- REVOLUTION JS FILES -->
    {!! Theme::script('js/plugins/revolution/jquery.themepunch.tools.min.js') !!}
    {!! Theme::script('js/plugins/revolution/jquery.themepunch.revolution.min.js') !!}
    <!-- Slider revolution 5.0 Extensions  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
    {!! Theme::script('js/plugins/revolution/revolution.extension.actions.min.js') !!}
    {!! Theme::script('js/plugins/revolution/revolution.extension.carousel.min.js') !!}
    {!! Theme::script('js/plugins/revolution/revolution.extension.kenburn.min.js') !!}
    {!! Theme::script('js/plugins/revolution/revolution.extension.layeranimation.min.js') !!}
    {!! Theme::script('js/plugins/revolution/revolution.extension.navigation.min.js') !!}
    {!! Theme::script('js/plugins/revolution/revolution.extension.parallax.min.js') !!}
    {!! Theme::script('js/plugins/revolution/revolution.extension.slideanims.min.js') !!}
    {!! Theme::script('js/plugins/revolution/revolution.extension.video.min.js') !!}
    {!! Theme::script('js/plugins/revolution/revolution.extension.migration.min.js') !!}
    {!! Theme::script('js/rev.slider.js') !!}
    @yield('scripts')
    <script>
        jQuery(document).ready(function() {
            'use strict';
            dz_rev_slider_1();
            $('.lazy').Lazy();
        }); /*ready*/
    </script>
</body>

</html>
