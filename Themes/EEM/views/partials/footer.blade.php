<!-- Footer -->
<footer class="site-footer text-uppercase">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xl-4 col-lg-4 col-sm-6 footer-col-4 ">
                    <div class="widget">
                        <div class="subscribe-form m-b20">
                            <a href="{{ route('homepage') }}"><img src="{{ Theme::url('images/LogoViet.png') }}" alt=""></a>
                        </div>
                        <ul class="list-inline m-a0" style="text-align: center">
                            <li><a href="javascript:void(0);" class="site-button facebook circle "><i
                                        class="fab fa-facebook-f"></i></a></li>
                            <li><a href="javascript:void(0);" class="site-button google-plus circle "><i
                                        class="fab fa-google-plus-g"></i></a></li>
                            <li><a href="javascript:void(0);" class="site-button linkedin circle "><i
                                        class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="javascript:void(0);" class="site-button instagram circle "><i
                                        class="fab fa-instagram"></i></a></li>
                            <li><a href="javascript:void(0);" class="site-button twitter circle "><i
                                        class="fab fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-7 col-xl-2 col-lg-3 col-sm-6 footer-col-4">
                    <div class="widget widget_services border-0">
                        <h5 class="m-b30 text-white">Công ty eem</h5>
                        @menu('footer_company', 'footer_menu')
                    </div>
                </div>
                <div class="col-md-3 col-5 col-xl-2 col-lg-2 col-sm-6 footer-col-4">
                    <div class="widget widget_services border-0">
                        <h5 class="m-b30 text-white">dịch vụ</h5>
                        @menu('footer_services', 'footer_menu')
                        {{-- <ul>
                            <li><a href="/dich-vu">Dịch vụ</a></li>
                            <li><a href="/san-pham">Sản phẩm</a></li>
                            <li><a href="/lien-he">Liên hệ</a></li>
                        </ul> --}}
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 col-lg-3 col-sm-6 footer-col-4">
                    <div class="widget widget_getintuch">
                        <h5 class="m-b30 text-white">Thông tin liên hệ</h5>
                        <ul>
                            <li><i class="ti-location-pin"></i><strong>Địa chỉ</strong> {{ $address }}</li>
                            <li><i class="ti-mobile"></i><strong>Điện thoại</strong>{{ $phone }}</li>
                            <li><i class="ti-email"></i><strong>Email</strong>{{ $email }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom part -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 text-left "> <span>Copyright © 2025 <a href="{{ route('homepage') }}">{{ $site_name }}</a>. all rights reserved.</span> </div>
                {{-- <div class="col-md-6 col-sm-6 text-right ">
                    <div class="widget-link ">
                        <ul>
                            <li><a href="about-2.html"> About</a></li>
                            <li><a href="help-desk.html"> Help Desk</a></li>
                            <li><a href="privacy-policy.html"> Privacy Policy</a></li>
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</footer>
<!-- Footer END -->