<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">LOGO</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
    <a class="nav-link" href="{{ route('filmstudio.dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Bảng điều khiển</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
    Quản lý
    </div>

    <li class="nav-item">
    <a class="nav-link" href="hangphim/goidangky">
        <i class="fas fa-box-open"></i>
        <span>Gói đăng ký</span></a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="{{ route('phim.index') }}">
        <i class="fas fa-photo-video"></i>
        <span>Phim</span></a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="{{ route('filmstudio.danhgia.index') }}">
        <i class="fas fa-star"></i>
        <span>Đánh giá</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
