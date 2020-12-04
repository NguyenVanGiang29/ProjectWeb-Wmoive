@extends('admin.layouts.index')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

@include('layouts.alert-custom')

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active">Danh sách gói đăng ký</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" href="#modal-them-goidangky">Thêm gói đăng ký</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Tên gói</th>
            <th>Số lượng phim</th>
            <th>Tháng</th>
            <th>Created at</th>
            <th>Tuỳ chọn</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>#ID</th>
            <th>Tên gói</th>
            <th>Số lượng phim</th>
            <th>Tháng</th>
            <th>Created at</th>
            <th>Tuỳ chọn</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach($goiDangKys as $goiDangKy)
          <tr>
            <td>{{ $goiDangKy->id }}</td>
            <td>{{ $goiDangKy->ten_goi }}</td>
            <td>{{ $goiDangKy->so_luong_phim }}</td>
            <td>{{ $goiDangKy->thang }}</td>
            <td>{{ $goiDangKy->created_at }}</td>
            <td>
            <button class="btn btn-info btn-sm btn-circle js-btn-capnhat-goidk" 
                goidk-id="{{ $goiDangKy->id }}">
              <span class="far fa-edit"></span>
            </button>
            <button class="btn btn-danger btn-sm btn-circle js-btn-xoa-goidk" 
                data-id="{{ $goiDangKy->id }}" data-toggle="modal" data-target="#modal_delete">
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

<!-- Modal thêm quyền -->
<div class="modal fade" id="modal-them-goidangky" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm gói đăng ký</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('goidangky.store') }}" method="POST">
        @include('admin.goidangky.form')
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
          <button type="submit" class="btn btn-success">Thêm</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal cập nhật quyền -->
<div class="modal fade" id="modal-capnhat-goidk" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cập nhật gói đăng ký</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-capnhat-goidk" action=""  method="post" enctype="multipart/form-data">
          @method('PATCH')
          @include('admin.goidangky.form')
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
          <button type="submit" class="btn btn-success">Cập nhật</button>
        </div>
      </form>
    </div>
  </div>
</div>

@include('admin.layouts.modaldel')

@endsection