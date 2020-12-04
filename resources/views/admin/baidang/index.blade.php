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
        <a class="nav-link active">Danh sách bài đăng</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" href="#modalPost">Thêm bài đăng</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#No.</th>
            <th>Ngày đăng</th>
            <th>Người đăng</th>
            <th>Loại</th>
            <th>Tiêu đề</th>
            <th>Điểm</th>
            <th>Lượt xem</th>
            <th>Ẩn</th>
            <th>Tuỳ chọn</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>#No.</th>
            <th>Ngày đăng</th>
            <th>Người đăng</th>
            <th>Loại</th>
            <th>Tiêu đề</th>
            <th>Điểm</th>
            <th>Lượt xem</th>
            <th>Ẩn</th>
            <th>Tuỳ chọn</th>
          </tr>
        </tfoot>
        @php
          $i = 0;
        @endphp
        <tbody>
          @foreach($baiDangs as $baiDang)
          @php
              $i++;
          @endphp
          <tr>
            <td>{{ $i }}</td>
            <td>{{ $baiDang->created_at->diffForHumans(get_now()) }}</td>
            <td>{{ $baiDang->user->ten_hien_thi }}</td>
            <td>{{ $baiDang->loaiBaiDang->ten_loai }}</td>
            <td>{{ $baiDang->tieu_de }}</td>
            <td>{{ $baiDang->diem }}</td>
            <td>{{ $baiDang->luot_xem }}</td>
            <td>
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input js-an-bai-dang" id="post-{{ $baiDang->id }}"
                    value="{{ $baiDang->id }}" {{ $baiDang->trang_thai==1 ? 'checked' : '' }}>
                  <label class="custom-control-label" for="post-{{ $baiDang->id }}"></label>
              </div>
            </td>
            <td class="d-flex d-flex-column">
              <button class="btn btn-info btn-sm btn-circle mx-1 js-btn-capnhat-baidang" baidang-id="{{ $baiDang->id }}">
                <span class="far fa-edit"></span>
              </button>
              <button class="btn btn-danger btn-sm btn-circle mx-1 js-btn-xoa-baidang" data-id="{{ $baiDang->id }}"
                data-toggle="modal" data-target="#modal_delete">
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

@include('layouts.modal-post')

<!-- Modal update Post -->
<div class="modal fade" id="modalUpdatePost" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" aria-modal="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Cập nhật bài đăng</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form id="form-update-post" action="" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PATCH')
                  <div class="form-group">
                      <textarea type="Text" class="form-control{{ $errors->has('tieu_de1') ? ' is-invalid' : '' }}"
                          name="tieu_de1" placeholder="Tiêu đề" autocomplete="off" required></textarea>

                      @if ($errors->has('tieu_de1'))
                          <div class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('tieu_de1') }}</strong>
                          </div>
                      @endif
                  </div>
                  <div class="form-group">
                      <textarea class="form-control{{ $errors->has('noi_dung1') ? ' is-invalid' : '' }}"
                          name="noi_dung1" rows="5"></textarea>

                      @if ($errors->has('noi_dung1'))
                      <div class="invalid-feedback d-block" role="alert">
                          <strong>{{ $errors->first('noi_dung1') }}</strong>
                      </div>
                      @endif
                  </div>
                  <div class="row">
                      <div class="form-group col-4 mr-auto">
                          <input type="file" class="form-control-file form-control-sm py-1
                              {{ $errors->has('anh_poster1') ? 'is-invalid' : '' }}" name="anh_poster1">

                          @if ($errors->has('anh_poster1'))
                              <div class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('anh_poster1') }}</strong>
                              </div>
                          @endif
                      </div>
                      <div class="form-group col-4 mr-0">
                          <select class="form-control form-control-sm" name="loaibd_id1" required>
                              <option value="" selected>Chọn danh mục</option>
                              @foreach($loaiBaiDangs as $loaiBaiDang)
                              <option value="{{ $loaiBaiDang->id }}">{{ $loaiBaiDang->ten_loai }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>     
                  <button type="submit" class="btn btn-dark btn-block">Cập nhật</button>
              </form>
          </div>
      </div>
  </div>
</div>
<!-- End Modal update Post -->

@endsection

@section('script')
  <script>
    $(document).ready(function () {
      CKEDITOR.replace('noi_dung', {
        filebrowserBrowseUrl: 'tools/ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'tools/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        
        toolbar: [
        { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
        { name: 'styles', items: [ 'Styles', 'Format' ] },
        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
        { name: 'links', items: [ 'Link', 'Unlink' ] },
        { name: 'insert', items: [ 'Image' ] },
        { name: 'tools', items: [ 'Maximize' ] }
        ],

        extraPlugins: 'image2,uploadimage,uploadfile',

        removePlugins: 'image',
      });

      var ckeditorUpdate = CKEDITOR.replace('noi_dung1', {
        filebrowserBrowseUrl: 'tools/ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'tools/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        
        toolbar: [
        { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
        { name: 'styles', items: [ 'Styles', 'Format' ] },
        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
        { name: 'links', items: [ 'Link', 'Unlink' ] },
        { name: 'insert', items: [ 'Image' ] },
        { name: 'tools', items: [ 'Maximize' ] }
        ],

        extraPlugins: 'image2,uploadimage,uploadfile',

        removePlugins: 'image',
      });
      
      $('body').on('click', '.js-btn-capnhat-baidang', function (e) {
      e.preventDefault();
      var baiDangId = $(this).attr('baidang-id');
      
      $.ajax({
        type: "get",
        url: "admin/baidang/" + baiDangId + "/edit",
        dataType: "json",
        success: function (response) {          
          $('textarea[name=tieu_de1]').val(response.tieu_de);
          ckeditorUpdate.setData(response.noi_dung);
          $('select[name=loaibd_id1]').val(response.loaibd_id);
          $('#form-update-post').attr('action', 'admin/baidang/' + baiDangId);
          $('#modalUpdatePost').modal('show');
        }
      });
      });
      $( '#modalPost' ).modal( {
        focus: false,
        
        // Do not show modal when innitialized.
        show: false
      } );
      $( '#modalUpdatePost' ).modal( {
        focus: false,
        
        // Do not show modal when innitialized.
        show: false
      } );
    });
  </script>
@endsection