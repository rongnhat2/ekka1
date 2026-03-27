@extends('customer.layout')
@section('title', 'Trang cá nhân')

@section('css')
@endsection()


@section('body')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Trang cá nhân</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="/">Trang chủ</a></li>
                                <li class="ec-breadcrumb-item active">Trang cá nhân</li>
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
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="I-profile">
                <div class="tab-control">
                    <a data-name="profile" class="tab-control-item"><i class="far fa-user m-r-10"></i>Thông tin</a>
                    <a data-name="order" class="tab-control-item"><i class="far fa-list-alt m-r-10"></i>Đơn mua</a>
                    <a data-name="password" class="tab-control-item"><i class="fas fa-key m-r-10"></i>Đổi mật khẩu</a>
                    <a href="#"><i class="fas fa-sign-out-alt m-r-10"></i>Đăng xuất</a>
                </div>
                <div class="tab-body">

                </div>
            </div>
        </div>
    </section>
@endsection()


@section('sub_layout')
    <script>
        window.EKKA_ENABLE_MOCK_HEADER = true;
    </script>
    <div class="I-modal modal-order" modal-block="Order">
        <div class="modal-wrapper">
            <div class="modal-dialog">
                <div class="dialog-content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã</th>
                                <th>Tên sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Giảm giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody class="data-full-list">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection()


@section('js')
    <script>
        // Mock data để `public/customer/assets/js/page/profile.js` render mà không gọi API thật.
        (() => {
            const ok = (payload) => $.Deferred().resolve(payload).promise();

            Api.Profile.GetProfile = () => {
                return ok({
                    data: [
                        {
                            name: "Nguyễn Văn A",
                            phone: "0901234567",
                            address: "Hai Bà Trưng, Hà Nội"
                        }
                    ]
                });
            };

            Api.Profile.GetOrder = () => {
                return ok({
                    data: [
                        {
                            id: 1001,
                            total: 408200,
                            created_at: "2026-03-10",
                            order_status: 3
                        },
                        {
                            id: 1002,
                            total: 129000,
                            created_at: "2026-03-01",
                            order_status: 1
                        }
                    ]
                });
            };

            Api.Profile.UpdateProfile = () => ok({ message: 200 });
            Api.Profile.UpdatePassword = () => ok({ message: 200 });

            Api.Order.GetOrder = () => {
                return ok({
                    data: [
                        {
                            product_id: 901,
                            name: "Áo thun mock 901",
                            price: 199000,
                            discount: 20,
                            quantity: 1,
                            total_price: 159200,
                            suborder_status: 0
                        },
                        {
                            product_id: 902,
                            name: "Quần short mock 902",
                            price: 249000,
                            discount: 0,
                            quantity: 1,
                            total_price: 249000,
                            suborder_status: 1
                        }
                    ]
                });
            };
        })();
    </script>

    <script src="{{ asset('customer/assets/js/page/profile.js') }}"></script>

@endsection()