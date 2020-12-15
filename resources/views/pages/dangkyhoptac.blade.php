@extends('layouts.index')
@section('content')
<div class="container d-flex flex-row p-2 flex-wrap" style="margin-top: 3.75rem">
  <div class="col-md-8 col-12 p-0 p-md-2">
    <div class="card mt-5 d-none d-sm-block">
      <div class="card-body p-0">
        <div class="responsive-slide">
          <div>
            <img class="rounded" src="image/slide/baner-1.jpeg" width="732px" height="400px">
          </div>
          <div>
            <img class="rounded" src="image/slide/baner-2.jpeg" width="732px" height="400px">
          </div>
          <div>
            <img class="rounded" src="image/slide/baner-3.jpeg" width="732px" height="400px">
          </div>
          <div>
            <img class="rounded" src="image/slide/baner-4.jpeg" width="732px" height="400px">
          </div>
          <div>
            <img class="rounded" src="image/slide/baner-5.jpeg" width="732px" height="400px">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 col-12 mt-md-0 mt-2 p-0 p-md-2">
    <div class="card border-0">
      <div class="card-header bg-white text-center">
        <h5>Đăng ký hợp tác</h5>
        <div>@include('layouts.errors')</div>
      </div>
      <div class="card-body p-0">
        <form action="{{ route('cooperate.store') }}" method="post" enctype="multipart/form-data" class="d-flex flex-column flex-nowrap p-2">
          @csrf
          <select class="form-control my-2" name="goi_dang_ky" aria-describedby="dkHelp">
            @foreach($goiDangKys as $goiDangKy)
            <option value="{{ $goiDangKy->id }}">{{ $goiDangKy->ten_goi }}</option>
            @endforeach
          </select>
          <small id="dkHelp" class="form-text text-muted">Bạn vui lòng chọn gói đăng ký hợp lý</small>
          <input type="text" name="ten_hien_thi" class="form-control my-2" placeholder="Tên hiển thị" required>
          <input type="email" name="email" class="form-control my-2" placeholder="youremail@movie.com" required>
          <input type="password" name="password" class="form-control my-2" placeholder="Mật khẩu" required>
          <input type="password" name="password_confirmation" class="form-control my-2" placeholder="Xác nhận mật khẩu" required>
          <label class="btn btn-primary btn-sm" for="hinhdaidien" style="cursor: pointer">
            Hình đại diện
          </label>
          <input type="file" id="hinhdaidien" name="hinh_dai_dien" class="d-none">
          <button type="submit" class="btn btn-dark">Đăng ký</button>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  $('.responsive-slide').slick({
    speed: 500,
    infinite: false,
    autoplay:true,
    autoplayspeed: 3000,
    fade: true,
    draggable: false,
    cssEase: 'linear'
  });
</script>
@endsection