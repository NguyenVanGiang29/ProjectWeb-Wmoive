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
        <a class="nav-link active">Danh sách phim</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#No.</th>
            <th>Hãng</th>
            <th>Tên</th>
            <th>Lượt đánh giá</th>
            <th>Điểm trung bình</th>
            <th>Hot</th>
            <th>Tuỳ chọn</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>#No.</th>
            <th>Hãng</th>
            <th>Tên</th>
            <th>Lượt đánh giá</th>
            <th>Điểm trung bình</th>
            <th>Hot</th>
            <th>Tuỳ chọn</th>
          </tr>
        </tfoot>
        <tbody>
          @php
            $i = 0;
          @endphp
          @foreach($phims as $phim)
          <tr>
            @php
             $i++;
            @endphp
            <td>{{ $i }}</td>
            <td>{{ $phim->user->ten_hien_thi }}</td>
            <td>{{ $phim->ten_chinh }} - {{ $phim->ten_phu }}</td>
            <td>{{ get_countDanhGia($phim->id) }}</td>
            <td>{{ number_format(get_diemTrungBinh($phim->id), 1) }}</td>
            <td class="text-center">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input js-checkbox-update-status" id="phim-{{ $phim->id }}"
                        value="{{ $phim->id }}" {{ $phim->trang_thai==1 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="phim-{{ $phim->id }}"></label>
                </div>
            </td>
            <td class="d-flex d-flex-column">
            <a class="btn btn-success btn-sm btn-circle mx-1" href="{{ route('admin.phim.show', $phim->id) }}">
              <i class="far fa-eye"></i>
            </a>
            <button class="btn btn-danger btn-sm btn-circle mx-1 js-btn-xoa-phim" data-id="{{ $phim->id }}"
                 data-toggle="modal" data-target="#modal_delete">
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

@endsection
