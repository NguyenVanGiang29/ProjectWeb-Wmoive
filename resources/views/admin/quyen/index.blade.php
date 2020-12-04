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
        <a class="nav-link active">Danh sách quyền</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" href="#modal-them-quyen">Thêm quyền</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Quyền</th>
            <th>Created at</th>
            <th>Update at</th>
            <th>Tuỳ chọn</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>#ID</th>
            <th>Quyền</th>
            <th>Created at</th>
            <th>Update at</th>
            <th>Tuỳ chọn</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach($quyens as $quyen)
          <tr>
            <td>{{ $quyen->id }}</td>
            <td>{{ $quyen->ten_quyen }}</td>
            <td>{{ $quyen->created_at }}</td>
            <td>{{ $quyen->updated_at }}</td>
            <td>
            <button class="btn btn-info btn-sm btn-circle js-btn-capnhat-quyen" quyen-id="{{ $quyen->id }}">
              <span class="far fa-edit"></span>
            </button>
            <button class="btn btn-danger btn-sm btn-circle js-btn-xoa-quyen" data-id="{{ $quyen->id }}"
              data-toggle="modal" data-target="#modal_delete"><span class="far fa-trash-alt"></span>
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
<div class="modal fade" id="modal-them-quyen" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thêm quyền</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('quyen.store') }}" method="post">
      @include('admin.quyen.form')
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
        <button type="submit" class="btn btn-success">Thêm</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End modal thêm quyền -->
<!-- Modal cập nhật quyền -->
<div class="modal fade" id="modal-capnhat-quyen" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cập nhật quyền</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-capnhat-quyen" action="" method="post">
        @method('PATCH')
        @include('admin.quyen.form')
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