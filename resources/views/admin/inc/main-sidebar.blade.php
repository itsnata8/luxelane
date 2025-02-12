<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/assets/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">LuxeLane</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/assets/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item ">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ Request::segment(2) === 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('admin.index') }}"
                        class="nav-link {{ Request::segment(2) === 'admin' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-id-badge"></i>
                        <p>
                            Admin
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('categories.index') }}"
                        class="nav-link {{ Request::segment(2) === 'categories' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('subcategories.index') }}"
                        class="nav-link {{ Request::segment(2) === 'subcategories' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Sub Category
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('brands.index') }}"
                        class="nav-link {{ Request::segment(2) === 'brands' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>
                            Brand
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('colors.index') }}"
                        class="nav-link {{ Request::segment(2) === 'colors' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-eye-dropper"></i>
                        <p>
                            Color
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('products.index') }}"
                        class="nav-link {{ Request::segment(2) === 'products' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Product
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('discount-codes.index') }}"
                        class="nav-link {{ Request::segment(2) === 'discount-codes' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-percent"></i>
                        <p>
                            Discount Coupon
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('shipping.index') }}"
                        class="nav-link {{ Request::segment(2) === 'shipping' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            Shipping
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link">
                        <i class=" fas fa-sign-out-alt nav-icon"></i>
                        <p>Log Out</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
