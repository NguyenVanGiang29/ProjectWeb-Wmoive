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
        <a class="nav-link active">Phân quyền</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#thanhvien">Thành viên</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#admin">Quản trị viên</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#hangphim">Hãng phim</a>
    </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
    <div class="tab-pane container active p-3" id="thanhvien">
      <div class="table-responsive">
      <table class="table table-hover" id="dataTables_thanhvien">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Email</th>
            <th>Tên hiển thị</th>
            <th>Khoá</th>
          </tr>
        </thead>
          @foreach($users->where('quyen_id',3) as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->email }}</td> 
            <td>{{ $user->ten_hien_thi }}</td>
            <td>
            <form action="admin/taikhoan/{{ $user->id }}" method="POST">
            @csrf
              @if($user->trang_thai == 1)
                <button type="submit" class="btn btn-danger">Unlock</button>
              @else
                <button type="submit" class="btn btn-primary">Lock</button>
              @endif
            </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
    </div>

    <div class="tab-pane container fade p-3" id="admin">
      <div class="table-responsive">
      <table class="table table-hover" id="dataTables_admin">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Email</th>
            <th>Tên hiển thị</th>
            <th>Khoá</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users->where('quyen_id',1) as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->ten_hien_thi }}</td>
            <td>
              <form action="admin/taikhoan/{{ $user->id }}" method="POST">
                @csrf
                  @if($user->trang_thai == 1)
                    <button type="submit" class="btn btn-danger">Unlock</button>
                  @else
                    <button type="submit" class="btn btn-primary">Lock</button>
                  @endif
                </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
    </div>

    <div class="tab-pane container fade p-3" id="hangphim">
      <div class="table-responsive">
      <table class="table table-hover" id="dataTables_hangphim">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Email</th>
            <th>Tên hiển thị</th>
            <th>Khoá</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users->where('quyen_id',2)->where('trang_thai', '!=', 2) as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->ten_hien_thi }}</td>
            <td class="text-center">
              <form action="admin/taikhoan/{{ $user->id }}" method="POST">
                @csrf
                  @if($user->trang_thai == 1)
                    <button type="submit" class="btn btn-danger">Unlock</button>
                  @else
                    <button type="submit" class="btn btn-primary">Lock</button>
                  @endif
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
    </div>
    </div>

  </div>
</div>
<!-- .card -->
</div>


<!-- /.container-fluid -->
@endsection
@section('script')
<script>
$(function() {
  $('#dataTables_thanhvien').DataTable();
  $('#dataTables_admin').DataTable();
  $('#dataTables_hangphim').DataTable();
});
</script>
@endsection