@extends('hangphim.layouts.index')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

@include('hangphim.layouts.errors')

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active">Danh sách phim</a>
      </li>
      <li class="nav-item">

        @if (checkHanDangKy() >= 0)
          @if (get_demGoiDangKy() == 0)
          <li class="nav-item ml-auto">
            <span class="nav-link badge badge-danger font-weight-normal">Bạn không thể đăng phim vì đã đến giới hạn của gói bạn đăng ký</span>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link text-info" data-toggle="modal" href="#modal_themPhim">Thêm phim</a>
          </li>
          <li class="nav-item ml-auto">
            <span class="nav-link badge badge-warning font-weight-normal">Bạn có thể đăng thêm <strong>{{ get_demGoiDangKy() }}</strong> phim</span>
          </li>
          @endif
        @else
         <li class="nav-item ml-auto">
            <span class="nav-link badge badge-danger font-weight-normal">Hết hạn vui lòng liên hệ Admin</span>
          </li>
        @endif        
        
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Trạng thái</th>
            <th>Tuỳ chọn</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Trạng thái</th>
            <th>Tuỳ chọn</th>
          </tr>
        </tfoot>
        <tbody>
          @php
            $user_id = Auth::user()->id;
            $i = 0;
          @endphp
          @foreach($phims->where('user_id', $user_id) as $phim)
          <tr>
            @php
             $i++;
            @endphp
            <td>{{ $i }}</td>
            <td>{{ $phim->ten_chinh }} - {{ $phim->ten_phu }}</td>
            <td>{{ get_trangThaiPhim($phim->trang_thai) }}</td>
            <td class="d-flex d-flex-column">
            <a class="btn btn-success btn-sm btn-circle mx-1" href="{{ route('phim.show', $phim->id) }}">
              <i class="far fa-eye"></i>
            </a>
            <button class="btn btn-info btn-sm btn-circle mx-1 js-btn-update-phim" id-phim="{{ $phim->id }}">
              <i class="far fa-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm btn-circle mx-1 js-btn-xoa-phim" data-id="{{ $phim->id }}" data-toggle="modal" data-target="#modal_delete">
              <i class="far fa-trash-alt"></i>
            </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
<!-- Modal thêm phim -->
<div id="modal_themPhim" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm phim</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="them_phim" action="hangphim/phim" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">

            <div class="col-12">
            @include('hangphim.layouts.errors')
            </div>

            <div class="col-md-5 ml-auto mr-auto">
              <div class="form-group row">
                <label for="theLoai" class="col-form-label col-sm-3">Thể loại</label>
                <div class="col-sm-9">
                  <select id="selectmultiple" name="theLoai[]" class="selectpicker form-control" multiple data-live-search="true" required>
                    @foreach($theLoais as $theLoai)
                      <option value="{{ $theLoai->id }}">{{ $theLoai->ten_the_loai }}</option>
                    @endforeach
                  </select>
                </div>          
              </div>
              <div class="form-group row">
                <label for="tenChinh" class="col-form-label col-sm-3">Tên chính</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="tenChinh" name="ten_chinh" required>
                </div>          
              </div>
              <div class="form-group row">
                <label for="tenPhu" class="col-form-label col-sm-3">Tên phụ</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="tenPhu" name="ten_phu" value="{{ old('ten_phu') }}" required>
                </div>          
              </div>
              <div class="form-group row">
                <label for="thoiLuong" class="col-form-label col-sm-3">Thời lượng</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="thoiLuong" name="thoi_luong" min="1" max="400" value="{{ old('thoi_luong') }}" required>
                </div>          
              </div>
              <div class="form-group row">
                <label for="daoDien" class="col-form-label col-sm-3">Đạo diễn</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="daoDien" name="dao_dien" value="{{ old('dao_dien') }}" required>
                </div>          
              </div>
              <div class="form-group row">
                <label for="dienVien" class="col-form-label col-sm-3">Diễn viên</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="dienVien" name="dien_vien" value="{{ old('dien_vien') }}" required>
                </div>          
              </div>
              <div class="form-group row">
                <label for="imdbid" class="col-form-label col-sm-3">IMDB Id</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="imdbid" name="imdb_id" value="{{ old('imdb_id') }}" required>
                </div>          
              </div>
              <div class="form-group row">
                <label for="trailer" class="col-form-label col-sm-3">Trailer Youtube Id</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="trailer" name="trailer_yt_id" value="{{ old('trailer_yt_id') }}" required>
                </div>          
              </div>
            </div>

            <div class="col-md-5 mr-auto">
              <div class="form-group row">
                <label for="ngay_khoi_chieu" class="col-form-label col-sm-4">Ngày khởi chiếu</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" autocomplete="false" id="ngay_khoi_chieu" name="ngay_khoi_chieu" value="{{ old('ngay_khoi_chieu') }}" required>
                </div>      
              </div>
              <div class="form-group row">
                <label for="trangThai" class="col-form-label col-sm-4">Trạng thái</label>
                <div class="col-sm-8">
                  <select class="form-control" name="trang_thai" id="trangThai">
                    <option value="0" selected>Mặc định</option>
                    <option value="1">Đang hot</option>
                  </select>
                </div>          
              </div>
              <div class="form-group row">
                <label for="doTuoi" class="col-form-label col-sm-4">Độ tuổi</label>
                <div class="col-sm-8">
                  <select class="form-control" name="dotuoi_id" id="doTuoi">
                    @foreach($doTuois as $doTuoi)
                    <option value="{{ $doTuoi->id }}">{{ $doTuoi->ma }}</option>
                    @endforeach
                  </select>
                </div>          
              </div>
              <div class="form-group row">
                <label for="noiDung" class="col-form-label col-sm-4">Nội dung</label>
                <div class="col-sm-8">
                  <textarea type="text" class="form-control" id="noiDung" name="noi_dung" value="{{ old('noi_dung') }}" required></textarea>
                </div>          
              </div>
              <div class="form-group row">
                <label for="anh_poster" class="col-form-label col-sm-4">Ảnh poster</label>
                <div class="col-sm-8">
                  <input type="file" class="form-control-file" name="anh_poster" id="anh_poster">
                </div>          
              </div>
              <div class="form-group row">
                <label for="anh_cover" class="col-form-label col-sm-4">Ảnh Cover</label>
                <div class="col-sm-8">
                  <input type="file" class="form-control-file" name="anh_cover" id="anh_cover">
                </div>          
              </div>
            </div>
            
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
        <button type="submit" class="btn btn-primary">Thêm</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End modal thêm phim -->
<!-- Modal cập nhật phim -->
<div id="modal-capnhat-phim" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cập nhật phim</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="js-form-capnhat-phim" action="" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="modal-body">
          <div class="row">

            <div class="col-12">
            @include('hangphim.layouts.errors')
            </div>

            <div class="col-md-5 ml-auto mr-auto">
              <div class="form-group row">
                <label for="theLoai" class="col-form-label col-sm-3">Thể loại</label>
                <div class="col-sm-9">
                  <select id="selectmultiple" name="theLoai1[]" class="selectpicker form-control" multiple data-live-search="true">
                    @foreach($theLoais as $theLoai)
                      <option value="{{ $theLoai->id }}">{{ $theLoai->ten_the_loai }}</option>
                    @endforeach
                  </select>
                </div>          
              </div>
              <div class="form-group row">
                <label for="tenChinh" class="col-form-label col-sm-3">Tên chính</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="tenChinh" name="ten_chinh1" value="{{ old('ten_chinh') }}" required>
                </div>          
              </div>
              <div class="form-group row">
                <label for="tenPhu" class="col-form-label col-sm-3">Tên phụ</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="tenPhu" name="ten_phu1" value="{{ old('ten_phu') }}" required>
                </div>          
              </div>
              <div class="form-group row">
                <label for="thoiLuong" class="col-form-label col-sm-3">Thời lượng</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="thoiLuong" name="thoi_luong1" min="1" max="400" value="{{ old('thoi_luong') }}" required>
                </div>          
              </div>
              <div class="form-group row">
                <label for="daoDien" class="col-form-label col-sm-3">Đạo diễn</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="daoDien" name="dao_dien1" value="{{ old('dao_dien') }}" required>
                </div>          
              </div>
              <div class="form-group row">
                <label for="dienVien" class="col-form-label col-sm-3">Diễn viên</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="dienVien" name="dien_vien1" value="{{ old('dien_vien') }}" required>
                </div>          
              </div>
              <div class="form-group row">
                <label for="imdbid" class="col-form-label col-sm-3">IMDB Id</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="imdbid" name="imdb_id1" value="{{ old('imdb_id') }}" required>
                </div>          
              </div>
              <div class="form-group row">
                <label for="trailer1" class="col-form-label col-sm-3">Trailer Youtube Id</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="trailer1" name="trailer_yt_id1" value="{{ old('trailer_yt_id1') }}" required>
                </div>        
              </div>
            </div>

            <div class="col-md-5 mr-auto">
              <div class="form-group row">
                <label for="ngay_khoi_chieu" class="col-form-label col-sm-4">Ngày khởi chiếu</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" autocomplete="false" id="ngay_khoi_chieu" name="ngay_khoi_chieu1" value="{{ old('ngay_khoi_chieu') }}" required>
                </div>      
              </div>
              <div class="form-group row">
                <label for="trangThai" class="col-form-label col-sm-4">Trạng thái</label>
                <div class="col-sm-8">
                  <select class="form-control" name="trang_thai1" id="trangThai">
                    <option value="0" selected>Mặc định</option>
                    <option value="1">Đang hot</option>
                  </select>
                </div>          
              </div>
              <div class="form-group row">
                <label for="doTuoi" class="col-form-label col-sm-4">Độ tuổi</label>
                <div class="col-sm-8">
                  <select class="form-control" name="dotuoi_id1" id="doTuoi">
                    @foreach($doTuois as $doTuoi)
                    <option value="{{ $doTuoi->id }}">{{ $doTuoi->ma }}</option>
                    @endforeach
                  </select>
                </div>          
              </div>
              <div class="form-group row">
                <label for="noiDung" class="col-form-label col-sm-4">Nội dung</label>
                <div class="col-sm-8">
                  <textarea type="text" class="form-control" id="noiDung" name="noi_dung1" value="{{ old('noi_dung') }}" required></textarea>
                </div>          
              </div>

              <div class="form-group row">
                <div id="box-anh-poster" class="col-sm-6 text-center">
                  {{-- <form action="ajax/change-poster" id="form-change-anhposter" method="post" enctype="multipart/form-data"> --}}
                    <input id="show-poster" type="image" src="" width="100px">
                    <input type="file" class="d-none" name="anh_poster1" id="anh_poster1">
                  {{-- </form> --}}
                  <div>
                    <small class="font-italic">Ảnh poster</small>
                  </div>
                </div>  
                <div id="box-anh-cover" class="col-sm-6 text-center">
                  {{-- <form action="ajax/change-cover" id="form-change-anhcover" method="post" enctype="multipart/form-data"> --}}
                    <input id="show-cover" type="image" src="" width="200px">
                    <input type="file" class="d-none" name="anh_cover1" id="anh_cover1">
                  {{-- </form> --}}
                  <div>
                    <small class="font-italic">Ảnh cover</small>
                  </div>
                </div>
              </div>

            </div>
            
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
        <button type="submit" class="btn btn-primary js-capnhat-phim">Cập nhật</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End modal cập nhật phim -->

@endsection
