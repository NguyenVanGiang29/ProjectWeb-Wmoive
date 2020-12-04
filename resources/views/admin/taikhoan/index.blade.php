@extends('admin.layouts.index')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<div>@include('layouts.alert-custom')</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active">Danh sách tài khoản</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" href="#modal-them-taikhoan">Thêm tài khoản</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Email</th>
            <th>Tên hiển thị</th>
            <th>Hình đại diện</th>
            <th>Quyền</th>
            <th>Trạng thái</th>
            <th>Tuỳ chọn</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>#ID</th>
            <th>Email</th>
            <th>Tên hiển thị</th>
            <th>Hình đại diện</th>
            <th>Quyền</th>
            <th>Trạng thái</th>
            <th>Tuỳ chọn</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->ten_hien_thi }}</td>
            <td>
              <img class="rounded-circle" width="40px" src="upload/users/{{ $user->hinh_dai_dien }}">  
            </td>
            <td>{{ $user->quyen->ten_quyen }}</td>
            <td>{{ get_trangThaiUser($user->trang_thai) }}</td>
            <td class="d-flex d-flex-column">
            <button class="btn btn-info btn-sm btn-circle mx-1 js-btn-capnhat-taikhoan" user-id="{{ $user->id }}">
              <i class="far fa-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm btn-circle mx-1 js-btn-xoa-taikhoan" user-id="{{ $user->id }}"
                data-toggle="modal" data-target="#modal_delete"><i class="far fa-trash-alt"></i>
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

<!-- Modal thêm tài khoản -->
<div class="modal fade" id="modal-them-taikhoan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thêm tài khoản</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('taikhoan.store') }}" method="post" enctype="multipart/form-data">
      @include('admin.taikhoan.form')
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
        <button type="submit" class="btn btn-success">Thêm</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End modal thêm tài khoản -->

<!-- Modal cập nhật tài khoản -->
<div class="modal fade" id="modal-capnhat-taikhoan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cập nhật tài khoản</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-update-taikhoan" action="" method="POST" enctype="multipart/form-data">
      @method('PATCH')
      @include('admin.taikhoan.form')
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-info mr-auto" data-toggle="modal"
          data-target="#modal-doimatkhau" data-dismiss="modal">Đổi mật khẩu</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
        <button type="submit" class="btn btn-success">Cập nhật</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End modal cập nhật tài khoản -->

@include('layouts.formdoimk')

@endsection