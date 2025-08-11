@php
    $address = setting('core::address') ?: 'Thành phố Hồ Chí Minh, Việt Nam';
    $email = setting('core::email') ?: 'contact123@gmail.com';
    $phone = setting('core::phone') ?: '(654) 321-7654';
    $open = setting('core::open-time') ?: '10:00 - 19:00';
    $close = setting('core::close-time') ?: '10:00 - 19:00';
@endphp
@extends('layouts.master')

@section('title')
    {{ $page->title }} | @parent
@stop

@section('styles')
<style>
.template-box {
    height: 400px; /* Tăng chiều cao lên một chút để tránh lệch */
}
</style>
@endsection

@section('content')
<div class="page-content bg-white">
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
    <!-- Contact Form -->
    <div class="section-full content-inner contact-page-9 overlay-black-dark" style="background-image: url({{ Theme::url('images/background/bg5.jpg') }}); background-position: 30% 100%">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 text-white">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 m-b30">
                            <div class="icon-bx-wraper bx-style-1 p-a20 radius-sm">
                                <div class="icon-content">
                                    <h5 class="dlab-tilte">
                                        <span class="icon-sm text-primary"><i class="ti-location-pin"></i></span> 
                                        Địa chỉ
                                    </h5>
                                    <p>{{ $address }}</p>
                                    <br>
                                    <h6 class="m-b15 font-weight-400"><i class="ti-alarm-clock"></i> Giờ làm việc:</h6>
                                    <p class="m-b0">{{ $open }}</p>
                                    <p>{{ $close }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 m-b30">
                            <div class="icon-bx-wraper bx-style-1 p-a20 radius-sm">
                                <div class="icon-content">
                                    <h5 class="dlab-tilte">
                                        <span class="icon-sm text-primary"><i class="ti-email"></i></span> 
                                        Email
                                    </h5>
                                    <p class="m-b0"><a href="mailto:someone@example.com" class="text-white">{{ $email }}</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 m-b30">
                            <div class="icon-bx-wraper bx-style-1 p-a20 radius-sm">
                                <div class="icon-content">
                                    <h5 class="dlab-tilte">
                                        <span class="icon-sm text-primary"><i class="ti-mobile"></i></span> 
                                        Số điện thoại:
                                    </h5>
                                    <p class="m-b0"><a href="tel:+{{ $phone }}" class="text-white">{{ $phone }}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 m-b30">
                    <form class="inquiry-form dzForm wow box-shadow bg-white fadeInUp" data-wow-delay="0.2s" action="{{ route('fe.contact.contact.store') }}" method="POST">
                        @csrf
                        <h3 class="title-box font-weight-300 m-t0 m-b10">Hãy để chúng tôi biến ý tưởng của bạn thành hiện thực <span class="bg-primary"></span></h3>
                        <p>Với đội ngũ chuyên gia giàu kinh nghiệm, chúng tôi cam kết mang đến những giải pháp tối ưu nhất cho dự án của bạn. Hãy liên hệ ngay để được tư vấn chi tiết.</p>
                        <br>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="ti-user text-primary"></i></span>
                                        <input name="contact_name" type="text" class="form-control" placeholder="Họ tên">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="ti-mobile text-primary"></i></span>
                                        <input name="phone_number" type="text" class="form-control dz-number" placeholder="Số điện thoại">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="ti-view-list text-primary"></i></span>
                                        <select name="type_id" id="contact-type" class="form-control" data-template-selector="true">
                                            @foreach ($categories as $option)
                                                <option value="{{ $option->id }}" data-template-name="{{ $option->translate(locale())->title }}" {{ $option->translate(locale())->title == 'Dịch vụ' ? 'selected' : '' }}>{{ $option->translate(locale())->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-group"> 
                                        <span class="input-group-addon"><i class="ti-email text-primary"></i></span>
                                        <input name="email" type="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="template-box row" data-template-name="Sản phẩm" style="display: none;">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-agenda text-primary"></i></span>
                                            <input name="product_contact_title" type="text" value="Tư vấn sản phẩm" readonly class="form-control" placeholder="Tiêu đề">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-filter text-primary"></i></span>
                                            <select name="product_id" id="product_contact" class="form-control">
                                                <option value="">-- Chọn Sản phẩm --</option>
                                                @foreach ($products as $option)
                                                    <option value="{{ $option->id }}" {{ $option->translate(locale())->title == 'Dịch vụ' ? 'selected' : '' }}>{{ $option->translate(locale())->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-comment text-primary"></i></span>
                                            <textarea name="product_messages" rows="8" class="form-control" placeholder="Nhập nội dung"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="template-box row" data-template-name="Dịch vụ" style="display: none;">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-agenda text-primary"></i></span>
                                            <input name="service_contact_title" type="text" class="form-control" placeholder="Tiêu đề">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-home text-primary"></i></span>
                                            <input name="assembly_address" type="text" class="form-control" placeholder="Địa chỉ lắp ráp">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-receipt text-primary"></i></span>
                                            <input name="monthly_consumption_kwh" type="text" class="form-control dz-number" placeholder="Lượng tiêu thụ hàng tháng (kWh)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-money text-primary"></i></span>
                                            <input name="avg_monthly_cost_vnd" type="text" class="form-control dz-number" placeholder="Tiền điện trung bình mỗi tháng (vnd)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-receipt text-primary"></i></span>
                                            <input name="financial_capacity_kw" type="text" class="form-control dz-number" placeholder="Công suất tải chính (kW)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-ruler text-primary"></i></span>
                                            <input name="avl_roof_area_m2" type="text" class="form-control dz-number" placeholder="Diện tích mái nhà khả dụng (m2)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-notepad text-primary"></i></span>
                                            <input name="power_phase_count" type="text" class="form-control dz-number" placeholder="Số pha sử dụng cho nguồn điện">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="template-box row" data-template-name="Hỗ trợ" style="display: none;">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-agenda text-primary"></i></span>
                                            <input name="support_contact_title" type="text" class="form-control" placeholder="Tiêu đề">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-comment text-primary"></i></span>
                                            <textarea name="support_messages" rows="12" class="form-control" placeholder="Nhập nội dung"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <button name="submit" type="submit" value="Submit" class="site-button button-md"> <span>Gửi</span> </button>
                            </div>
                        </div>
                    </form>	
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Form END -->
</div>
@stop

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to show template based on selected type
    function showTemplate(templateName) {
        // Hide all templates
        document.querySelectorAll('.template-box').forEach(function(box) {
            box.style.display = 'none';
        });
        
        // Show the selected template
        var templateToShow = document.querySelector('.template-box[data-template-name="' + templateName + '"]');
        if (templateToShow) {
            templateToShow.style.display = 'flex';
        }
        
        // Update dropdown selection
        var contactType = document.getElementById('contact-type');
        if (contactType) {
            for (var i = 0; i < contactType.options.length; i++) {
                if (contactType.options[i].getAttribute('data-template-name') === templateName) {
                    contactType.selectedIndex = i;
                    break;
                }
            }
        }
    }
    
    // Check URL parameters for pre-selection
    const urlParams = new URLSearchParams(window.location.search);
    const type = urlParams.get('type');
    const productId = urlParams.get('product_id');
    
    if (type === 'product' && productId) {
        // Show product template
        showTemplate('Sản phẩm');
        
        // Select the product in dropdown
        var productDropdown = document.getElementById('product_contact');
        if (productDropdown) {
            for (var i = 0; i < productDropdown.options.length; i++) {
                if (productDropdown.options[i].value === productId) {
                    productDropdown.selectedIndex = i;
                    break;
                }
            }
        }
    } else {
        // Default to service template if no parameters
        showTemplate('Dịch vụ');
    }
    
    // Handle the change event for contact type
    document.getElementById('contact-type').addEventListener('change', function() {
        // Get the template name from the selected option
        var selectedOption = this.options[this.selectedIndex];
        var templateName = selectedOption.getAttribute('data-template-name');
        
        // Show the corresponding template
        if (templateName) {
            showTemplate(templateName);
        }
    });
});
</script>
@endsection
