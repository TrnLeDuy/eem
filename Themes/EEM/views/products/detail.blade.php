@extends('layouts.master')

@section('title')
    {{ $product->title }} | @parent
@stop

@section('styles')
    <style>
        .product-info-content ul {
            list-style-type: disc;
            padding-left: 20px;
            margin-bottom: 15px;
        }

        .product-info-content ul li {
            margin-bottom: 5px;
        }

        .product-info-content table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .product-info-content table td,
        .product-info-content table th {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>
@endsection

@section('content')
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt"
            style="background-image:url({{ Theme::url('images/demo-image/banner/bnr5.jpg') }});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">Sản phẩm</h1>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ route('homepage') }}">Trang chủ</a></li>
                            <li>Sản phẩm</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="section-full content-inner bg-white">
            <!-- Product details -->
            <div class="container woo-entry">
                <div class="row m-b30">
                    <div class="col-md-5 col-lg-5 col-sm-12">
                        <div class="product-gallery on-show-slider lightgallery" id="lightgallery">
                            <div id="sync1" class="owl-carousel owl-theme owl-btn-center-lr m-b5 owl-btn-1 primary">
                                <div class="item">
                                    <div class="mfp-gallery">
                                        <div class="dlab-box">
                                            <div class="dlab-thum-bx">
                                                @if (!empty($productImage) && !empty($productImage->path_string))
                                                    <img src="{{ $productImage->path_string }}" alt="">
                                                    <div class="overlay-bx">
                                                        <div class="overlay-icon">
                                                            <span data-exthumbimage="{{ $productImage->path_string }}"
                                                                data-src="{{ $productImage->path_string }}" class="check-km"
                                                                title="{{ $product->title }}">
                                                                <i class="ti-fullscreen"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($productSlideImages as $slide)
                                    <div class="item">
                                        <div class="mfp-gallery">
                                            <div class="dlab-box">
                                                <div class="dlab-thum-bx">
                                                    <img src="{{ $slide->path_string }}" alt="">
                                                    <div class="overlay-bx">
                                                        <div class="overlay-icon">
                                                            <span data-exthumbimage="{{ $slide->path_string }}"
                                                                data-src="{{ $slide->path_string }}" class="check-km"
                                                                title="{{ $product->title }}">
                                                                <i class="ti-fullscreen"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div id="sync2" class="owl-carousel owl-theme owl-none">
                                <div class="item">
                                    <div class="dlab-media">
                                        @if (!empty($productImage) && !empty($productImage->path_string))
                                            <img src="{{ $productImage->path_string }}" alt="">
                                        @endif
                                    </div>
                                </div>
                                @foreach ($productSlideImages as $slide)
                                    <div class="item">
                                        <div class="dlab-media">
                                            <img src="{{ $slide->path_string }}" alt="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 col-sm-12">
                        <div class="dlab-post-title">
                            <h4 class="post-title">{{ $product->title }}</h4>
                            <p class="m-b10">{{ $product->sumary }}</p>
                            <div class="dlab-divider bg-gray tb15">
                                <i class="icon-dot c-square"></i>
                            </div>
                        </div>
                        <div class="relative">
                            @if ($product->product_status != 1 || $product->price == 0)
                                <h3 class="m-tb10">Liên hệ báo giá</h3>
                            @else
                                @if ($product->is_promotion == 1)
                                    <h3 class="m-tb10"><del>{{ number_format($product->price) }}đ</del>
                                        <span class="text-primary">{{ number_format($product->price_sale) }}đ</span>
                                    </h3>
                                @else
                                    <h3 class="m-tb10">{{ number_format($product->price) }}đ</h3>
                                @endif
                            @endif
                            <div class="shop-item-rating">
                                <span class="rating-bx">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($product->rating))
                                            <i class="fas fa-star"></i>
                                        @elseif ($i - $product->rating <= 0.5 && $i - $product->rating > 0)
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </span>
                                <span>Đánh giá: {{ number_format($product->rating, 1) }} sao</span>
                            </div>
                        </div>
                        <br>
                        {{-- <div class="shop-item-tage">
                                <span>Thẻ :- </span>
                                <a href="javascript:void(0);">Shoes,</a>
                                <a href="javascript:void(0);">Clothing</a>
                                <a href="javascript:void(0);">T-shirts</a>
                            </div> --}}
                        <div class="dlab-divider bg-gray tb15">
                            <i class="icon-dot c-square"></i>
                        </div>
                        <a href="{{ route('fe.contact.contact.create', ['type' => 'product', 'product_id' => $product->id]) }}"
                            class="site-button radius-no">
                            <i class="ti-headphone-alt"></i> Liên hệ
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dlab-tabs  product-description tabs-site-button">
                            <ul class="nav nav-tabs ">
                                <li><a data-bs-toggle="tab" href="#web-design-1" class="active"><i class="fas fa-globe"></i>
                                        Mô tả</a></li>
                                @if ($product->product_info !== null)
                                    <li><a data-bs-toggle="tab" href="#graphic-design-1"><i class="far fa-image"></i>
                                            Thông tin chi tiết</a></li>
                                @endif
                            </ul>
                            <div class="tab-content">
                                <div id="web-design-1" class="tab-pane active">
                                    <div class="product-info-content">
                                        {!! $product->description !!}
                                    </div>
                                </div>

                                <div id="graphic-design-1" class="tab-pane">
                                    <div class="product-info-content">
                                        {!! $product->product_info !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="m-b20">Sản phẩm liên quan</h5>
                        <div class="img-carousel-content owl-carousel owl-btn-center-lr owl-btn-1 primary">
                            @foreach ($productRelated as $product)
                                @php
                                    $image = $product->getAvatar();
                                    if ($image != '') {
                                        $urlImage = $image->path_string;
                                    } else {
                                        $urlImage = '#';
                                    }
                                @endphp
                                <div class="item">
                                    <div class="item-box">
                                        <div class="item-img"
                                            style="display: flex; align-items: center; justify-content: center;">
                                            <img style="height: 200px; width: auto;" src="{{ $urlImage }}"
                                                alt="">
                                        </div>
                                        <div class="item-info text-center text-black p-a10">
                                            <h6 class="item-title text-uppercase font-weight-500"
                                                style="height: 40px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                                <a
                                                    href="{{ route('fe.product.product.detail', ['slug' => $product->slug]) }}">{{ Str::limit($product->title, 40, '...') }}</a>
                                            </h6>
                                            <ul class="item-review">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= floor($product->rating))
                                                        <i class="fas fa-star text-yellow"></i>
                                                    @elseif ($i - $product->rating <= 0.5 && $i - $product->rating > 0)
                                                        <i class="fas fa-star-half-alt text-yellow"></i>
                                                    @else
                                                        <i class="far fa-star text-yellow"></i>
                                                    @endif
                                                @endfor
                                            </ul>
                                            @if ($product->product_status == 1 || $product->price != 0)
                                                @if ($product->is_promotion == 1)
                                                    <h4 class="item-price">
                                                        <del>{{ number_format($product->price) }}đ</del>
                                                        <span
                                                            class="text-primary">{{ number_format($product->price_sale) }}đ</span>
                                                    </h4>
                                                @else
                                                    <h4 class="item-price">
                                                        <span>{{ number_format($product->price) }}đ</span>
                                                    </h4>
                                                @endif
                                            @else
                                                <h4 class="item-price">
                                                    <a href="{{ route('fe.contact.contact.create', ['type' => 'product', 'product_id' => $product->id]) }}"
                                                        title="Liên hệ" rel="bookmark"><span class="text-primary">Liên
                                                            hệ</span></a>
                                                </h4>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <!-- Product details -->
        </div>
        <!-- contact area  END -->
    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function() {

            var sync1 = $("#sync1");
            var sync2 = $("#sync2");
            var slidesPerPage = 4; //globaly define number of elements per page
            var syncedSecondary = true;

            sync1.owlCarousel({
                items: 1,
                slideSpeed: 2000,
                nav: true,
                autoplay: false,
                dots: false,
                loop: true,
                responsiveRefreshRate: 200,
                navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
            }).on('changed.owl.carousel', syncPosition);

            sync2.on('initialized.owl.carousel', function() {
                sync2.find(".owl-item").eq(0).addClass("current");
            }).owlCarousel({
                items: slidesPerPage,
                dots: false,
                nav: false,
                margin: 5,
                smartSpeed: 200,
                slideSpeed: 500,
                slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                responsiveRefreshRate: 100
            }).on('changed.owl.carousel', syncPosition2);

            function syncPosition(el) {
                //if you set loop to false, you have to restore this next line
                //var current = el.item.index;

                //if you disable loop you have to comment this block
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }

                //end block

                sync2
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");
                var onscreen = sync2.find('.owl-item.active').length - 1;
                var start = sync2.find('.owl-item.active').first().index();
                var end = sync2.find('.owl-item.active').last().index();

                if (current > end) {
                    sync2.data('owl.carousel').to(current, 100, true);
                }
                if (current < start) {
                    sync2.data('owl.carousel').to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    sync1.data('owl.carousel').to(number, 100, true);
                }
            }

            sync2.on("click", ".owl-item", function(e) {
                e.preventDefault();
                var number = $(this).index();
                //sync1.data('owl.carousel').to(number, 300, true);

                sync1.data('owl.carousel').to(number, 300, true);

            });
        });
    </script>
@stop
