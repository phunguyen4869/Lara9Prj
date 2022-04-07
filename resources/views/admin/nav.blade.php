<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"
                role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-sm-inline-block">
            <a href="{{ url('admin') }}" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item d-sm-inline-block">
            <a href="{{ url('/') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#"
                role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form action="{{ route('search') }}" method="get" class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar"
                            name="search" type="search"
                            placeholder="Search Post" aria-label="Search">
                            <select name="section">
                                <option value="slider">Slider</option>
                                <option value="category">Category</option>
                                <option value="product">Product</option>
                                <option value="user">User</option>
                            </select>
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button"
                                data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('logout') }}"
                class="nav-link">Logout</a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
