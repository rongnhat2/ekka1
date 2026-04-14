<div class="vertical-menu">
    <div data-simplebar class="h-100">

        <div class="navbar-brand-box">
            <a href="/" class="logo">
                <i class="mdi mdi-alpha-h-circle"></i>
                <span>
                    Ekka
                </span>
            </a>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Tổng quan</li>

                <li>
                    <a href="{{ route("admin.statistic") }}" class="waves-effect">
                        <i class="feather-activity"></i>
                        <span>Thống kê</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route("admin.order.index") }}" class=" waves-effect">
                        <i class="feather-truck"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route("admin.warehouse.index") }}" class=" waves-effect">
                        <i class="feather-home "></i>
                        <span>Kho</span>
                    </a>
                </li>
                <li class="menu-title">Quản lí sản phẩm</li>

                <li>
                    <a href="{{ route("admin.category.index") }}" class=" waves-effect">
                        <i class=" feather-list "></i>
                        <span>Danh mục</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route("admin.brand.index") }}" class=" waves-effect">
                        <i class=" feather-list "></i>
                        <span>Thương hiệu</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route("admin.color.index") }}" class=" waves-effect">
                        <i class=" feather-list "></i>
                        <span>Màu sắc</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route("admin.size.index") }}" class=" waves-effect">
                        <i class=" feather-list "></i>
                        <span>Kích thước</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route("admin.material.index") }}" class=" waves-effect">
                        <i class=" feather-list "></i>
                        <span>Chất liệu</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route("admin.product.index") }}" class=" waves-effect">
                        <i class=" feather-package "></i>
                        <span>Sản phẩm</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>