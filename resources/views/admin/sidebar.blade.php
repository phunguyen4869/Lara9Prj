        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
                <img src="" alt="Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                {{-- <span class="brand-text font-weight-light">{{ $name }}</span> --}}
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ $title }}</a>
                    </div>
                </div> --}}

                <!-- SidebarSearch Form -->
                {{-- <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column"
                        data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Danh m???c
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/categories/create') }}"
                                        class="nav-link">
                                        <i class="fas fa-plus"></i>
                                        <p>Th??m danh m???c</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/categories/list') }}"
                                        class="nav-link">
                                        <i class="fas fa-stream"></i>
                                        <p>Danh s??ch danh m???c</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-trailer"></i>
                                <p>
                                    Danh s??ch s???n ph???m
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/products/add') }}"
                                        class="nav-link">
                                        <i class="fas fa-plus"></i>
                                        <p>Th??m s???n ph???m</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/products/list') }}"
                                        class="nav-link">
                                        <i class="fas fa-stream"></i>
                                        <p>Danh s??ch s???n ph???m</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-images"></i>
                                <p>
                                    Slider
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/sliders/add') }}"
                                        class="nav-link">
                                        <i class="fas fa-plus"></i>
                                        <p>Th??m slider</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/sliders/list') }}"
                                        class="nav-link">
                                        <i class="fas fa-stream"></i>
                                        <p>Danh s??ch sliders</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-user"></i>
                                <p>
                                    Danh s??ch User
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/user/add') }}"
                                        class="nav-link">
                                        <i class="fas fa-plus"></i>
                                        <p>Th??m User</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('admin/user/list') }}"
                                        class="nav-link">
                                        <i class="fas fa-stream"></i>
                                        <p>Danh s??ch User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-lock"></i>
                                <p>
                                    Qu???n l?? Role
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/user/roles/add') }}"
                                        class="nav-link">
                                        <i class="fas fa-plus"></i>
                                        <p>Th??m Role</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('admin/user/roles/list') }}"
                                        class="nav-link">
                                        <i class="fas fa-stream"></i>
                                        <p>Danh s??ch Roles</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('admin/user/payment/list') }}"
                                class="nav-link">
                                <i class="far fa-credit-card"></i>
                                <p>
                                    Qu???n l?? Payment Method
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('admin/order/list') }}"
                                class="nav-link">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                                <p>
                                    Qu???n l?? ????n h??ng
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('admin/setting') }}"
                                class="nav-link">
                                <i class="fa-solid fa-gear"></i>
                                <p>
                                    C??i ?????t t??i kho???n
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('admin/order/export') }}"
                                class="nav-link">
                                <i class="fa-solid fa-file-export"></i>
                                <p>
                                    Xu???t Exel danh s??ch ????n h??ng
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
