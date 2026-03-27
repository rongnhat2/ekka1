@extends('customer.layout')
@section('title', 'Trang chủ')

@section('css')
@endsection()


@section('body')
    <!-- Main Slider Start -->
    <div class="sticky-header-next-sec ec-main-slider section section-space-pb">
        <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
            <!-- Main slider -->
            <div class="swiper-wrapper slider-wrapper">
                <div class="ec-slide-item swiper-slide d-flex ec-slide-1"
                    style="background-image: url('{{ asset('image-upload/1769613549untitled-2.png') }}')">
                    <div class="container align-self-center">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center bg-gradient-primary">
                                <div class="ec-slide-content slider-animation">
                                    <h1 class="ec-slide-title">Áo Len</h1>
                                    <h2 class="ec-slide-stitle">Đang giảm giá</h2>
                                    <p>Áo len là một loại vải từ sợi len, được sử dụng để may áo, quần, váy, và nhiều sản
                                        phẩm khác.</p>
                                    <a href="/product" class="btn btn-lg btn-secondary">Xem ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ec-slide-item swiper-slide d-flex ec-slide-1"
                    style="background-image: url('{{ asset('image-upload/1769613549untitled-2.png') }}')">
                    <div class="container align-self-center">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center bg-gradient-primary">
                                <div class="ec-slide-content slider-animation">
                                    <h1 class="ec-slide-title">Áo khoác nỉ</h1>
                                    <h2 class="ec-slide-stitle">Đang giảm giá</h2>
                                    <p>Áo khoác nỉ là một loại vải từ sợi nỉ, được sử dụng để may áo, quần, váy, và nhiều
                                        sản phẩm khác.</p>
                                    <a href="/product" class="btn btn-lg btn-secondary">Xem ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
    <!-- Main Slider End -->

    <!-- Product tab Area Start -->
    <section class="section ec-product-tab section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Top sản phẩm theo danh mục</h2>
                        <h2 class="ec-title">Top sản phẩm theo danh mục</h2>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <ul class="ec-pro-tab-nav nav justify-content-center category-tab-list">
                        <li class="nav-item">
                            <a class="nav-link active" category-id="1">Áo Len</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" category-id="2">Áo khoác nỉ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" category-id="3">Áo khoác nỉ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" category-id="4">Áo khoác nỉ</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pro-for-all">
                            <div class="row data-category-render">
                                <div
                                    class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content product-category-data">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="/product" class="image">
                                                    <img class="main-image"
                                                        src="{{ asset('image-upload/17696132581.2.15.3.18.001.225.23.50500038_2__2.webp') }}"
                                                        alt="Product" />
                                                </a>
                                                <span class="percentage">10%</span><span class="flags"> <span
                                                        class="sale">Sale</span> </span>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="/product">Áo khoác nỉ</a></h5>
                                            <span class="ec-price">
                                                <span class="old-price">100.000 đ</span>
                                                <span class="new-price">90.000 đ</span>
                                            </span>
                                            <div class="ec-pro-option">
                                                <div class="ec-pro-color">
                                                    <span class="ec-pro-opt-label">Color</span>
                                                    <ul class="ec-opt-swatch ec-change-img">
                                                        <li><a href="#" class="ec-opt-clr-img"><span
                                                                    style="background-color: #000;"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="ec-pro-size">
                                                    <span class="ec-pro-opt-label">Size</span>
                                                    <ul class="ec-opt-size">
                                                        <li><a href="#" class="ec-opt-sz">M</a></li>
                                                        <li><a href="#" class="ec-opt-sz">L</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XL</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XXL</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content product-category-data">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="/product" class="image">
                                                    <img class="main-image"
                                                        src="{{ asset('image-upload/17696132581.2.15.3.18.001.225.23.50500038_2__2.webp') }}"
                                                        alt="Product" />
                                                </a>
                                                <span class="percentage">10%</span><span class="flags"> <span
                                                        class="sale">Sale</span> </span>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="/product">Áo khoác nỉ</a></h5>
                                            <span class="ec-price">
                                                <span class="old-price">100.000 đ</span>
                                                <span class="new-price">90.000 đ</span>
                                            </span>
                                            <div class="ec-pro-option">
                                                <div class="ec-pro-color">
                                                    <span class="ec-pro-opt-label">Color</span>
                                                    <ul class="ec-opt-swatch ec-change-img">
                                                        <li><a href="#" class="ec-opt-clr-img"><span
                                                                    style="background-color: #000;"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="ec-pro-size">
                                                    <span class="ec-pro-opt-label">Size</span>
                                                    <ul class="ec-opt-size">
                                                        <li><a href="#" class="ec-opt-sz">M</a></li>
                                                        <li><a href="#" class="ec-opt-sz">L</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XL</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XXL</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content product-category-data">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="/product" class="image">
                                                    <img class="main-image"
                                                        src="{{ asset('image-upload/17696132581.2.15.3.18.001.225.23.50500038_2__2.webp') }}"
                                                        alt="Product" />
                                                </a>
                                                <span class="percentage">10%</span><span class="flags"> <span
                                                        class="sale">Sale</span> </span>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="/product">Áo khoác nỉ</a></h5>
                                            <span class="ec-price">
                                                <span class="old-price">100.000 đ</span>
                                                <span class="new-price">90.000 đ</span>
                                            </span>
                                            <div class="ec-pro-option">
                                                <div class="ec-pro-color">
                                                    <span class="ec-pro-opt-label">Color</span>
                                                    <ul class="ec-opt-swatch ec-change-img">
                                                        <li><a href="#" class="ec-opt-clr-img"><span
                                                                    style="background-color: #000;"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="ec-pro-size">
                                                    <span class="ec-pro-opt-label">Size</span>
                                                    <ul class="ec-opt-size">
                                                        <li><a href="#" class="ec-opt-sz">M</a></li>
                                                        <li><a href="#" class="ec-opt-sz">L</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XL</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XXL</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content product-category-data">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="/product" class="image">
                                                    <img class="main-image"
                                                        src="{{ asset('image-upload/17696121641.2.18.1.18.001.225.23.10200011_1_.webp') }}"
                                                        alt="Product" />
                                                </a>
                                                <span class="percentage">10%</span><span class="flags"> <span
                                                        class="sale">Sale</span> </span>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="/product">Áo khoác nỉ</a></h5>
                                            <span class="ec-price">
                                                <span class="old-price">100.000 đ</span>
                                                <span class="new-price">90.000 đ</span>
                                            </span>
                                            <div class="ec-pro-option">
                                                <div class="ec-pro-color">
                                                    <span class="ec-pro-opt-label">Color</span>
                                                    <ul class="ec-opt-swatch ec-change-img">
                                                        <li><a href="#" class="ec-opt-clr-img"><span
                                                                    style="background-color: #000;"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="ec-pro-size">
                                                    <span class="ec-pro-opt-label">Size</span>
                                                    <ul class="ec-opt-size">
                                                        <li><a href="#" class="ec-opt-sz">M</a></li>
                                                        <li><a href="#" class="ec-opt-sz">L</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XL</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XXL</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content product-category-data">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="/product" class="image">
                                                    <img class="main-image"
                                                        src="{{ asset('image-upload/17696132581.2.15.3.18.001.225.23.50500038_2__2.webp') }}"
                                                        alt="Product" />
                                                </a>
                                                <span class="percentage">10%</span><span class="flags"> <span
                                                        class="sale">Sale</span> </span>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="/product">Áo khoác nỉ</a></h5>
                                            <span class="ec-price">
                                                <span class="old-price">100.000 đ</span>
                                                <span class="new-price">90.000 đ</span>
                                            </span>
                                            <div class="ec-pro-option">
                                                <div class="ec-pro-color">
                                                    <span class="ec-pro-opt-label">Color</span>
                                                    <ul class="ec-opt-swatch ec-change-img">
                                                        <li><a href="#" class="ec-opt-clr-img"><span
                                                                    style="background-color: #000;"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="ec-pro-size">
                                                    <span class="ec-pro-opt-label">Size</span>
                                                    <ul class="ec-opt-size">
                                                        <li><a href="#" class="ec-opt-sz">M</a></li>
                                                        <li><a href="#" class="ec-opt-sz">L</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XL</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XXL</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content product-category-data">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="/product" class="image">
                                                    <img class="main-image"
                                                        src="{{ asset('image-upload/17696132581.2.15.3.18.001.225.23.50500038_2__2.webp') }}"
                                                        alt="Product" />
                                                </a>
                                                <span class="percentage">10%</span><span class="flags"> <span
                                                        class="sale">Sale</span> </span>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="/product">Áo khoác nỉ</a></h5>
                                            <span class="ec-price">
                                                <span class="old-price">100.000 đ</span>
                                                <span class="new-price">90.000 đ</span>
                                            </span>
                                            <div class="ec-pro-option">
                                                <div class="ec-pro-color">
                                                    <span class="ec-pro-opt-label">Color</span>
                                                    <ul class="ec-opt-swatch ec-change-img">
                                                        <li><a href="#" class="ec-opt-clr-img"><span
                                                                    style="background-color: #000;"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="ec-pro-size">
                                                    <span class="ec-pro-opt-label">Size</span>
                                                    <ul class="ec-opt-size">
                                                        <li><a href="#" class="ec-opt-sz">M</a></li>
                                                        <li><a href="#" class="ec-opt-sz">L</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XL</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XXL</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content product-category-data">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="/product" class="image">
                                                    <img class="main-image"
                                                        src="{{ asset('image-upload/17696132581.2.15.3.18.001.225.23.50500038_2__2.webp') }}"
                                                        alt="Product" />
                                                </a>
                                                <span class="percentage">10%</span><span class="flags"> <span
                                                        class="sale">Sale</span> </span>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="/product">Áo khoác nỉ</a></h5>
                                            <span class="ec-price">
                                                <span class="old-price">100.000 đ</span>
                                                <span class="new-price">90.000 đ</span>
                                            </span>
                                            <div class="ec-pro-option">
                                                <div class="ec-pro-color">
                                                    <span class="ec-pro-opt-label">Color</span>
                                                    <ul class="ec-opt-swatch ec-change-img">
                                                        <li><a href="#" class="ec-opt-clr-img"><span
                                                                    style="background-color: #000;"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="ec-pro-size">
                                                    <span class="ec-pro-opt-label">Size</span>
                                                    <ul class="ec-opt-size">
                                                        <li><a href="#" class="ec-opt-sz">M</a></li>
                                                        <li><a href="#" class="ec-opt-sz">L</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XL</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XXL</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content product-category-data">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="/product" class="image">
                                                    <img class="main-image"
                                                        src="{{ asset('image-upload/17696121641.2.18.1.18.001.225.23.10200011_1_.webp') }}"
                                                        alt="Product" />
                                                </a>
                                                <span class="percentage">10%</span><span class="flags"> <span
                                                        class="sale">Sale</span> </span>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="/product">Áo khoác nỉ</a></h5>
                                            <span class="ec-price">
                                                <span class="old-price">100.000 đ</span>
                                                <span class="new-price">90.000 đ</span>
                                            </span>
                                            <div class="ec-pro-option">
                                                <div class="ec-pro-color">
                                                    <span class="ec-pro-opt-label">Color</span>
                                                    <ul class="ec-opt-swatch ec-change-img">
                                                        <li><a href="#" class="ec-opt-clr-img"><span
                                                                    style="background-color: #000;"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="ec-pro-size">
                                                    <span class="ec-pro-opt-label">Size</span>
                                                    <ul class="ec-opt-size">
                                                        <li><a href="#" class="ec-opt-sz">M</a></li>
                                                        <li><a href="#" class="ec-opt-sz">L</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XL</a></li>
                                                        <li><a href="#" class="ec-opt-sz">XXL</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ec Product tab Area End -->

    <!--  services Section Start -->
    <section class="section ec-services-section section-space-p">
        <h2 class="d-none">Services</h2>
        <div class="container">
            <div class="row">
                <div class="ec_ser_content ec_ser_content_1 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-desc">
                            <h2>Miễn phí ship</h2>
                            <p>Free shipping toàn quốc</p>
                        </div>
                    </div>
                </div>
                <div class="ec_ser_content ec_ser_content_2 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-desc">
                            <h2>24X7 Hỗ trợ</h2>
                            <p>Liên hệ với chúng tôi 24/7</p>
                        </div>
                    </div>
                </div>
                <div class="ec_ser_content ec_ser_content_3 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-desc">
                            <h2>Đổi trả hàng trong 30 ngày</h2>
                            <p>Trả hàng trong 30 ngày nếu có lỗi</p>
                        </div>
                    </div>
                </div>
                <div class="ec_ser_content ec_ser_content_4 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-desc">
                            <h2>Thanh toán trực tuyến</h2>
                            <p>Tích hợp thanh toán online</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--services Section End -->

    <!--  offer Section Start -->
    {{-- <section class="section ec-offer-section section-space-p section-space-m offer-wrapper">

    </section> --}}
    <!-- offer Section End -->
    <section class="section carousel-wrapper">
        <div class="owl-carousel banner-carousel" id="banner">
            <div class="carousel-item-element">
                <img src="{{ asset('image-upload/1769611704desktop_tt__1_2.webp') }}" alt="">
            </div>
        </div>
    </section>


    <!-- New Product Start -->
    <section class="section ec-new-product section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Sản phẩm mới</h2>
                        <h2 class="ec-title">Sản phẩm mới</h2>
                        <p class="sub-title">Danh sách sản phẩm mới</p>
                    </div>
                </div>
            </div>
            <div class="row new-product">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content product-category-data">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="/product" class="image">
                                    <img class="main-image"
                                        src="{{ asset('image-upload/17696132581.2.15.3.18.001.225.23.50500038_2__2.webp') }}"
                                        alt="Product" />
                                </a>
                                <span class="percentage">10%</span><span class="flags"> <span class="sale">Sale</span>
                                </span>
                            </div>
                        </div>
                        <div class="ec-pro-content">
                            <h5 class="ec-pro-title"><a href="/product">Áo khoác nỉ</a></h5>
                            <span class="ec-price">
                                <span class="old-price">100.000 đ</span>
                                <span class="new-price">90.000 đ</span>
                            </span>
                            <div class="ec-pro-option">
                                <div class="ec-pro-color">
                                    <span class="ec-pro-opt-label">Color</span>
                                    <ul class="ec-opt-swatch ec-change-img">
                                        <li><a href="#" class="ec-opt-clr-img"><span
                                                    style="background-color: #000;"></span></a></li>
                                    </ul>
                                </div>
                                <div class="ec-pro-size">
                                    <span class="ec-pro-opt-label">Size</span>
                                    <ul class="ec-opt-size">
                                        <li><a href="#" class="ec-opt-sz">M</a></li>
                                        <li><a href="#" class="ec-opt-sz">L</a></li>
                                        <li><a href="#" class="ec-opt-sz">XL</a></li>
                                        <li><a href="#" class="ec-opt-sz">XXL</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content product-category-data">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="/product" class="image">
                                    <img class="main-image"
                                        src="{{ asset('image-upload/17696132581.2.15.3.18.001.225.23.50500038_2__2.webp') }}"
                                        alt="Product" />
                                </a>
                                <span class="percentage">10%</span><span class="flags"> <span class="sale">Sale</span>
                                </span>
                            </div>
                        </div>
                        <div class="ec-pro-content">
                            <h5 class="ec-pro-title"><a href="/product">Áo khoác nỉ</a></h5>
                            <span class="ec-price">
                                <span class="old-price">100.000 đ</span>
                                <span class="new-price">90.000 đ</span>
                            </span>
                            <div class="ec-pro-option">
                                <div class="ec-pro-color">
                                    <span class="ec-pro-opt-label">Color</span>
                                    <ul class="ec-opt-swatch ec-change-img">
                                        <li><a href="#" class="ec-opt-clr-img"><span
                                                    style="background-color: #000;"></span></a></li>
                                    </ul>
                                </div>
                                <div class="ec-pro-size">
                                    <span class="ec-pro-opt-label">Size</span>
                                    <ul class="ec-opt-size">
                                        <li><a href="#" class="ec-opt-sz">M</a></li>
                                        <li><a href="#" class="ec-opt-sz">L</a></li>
                                        <li><a href="#" class="ec-opt-sz">XL</a></li>
                                        <li><a href="#" class="ec-opt-sz">XXL</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content product-category-data">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="/product" class="image">
                                    <img class="main-image"
                                        src="{{ asset('image-upload/17696132581.2.15.3.18.001.225.23.50500038_2__2.webp') }}"
                                        alt="Product" />
                                </a>
                                <span class="percentage">10%</span><span class="flags"> <span class="sale">Sale</span>
                                </span>
                            </div>
                        </div>
                        <div class="ec-pro-content">
                            <h5 class="ec-pro-title"><a href="/product">Áo khoác nỉ</a></h5>
                            <span class="ec-price">
                                <span class="old-price">100.000 đ</span>
                                <span class="new-price">90.000 đ</span>
                            </span>
                            <div class="ec-pro-option">
                                <div class="ec-pro-color">
                                    <span class="ec-pro-opt-label">Color</span>
                                    <ul class="ec-opt-swatch ec-change-img">
                                        <li><a href="#" class="ec-opt-clr-img"><span
                                                    style="background-color: #000;"></span></a></li>
                                    </ul>
                                </div>
                                <div class="ec-pro-size">
                                    <span class="ec-pro-opt-label">Size</span>
                                    <ul class="ec-opt-size">
                                        <li><a href="#" class="ec-opt-sz">M</a></li>
                                        <li><a href="#" class="ec-opt-sz">L</a></li>
                                        <li><a href="#" class="ec-opt-sz">XL</a></li>
                                        <li><a href="#" class="ec-opt-sz">XXL</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content product-category-data">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="/product" class="image">
                                    <img class="main-image"
                                        src="{{ asset('image-upload/17696132581.2.15.3.18.001.225.23.50500038_2__2.webp') }}"
                                        alt="Product" />
                                </a>
                                <span class="percentage">10%</span><span class="flags"> <span class="sale">Sale</span>
                                </span>
                            </div>
                        </div>
                        <div class="ec-pro-content">
                            <h5 class="ec-pro-title"><a href="/product">Áo khoác nỉ</a></h5>
                            <span class="ec-price">
                                <span class="old-price">100.000 đ</span>
                                <span class="new-price">90.000 đ</span>
                            </span>
                            <div class="ec-pro-option">
                                <div class="ec-pro-color">
                                    <span class="ec-pro-opt-label">Color</span>
                                    <ul class="ec-opt-swatch ec-change-img">
                                        <li><a href="#" class="ec-opt-clr-img"><span
                                                    style="background-color: #000;"></span></a></li>
                                    </ul>
                                </div>
                                <div class="ec-pro-size">
                                    <span class="ec-pro-opt-label">Size</span>
                                    <ul class="ec-opt-size">
                                        <li><a href="#" class="ec-opt-sz">M</a></li>
                                        <li><a href="#" class="ec-opt-sz">L</a></li>
                                        <li><a href="#" class="ec-opt-sz">XL</a></li>
                                        <li><a href="#" class="ec-opt-sz">XXL</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- New Product end -->


@endsection()


@section('sub_layout')

@endsection()


@section('js')

    <script src="{{ asset('customer/assets/js/page/index.js') }}"></script>

@endsection()