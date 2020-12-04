<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href=""> 
        {{-- {{ route('home') }} --}}
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">LOGO</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Bảng điều khiển</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Đăng ký quảng cáo
    </div>

    <li class="nav-item">
    <a class="nav-link" href="{{ route('goidangky.index') }}">
        <i class="fas fa-box-open"></i>
        <span>Gói hợp tác</span></a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="{{ route('dangkyquangcao.index') }}">
        <i class="fas fa-handshake"></i>
        <span>Hợp tác </span><small class="badge badge-pill badge-light">{{ get_countDuyet() }}</small></a>
        
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý
    </div>

    <li class="nav-item">
    <a class="nav-link" href="{{ route('quyen.index') }}">
        <i class="fas fa-gavel"></i>
        <span>Quyền</span></a>
    </li>

    <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTaiKhoan" aria-expanded="true" aria-controls="collapseTaiKhoan">
        <i class="fas fa-user-friends"></i>
        <span>Tài khoản</span>
    </a>
    <div id="collapseTaiKhoan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Quản lý tài khoản</h6>
        <a class="collapse-item" href="{{ route('phanquyen.index') }}">Phân quyền</a>
        <a class="collapse-item" href="{{ route('taikhoan.index') }}">Tài khoản</a>
        </div>
    </div>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.phim.index') }}">
        <i class="fas fa-photo-video"></i>
        <span>Phim</span></a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="{{ route('baidang.index') }}">
        <i class="far fa-newspaper"></i>
        <span>Bài đăng</span></a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="{{ route('binhluan.index') }}">
        <i class="fas fa-comments"></i>
        <span>Bình luận</span></a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.danhgia.index') }}">
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
