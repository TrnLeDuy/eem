<header class="site-header mo-left header navstyle1 header-bottom">
    <!-- main header -->
    <div class="sticky-header main-bar-wraper header-curve navbar-expand-lg">
        <div class="main-bar clearfix bg-primary">
            <div class="container clearfix">
                <!-- website logo -->
                <div class="logo-header">
                    <a href="{{ route('homepage') }}"><img src={{ $header_logo }} alt=""></a>
                </div>
                <!-- nav toggle button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- extra nav -->
                <div class="extra-nav">
                    <div class="extra-cell">
                        <button id="quik-search-btn" type="button" class="site-button-link"><i
                                class="la la-search"></i></button>
                    </div>
                </div>
                <!-- Quik search -->
                <div class="dlab-quik-search ">
                    <form action="{{ route('fe.product.product.search') }}" method="GET">
                        <input name="keyword" value="" type="text" class="form-control"
                            placeholder="Tìm kiếm sản phẩm">
                        <span id="quik-search-remove"><i class="ti-close"></i></span>
                    </form>
                </div>
                <!-- main nav -->
                <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                    <div class="logo-header d-md-block d-lg-none">
                        <a href="{{ route('homepage') }}"><img src={{ $header_logo }} alt=""></a>
                    </div>
                    @menu('main_menu', 'main_menu')
                    <div class="dlab-social-icon">
                        <ul>
                            <li><a class="site-button facebook sharp-sm fab fa-facebook-f"
                                    href="javascript:void(0);"></a></li>
                            <li><a class="site-button twitter sharp-sm fab fa-twitter" href="javascript:void(0);"></a>
                            </li>
                            <li><a class="site-button linkedin sharp-sm fab fa-linkedin-in"
                                    href="javascript:void(0);"></a></li>
                            <li><a class="site-button instagram sharp-sm fab fa-instagram"
                                    href="javascript:void(0);"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main header END -->
</header>
