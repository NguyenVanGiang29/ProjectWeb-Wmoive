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
        <a class="nav-link active">Danh sách bình luận</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#No.</th>
            <th>Nội dung</th>
            <th>Bài đăng</th>
            <th>Người bình luận</th>
            <th>Updated at</th>
            <th>Tuỳ chọn</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>#No.</th>
            <th>Nội dung</th>
            <th>Bài đăng</th>
            <th>Người bình luận</th>
            <th>Updated at</th>
            <th>Tuỳ chọn</th>
          </tr>
        </tfoot>
        @php
          $i = 0;
        @endphp
        <tbody>
          @foreach($binhLuans as $binhLuan)
          @php
              $i++;
          @endphp
          <tr>
            <td>{{ $i }}</td>
            <td>{{ $binhLuan->noi_dung }}</td>
            <td>{{ $binhLuan->baiDang->tieu_de }}</td>
            <td>
              <button type="button" class="btn btn-success btn-circle btn-sm js-btn-xem-ngbinhluan"
                id-ngbinhluan="{{ $binhLuan->user->id }}" >
                <span class="far fa-eye"></span>
              </button>
              {{ $binhLuan->user->ten_hien_thi }}
            </td>
            <td>{{ $binhLuan->updated_at->diffForHumans(get_now()) }}</td>
            <td class="text-center">
            <button class="btn btn-danger btn-sm btn-circle js-btn-xoa-binhluan" data-id="{{ $binhLuan->id }}" data-toggle="modal" data-target="#modal_delete">
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

<!-- Modal thông tin người bình luận -->
<div class="modal fade" id="modal-show-tt-binhluan" tabindex="-1" role="dialog" aria-labelledby="showngdanhgia" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thông tin người bình luận</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">

        <div class="row">

          <div class="col-4">
            <img id="show-hinh-bl" src="" class="rounded-circle" width="150px">            
          </div>

          <div class="col-8">
            <div class="form-group row">
              <label class="col-5 col-form-label" for="show-email">Email:</label>
              <div class="col-7">
                <input type="text" readonly class="form-control-plaintext" id="show-email-bl">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-5 col-form-label" for="show-ten">Tên hiển thị:</label>
              <div class="col-7">
                <input type="text" readonly class="form-control-plaintext" id="show-ten-bl">
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
<!-- End modal thông tin người bình luận -->

@endsection