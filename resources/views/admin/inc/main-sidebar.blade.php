<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/assets/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">LuxeLane</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item ">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('admin.admin-list') }}"
                        class="nav-link {{ Route::is('admin.admin-list') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-id-badge"></i>
                        <p>
                            Admin
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('admin.product') }}"
                        class="nav-link {{ Route::is('admin.product') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Product
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
