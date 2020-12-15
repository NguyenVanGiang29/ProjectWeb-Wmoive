<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" class="form-control rounded-pill bg-light border-0 small" placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2">
        {{-- <div class="input-group-append">
        <button class="btn btn-success" type="button">
            <i class="fas fa-search fa-sm"></i>
        </button>
        </div> --}}
    </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-success" type="button">
                <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
            </div>
        </form>
        </div>
    </li>
    @if (checkHanDangKy() >= 0)
        <li class="nav-item d-none d-md-block mx-1">
            <small class="nav-link">
                Gói đăng ký <div class="badge badge-danger mx-1">{{ get_thangDangKy() }}</div> tháng.
                Sử dụng đến <div class="badge badge-danger mx-1">{{ get_demNgayDangKy() }}</div>
            </small>
        </li>

        <li class="nav-item mx-1">
            <span class="nav-link">
                <i class="fas fa-flag"></i>
                <span class="badge badge-info badge-counter">{{ get_goiDangKy() }}</span>
            </span>
        </li>

        <li class="nav-item mx-1">
            <span class="nav-link">
                <i class="fas fa-bell"></i>
                <span class="badge badge-danger badge-counter">{{ get_demGoiDangKy() }}</span>
            </span>
        </li>
    @else
        <li class="nav-item d-none d-md-block mx-1">
            <small class="nav-link">
                <div class="badge badge-danger mx-1">Gói đăng ký hết hạn</div>
            </small>
        </li>
    @endif

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    @auth
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->ten_hien_thi }}</span>
        <img class="img-profile rounded-circle" src="upload/users/{{ Auth::user()->hinh_dai_dien }}">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Cài đặt
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Đăng xuất
        </a>
        </div>
    </li>
    @endauth

    </ul>

</nav>