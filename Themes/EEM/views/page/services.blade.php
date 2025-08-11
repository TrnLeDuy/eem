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
            style="background-image:url({{ Theme::url('images/demo-image/banner/bnr2.jpg') }});">
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
        <div class="content-block">
            <!-- About Us -->
            <div class="section-full content-inner bg-gray">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-head text-black">
                                <h2 class="title">{{ isset($dynamicfields['services-title']) ? $dynamicfields['services-title'] : '' }}</h2>
                                <p>{{ isset($dynamicfields['services-description']) ? $dynamicfields['services-description'] : '' }}</p>
                            </div>
                            <div class="section-content row">
                                @if(isset($dynamicfields['services']) && is_array($dynamicfields['services']))
                                    @foreach ($dynamicfields['services'] as $item)
                                        <div class="col-lg-4 col-md-6 service-box style3">
                                            <div class="icon-bx-wraper" data-name="{{ isset($item['services-name']) ? $item['services-name'] : '' }}">
                                                <div class="icon-lg">
                                                    <a href="javascript:void(0);" class="icon-cell"><i
                                                            class="{{ isset($item['flaticon']) ? $item['flaticon'] : '' }}"></i></a>
                                                </div>
                                                <div class="icon-content">
                                                    <h2 class="dlab-tilte">{{ isset($item['services-title']) ? $item['services-title'] : '' }}</h2>
                                                    <p>{{ isset($item['services-description']) ? $item['services-description'] : '' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Our Services -->
            <!-- Why Chose Us -->
            <div class="section-full content-inner-1 overlay-black-dark about-8-service bg-img-fix"
                style="background-image:url({{ !empty($item['services-avatar']) ? app(Modules\Media\Repositories\FileRepository::class)->find($item['services-avatar'])->path : Theme::url('images/background/bg1.jpg') }});">
                <div class="container">
                    <div class="section-head text-white text-center">
                        <h2 class="title-box m-tb0 max-w800 m-auto">{{ isset($dynamicfields['services-information-title']) ? $dynamicfields['services-information-title'] : '' }}</h2>
                        <p>{{ isset($dynamicfields['services-information-description']) ? $dynamicfields['services-information-description'] : '' }}</p>
                    </div>
                </div>
                <div class="container">
                    <div class="row text-white">
                        @if(isset($dynamicfields['services-information-content']) && is_array($dynamicfields['services-information-content']))
                            @foreach ($dynamicfields['services-information-content'] as $item)
                                <div class="col-lg-4 col-md-4 m-b30">
                                    <div class="icon-bx-wraper bx-style-1 p-a30 center">
                                        <div class="icon-lg text-white m-b20"> <a href="javascript:void(0);"
                                                class="icon-cell text-white"><i class="{{ isset($item['flaticon']) ? $item['flaticon'] : '' }}"></i></a> </div>
                                        <div class="icon-content">
                                            <h4 class="dlab-tilte text-uppercase">{{ isset($item['services-information-content-title']) ? $item['services-information-content-title'] : '' }}</h4>
                                            <p>{{ isset($item['services-information-content-description']) ? $item['services-information-content-description'] : '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="choses-info text-white">
                    <div class="container-fluid">
                        <div class="row choses-info-content">
                            @php
                                $delay = 0.2;
                            @endphp
                            @if(isset($dynamicfields['services-information-volume']) && is_array($dynamicfields['services-information-volume']))
                                @foreach ($dynamicfields['services-information-volume'] as $item)
                                    <div class="col-lg-3 col-md-3 col-sm-6 p-a30 wow fadeInUp" data-wow-delay="{{ $delay }}s">
                                        <h2 class="m-t0 m-b10 font-weight-400 font-45"><i class="{{ isset($item['flaticon']) ? $item['flaticon'] : '' }} m-r10"></i><span>{{ isset($item['value']) ? $item['value'] : '0' }}</span></h2>
                                        <h4 class="font-weight-300 m-t0">{{ isset($item['title']) ? $item['title'] : '' }}</h4>
                                    </div>
                                    @php
                                        $delay += 0.2;
                                    @endphp
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Why Chose Us End -->
            <!-- Testimonials -->
            <div class="section-full content-inner wow fadeIn" data-wow-delay="0.4s"
                style="background-image:url({{ !empty($dynamicfields['services-testimonials-background']) ? app(Modules\Media\Repositories\FileRepository::class)->find($dynamicfields['services-testimonials-background'])->path : Theme::url('images/background/bg-map.jpg') }}); background-position:center; background-repeat:no-repeat;">
                <div class="container">
                    <div class="section-head text-center">
                        <h2 class="title">{{ isset($dynamicfields['services-testimonials-title']) ? $dynamicfields['services-testimonials-title'] : '' }}</h2>
                        <p>{{ isset($dynamicfields['services-testimonials-description']) ? $dynamicfields['services-testimonials-description'] : '' }}</p>
                    </div>
                    <div class="section-content m-b30 row">
                        <div
                            class="testimonial-box item-center owl-loaded owl-theme owl-carousel owl-none mfp-gallery owl-dots-black-full">
                            @if(isset($dynamicfields['services-testimonials']) && is_array($dynamicfields['services-testimonials']))
                                @foreach ($dynamicfields['services-testimonials'] as $item)
                                    <div class="item">
                                        <div class="testimonial-8">
                                            <div class="testimonial-text">
                                                <p>{{ isset($item['services-testimonials-content']) ? $item['services-testimonials-content'] : '' }}</p>
                                            </div>
                                            <div class="testimonial-detail clearfix">
                                                <div class="testimonial-pic radius shadow"><img
                                                        src="{{ !empty($item['services-testimonials-avatar']) ? app(Modules\Media\Repositories\FileRepository::class)->find($item['services-testimonials-avatar'])->path : Theme::url('images/demo-image/tes-pic1.jpg') }}" width="100"
                                                        height="100" alt=""></div>
                                                <strong class="testimonial-name">{{ isset($item['services-testimonials-name']) ? $item['services-testimonials-name'] : '' }}</strong>
                                                <span class="testimonial-position">{{ isset($item['services-testimonials-position']) ? $item['services-testimonials-position'] : '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Testimonials END -->
            <!-- Get in touch -->
            <div class="section-full overlay-black-dark bg-img-fix"
                style="background-image:url({{ !empty($dynamicfields['services-get-in-touch-background']) ? app(Modules\Media\Repositories\FileRepository::class)->find($dynamicfields['services-get-in-touch-background'])->path : Theme::url('images/background/bg1.jpg') }});">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-12 content-inner chosesus-content text-white">
                            <h2 class="title-box font-weight-300 m-b15 wow fadeInLeft" data-wow-delay="0.2s"> {{ isset($dynamicfields['services-get-in-touch-title']) ? $dynamicfields['services-get-in-touch-title'] : '' }}</h2>
                            <p class="font-16 op8 wow fadeInLeft" data-wow-delay="0.4s">{{ isset($dynamicfields['services-get-in-touch-description']) ? $dynamicfields['services-get-in-touch-description'] : '' }}</p>
                            <h3 class="font-weight-300 m-b50 op6 wow fadeInLeft" data-wow-delay="0.6s">{{ isset($dynamicfields['services-get-in-touch-volume']) ? $dynamicfields['services-get-in-touch-volume'] : '' }}</h3>
                            <h4 class="font-weight-300 wow fadeInLeft" data-wow-delay="0.8s">{{ isset($dynamicfields['services-get-in-touch-content-title']) ? $dynamicfields['services-get-in-touch-content-title'] : '' }}
                            </h4>
                            <ul class="list-checked primary wow fadeInLeft" data-wow-delay="1s">
                                @if(isset($dynamicfields['services-get-in-touch-content']) && is_array($dynamicfields['services-get-in-touch-content']))
                                    @foreach ($dynamicfields['services-get-in-touch-content'] as $item)
                                        <li><span>{{ isset($item['services-get-in-touch-content-item']) ? $item['services-get-in-touch-content-item'] : '' }}</span></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="col-lg-7 col-md-12 m-b30">
                            <form class="dzForm inquiry-form contact-project bg-white box-shadow wow fadeInUp" data-wow-delay="0.2s"
                                action="{{ route('fe.contact.contact.store') }}" method="POST">
                                @csrf
                                @php
                                    $products = getAllProducts();
                                    $categories = getAllCategories();
                                @endphp
                                <h3 class="title-box font-weight-300 m-t0 m-b10">Hãy để chúng tôi biến ý tưởng của bạn
                                    thành hiện thực <span class="bg-primary"></span></h3>
                                <p>Với đội ngũ chuyên gia giàu kinh nghiệm, chúng tôi cam kết mang đến những giải pháp tối
                                    ưu nhất cho dự án của bạn. Hãy liên hệ ngay để được tư vấn chi tiết.</p>
                                <br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="ti-user text-primary"></i></span>
                                                <input name="contact_name" type="text" class="form-control"
                                                    placeholder="Họ tên">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="ti-mobile text-primary"></i></span>
                                                <input name="phone_number" type="text" class="form-control dz-number"
                                                    placeholder="Số điện thoại">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="ti-view-list text-primary"></i></span>
                                                <select name="type_id" id="contact-type" class="form-control"
                                                    data-template-selector="true" disabled>
                                                    @foreach ($categories as $option)
                                                        <option value="{{ $option->id }}"
                                                            data-template-name="{{ $option->translate(locale())->title }}"
                                                            {{ $option->translate(locale())->title == 'Dịch vụ' ? 'selected' : '' }}>
                                                            {{ $option->translate(locale())->title }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="type_id" value="{{ $categories->where('translations.title', 'Dịch vụ')->first()->id ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="ti-email text-primary"></i></span>
                                                <input name="email" type="email" class="form-control"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="template-box row" data-template-name="Sản phẩm" style="display: none;">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="ti-agenda text-primary"></i></span>
                                                    <input name="product_contact_title" type="text"
                                                        value="Tư vấn sản phẩm" readonly class="form-control"
                                                        placeholder="Tiêu đề">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="ti-filter text-primary"></i></span>
                                                    <select name="product_id" id="product_contact" class="form-control">
                                                        <option value="">-- Chọn Sản phẩm --</option>
                                                        @foreach ($products as $option)
                                                            <option value="{{ $option->id }}">
                                                                {{ $option->translate(locale())->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="ti-comment text-primary"></i></span>
                                                    <textarea name="product_messages" rows="4" class="form-control" placeholder="Nhập nội dung"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="template-box row" data-template-name="Dịch vụ" style="display: none;">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="ti-agenda text-primary"></i></span>
                                                    <input name="service_contact_title" type="text"
                                                        class="form-control" placeholder="Tiêu đề">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="ti-home text-primary"></i></span>
                                                    <input name="assembly_address" type="text" class="form-control"
                                                        placeholder="Địa chỉ lắp ráp">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="ti-receipt text-primary"></i></span>
                                                    <input name="monthly_consumption_kwh" type="text"
                                                        class="form-control dz-number"
                                                        placeholder="Lượng tiêu thụ hàng tháng (kWh)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="ti-money text-primary"></i></span>
                                                    <input name="avg_monthly_cost_vnd" type="text"
                                                        class="form-control dz-number"
                                                        placeholder="Tiền điện trung bình mỗi tháng (vnd)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="ti-receipt text-primary"></i></span>
                                                    <input name="financial_capacity_kw" type="text"
                                                        class="form-control dz-number"
                                                        placeholder="Công suất tải chính (kW)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="ti-ruler text-primary"></i></span>
                                                    <input name="avl_roof_area_m2" type="text"
                                                        class="form-control dz-number"
                                                        placeholder="Diện tích mái nhà khả dụng (m2)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="ti-notepad text-primary"></i></span>
                                                    <input name="power_phase_count" type="text"
                                                        class="form-control dz-number"
                                                        placeholder="Số pha sử dụng cho nguồn điện">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="template-box row" data-template-name="Hỗ trợ" style="display: none;">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="ti-agenda text-primary"></i></span>
                                                    <input name="support_contact_title" type="text"
                                                        class="form-control" placeholder="Tiêu đề">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="ti-comment text-primary"></i></span>
                                                    <textarea name="support_messages" rows="4" class="form-control" placeholder="Nhập nội dung"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <button name="submit" type="submit" value="Submit"
                                            class="site-button button-md"> <span>Gửi</span> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Get in touch -->
        </div>
        <!-- contact area END -->
    </div>
@stop

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hiển thị template Dịch vụ khi trang được tải
    var serviceTemplate = document.querySelector('.template-box[data-template-name="Dịch vụ"]');
    if (serviceTemplate) {
        serviceTemplate.style.display = 'flex';
    }
});
</script>
@stop