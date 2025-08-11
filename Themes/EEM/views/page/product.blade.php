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
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt"
            style="background-image:url({{ Theme::url('images/demo-image/banner/bnr5.jpg') }});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{ $page->title }}</h1>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ route('homepage') }}">Trang chủ</a></li>
                            <li>{{ $page->title }}</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="section-full content-inner">
            <!-- Product -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 m-b30">
                        <aside class="side-bar shop-categories sticky-top">
                            <div class="widget recent-posts-entry">
                                <div class="dlab-accordion advanced-search toggle" id="accordion1">
                                    <div class="panel">
                                        <div class="acod-head">
                                            <h5 class="acod-title">
                                                <a data-bs-toggle="collapse" href="#categories">
                                                    Danh mục
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="categories" class="acod-body collapse show">
                                            <div class="acod-content">
                                                <div class="widget widget_services">
                                                    <ul>
                                                        @foreach ($categories as $item)
                                                            <li><a
                                                                    href="{{ route('fe.product.product.category', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-9 col-md-8 m-b30">
                        <div class="row">
                            @if(count($products) > 0)
                                @foreach ($products as $product)
                                    @php
                                        $image = $product->getAvatar();
                                        if ($image != '') {
                                            $urlImage = $image->path_string;
                                        } else {
                                            $urlImage = Theme::url('images/demo-image/item5.jpg');
                                        }
                                    @endphp
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="item-box m-b10">
                                            <div class="item-img" style="text-align: center;">
                                                <img src="{{ $urlImage }}" style="height: 200px; width: auto;"
                                                    alt="">
                                            </div>
                                            <div class="item-info text-center text-black p-a10">
                                                <h6 class="item-title font-weight-500" style="height: 40px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;"><a
                                                        href="{{ route('fe.product.product.detail', ['slug' => $product->slug]) }}">{{ $product->title }}</a>
                                                </h6>
                                                {{-- href="#">{{ $product->title }}</a></h6> --}}
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
                                                        <a href="{{ route('fe.contact.contact.create', ['type' => 'product', 'product_id' => $product->id]) }}" title="Liên hệ" rel="bookmark"><span class="text-primary">Liên hệ</span></a>
                                                    </h4>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12 text-center p-5">
                                    <h4>{{ trans('product::products.messages.no_products') }}</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                    {!! $products->links('partials.pagination') !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Product END -->
    </div>
    </div>
@stop
