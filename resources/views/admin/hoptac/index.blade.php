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
        <a class="nav-link active">Danh sách gói đăng ký</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Email</th>
            <th>Tên hiển thị</th>
            <th>Hình đại diện</th>
            <th>Gói đăng ký</th>
            <th>Tuỳ chọn</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Email</th>
            <th>Tên hiển thị</th>
            <th>Hình đại diện</th>
            <th>Gói đăng ký</th>
            <th>Tuỳ chọn</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>{{ $user->email }}</td>
            <td>{{ $user->ten_hien_thi }}</td>
            <td class="text-center">
              <img class="rounded-circle" width="40px" src="upload/users/{{ $user->hinh_dai_dien }}">  
            </td>
            <td>{{ $user->goiDangKy()->first()->ten_goi }}</td>
            <td>
              <button class="btn btn-success btn-sm btn-circle js-btn-duyet-dang-ky" id-user="{{ $user->id }}">
                <i class="fas fa-check"></i>
              </button>
              <button class="btn btn-danger btn-sm btn-circle js-btn-xoa-hoptac" data-id="{{ $user->id }}" data-toggle="modal" data-target="#modal_delete">
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
@endsection