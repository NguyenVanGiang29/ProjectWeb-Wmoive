@extends('admin.layouts.index')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

@include('layouts.errors')

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active">Danh sách đánh giá</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Điểm</th>
            <th>Nội dung</th>
            <th>Phim</th>
            <th>Người</th>
            <th>Ngày</th>
            <th>Tuỳ chọn</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Điểm</th>
            <th>Nội dung</th>
            <th>Phim</th>
            <th>Người</th>
            <th>Ngày</th>
            <th>Tuỳ chọn</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach($danhGias as $danhGia)
          <tr>
            <td><i class="fas fa-star text-warning"></i> {{ $danhGia->diem }}</td>
            <td>{{ $danhGia->noi_dung }}</td>
            <td>{{ $danhGia->phim->ten_chinh }}</td>
            <td>           
              <button type="button" class="btn btn-success btn-circle btn-sm js-btn-xem-ngdanhgia"
                id-ngdanhgia="{{ $danhGia->user->id }}" >
                <span class="far fa-eye"></span>
              </button>
              {{ $danhGia->user->ten_hien_thi }}
            </td>
            <td>{{ $danhGia->created_at->diffForHumans(get_now()) }}</td>
            <td class="text-center">
            <button class="btn btn-danger btn-sm btn-circle js-btn-xoa-danhgia" data-id="{{ $danhGia->id }}" data-toggle="modal" data-target="#modal_delete">
              <span class="far fa-trash-alt"></span>
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

<!-- Modal thông tin người đáng giá -->
<div class="modal fade" id="modal-show-tt-ngdanhgia-1" tabindex="-1" role="dialog" aria-labelledby="showngdanhgia" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thông tin người đánh giá</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">

        <div class="row">

          <div class="col-4">
            <img id="show-hinh-1" src="" class="rounded-circle" width="150px">            
          </div>

          <div class="col-8">
            <div class="form-group row">
              <label class="col-5 col-form-label" for="show-email">Email:</label>
              <div class="col-7">
                <input type="text" readonly class="form-control-plaintext" id="show-email-1">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-5 col-form-label" for="show-ten">Tên hiển thị:</label>
              <div class="col-7">
                <input type="text" readonly class="form-control-plaintext" id="show-ten-1">
              </div>
            </div>
          </div>

        </div>        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<!-- End modal thông tin người đáng giá -->

@endsection