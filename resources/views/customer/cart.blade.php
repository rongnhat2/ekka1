@extends('customer.layout')
@section('title', 'Giỏ hàng')

@section('css')
@endsection()


@section('body')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Giỏ hàng</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="/">Trang chủ</a></li>
                                <li class="ec-breadcrumb-item active">Giỏ hàng</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec cart page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-cart-leftside col-lg-8 col-md-12 ">
                    <div class="ec-cart-content">
                        <div class="ec-cart-inner">
                            <div class="row">
                                <form action="#">
                                    <div class="table-content cart-table-content">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Đơn giá</th>
                                                    <th>Size</th>
                                                    <th style="text-align: center;">Số lượng</th>
                                                    <th>Thành tiền</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="cart-list">

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ec-cart-update-bottom">
                                                <a href="category?tag=0">Tiếp tục mua hàng</a>
                                                <a href="checkout" class="btn btn-primary action-checkout">Đặt hàng</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ec-cart-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Thanh toán</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-cart-summary-bottom">
                                    <div class="ec-cart-summary">
                                        <div>
                                            <span class="text-left">Tạm tính</span>
                                            <span class="text-right sub-total"> </span>
                                        </div>
                                        <div>
                                            <span class="text-left">Giảm giá</span>
                                            <span class="text-right discount-total"> </span>
                                        </div>
                                        <div class="ec-cart-summary-total">
                                            <span class="text-left">Tổng</span>
                                            <span class="text-right real-total"> </span>
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
    <!-- New Product Start -->
    <section class="section ec-new-product section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Sản phẩm mới</h2>
                        <h2 class="ec-title">Sản phẩm mới</h2>
                    </div>
                </div>
            </div>
            <div class="row new-product"> </div>
        </div>
    </section>
@endsection()


@section('sub_layout')
    <script>
        window.EKKA_ENABLE_MOCK_HEADER = true;
    </script>
@endsection()


@section('js')
    <script>
        // Mock data để `public/customer/assets/js/page/cart.js` render mà không gọi API thật.
        (() => {
            const ok = (payload) => $.Deferred().resolve(payload).promise();

            // Seed giỏ hàng (cart.js render dựa trên localStorage).
            localStorage.setItem("card", "901-902");
            localStorage.setItem("size", "M,L"); // tương ứng theo thứ tự id trong localStorage "card"
            localStorage.setItem("quantity", "1-1");
            localStorage.setItem("total_prices", "408200");

            const productsById = {
                901: {
                    id: 901,
                    name: "Áo thun mock 901",
                    description: "Áo thun basic mock",
                    prices: 199000,
                    discount: 20,
                    images: "customer/assets/images/product-image/1_1.jpg,customer/assets/images/product-image/1_2.jpg",
                    metadata: JSON.stringify({
                        size: ["S", "M", "L"],
                        color: ["#111111", "#2563eb"]
                    })
                },
                902: {
                    id: 902,
                    name: "Quần short mock 902",
                    description: "Quần short mock",
                    prices: 249000,
                    discount: 0,
                    images: "customer/assets/images/product-image/2_1.jpg,customer/assets/images/product-image/2_2.jpg",
                    metadata: JSON.stringify({
                        size: ["M", "L", "XL"],
                        color: ["#ef4444", "#22c55e"]
                    })
                }
            };

            Api.Product.GetOneItem = (id) => {
                return ok({ data: [productsById[id]] });
            };

            Api.Product.NewArrivals = () => {
                return ok({
                    data: [
                        productsById[901],
                        productsById[902],
                        {
                            id: 903,
                            name: "Áo khoác mock 903",
                            description: "Khoác gió mock",
                            prices: 399000,
                            discount: 15,
                            images: "customer/assets/images/product-image/3_1.jpg,customer/assets/images/product-image/3_2.jpg",
                            metadata: JSON.stringify({
                                size: ["M", "L"],
                                color: ["#0ea5e9", "#22c55e"]
                            })
                        }
                    ]
                });
            };
        })();
    </script>

    <script src="{{ asset('customer/assets/js/page/cart.js') }}"></script>

@endsection()