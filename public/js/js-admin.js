$(document).ready(function () {
    //Bài đăng
    $('body').on('click', '.js-btn-xoa-baidang', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('#js-form-delete').attr('action','admin/baidang/' + id);
    });
  
    $('body').on('change', '.js-an-bai-dang', function (e) {
        e.preventDefault();
        var an = 0;
        var idBaiDang = $(this).val();
        var trangThai = $(this).prop('checked');

        if(trangThai)
          an = 1;
        else
          an = 0;
    
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: "post",
          url: "admin/ajax/anbaidang",
          data: { idBaiDang : idBaiDang, an : an }
        })
        .done(function(){
          console.log('Success');
        })
        .fail(function(){
          console.log('Error');
        });
    });
    //Bình luận
    $('body').on('click', '.js-btn-xem-ngbinhluan', function (e) {
        e.preventDefault();
        var userId = $(this).attr('id-ngbinhluan');
  
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: "post",
          url: "admin/ajax/thongtinnguoidanhgia",
          data: { userId : userId },
          success: function (data) {
            $('#show-email-bl').val(data.email);
            $('#show-ten-bl').val(data.ten_hien_thi);
            $('#show-hinh-bl').attr('src','upload/users/' + data.hinh_dai_dien);
            $('#modal-show-tt-binhluan').modal('toggle');
          }
        });
    });
  
    $('body').on('click', '.js-btn-xoa-binhluan', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('#js-form-delete').attr('action','admin/binhluan/'+id);
    });
    //Đánh giá
    $('body').on('click', '.js-btn-xem-ngdanhgia', function (e) {
        e.preventDefault();
        var userId = $(this).attr('id-ngdanhgia');
  
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: "post",
          url: "admin/ajax/thongtinnguoidanhgia",
          data: { userId : userId },
          success: function (data) {
            $('#show-email-1').val(data.email);
            $('#show-ten-1').val(data.ten_hien_thi);
            $('#show-hinh-1').attr('src','upload/users/' + data.hinh_dai_dien);
            $('#modal-show-tt-ngdanhgia-1').modal('toggle');
          }
        });
    });
  
    $('body').on('click', '.js-btn-xoa-danhgia', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('#js-form-delete').attr('action','admin/danhgia/'+id);
    });
    //Gói đăng ký
    $('body').on('click', '.js-btn-capnhat-goidk', function (e) {
        e.preventDefault();
        var goiDangKyId = $(this).attr('goidk-id');
  
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: "admin/goidangky/" + goiDangKyId + "/edit",
            dataType : "json",
            success: function (response) {
              console.log(response);
              
              $('form.form-capnhat-goidk').attr('action', "admin/goidangky/" + goiDangKyId);
              $('input[name=ten_goi]').val(response.ten_goi);
              $('input[name=so_luong_phim').val(response.so_luong_phim);
              $('input[name=thang]').val(response.thang);
              $('#modal-capnhat-goidk').modal('toggle');
            }
        });
    });
  
    $('body').on('click', '.js-btn-xoa-goidk', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('#js-form-delete').attr('action',"admin/goidangky/" + id);
    });
    //Duyệt đăng ký
    $('body').on('click', '.js-btn-duyet-dang-ky', function (e) {
        e.preventDefault();
        var id = $(this).attr('id-user');
        var duyet = 0;
  
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: "post",
          url: "admin/ajax/duyetdangky",
          data: { user_id : id, duyet : duyet }
        })
        .done(function(){
          console.log('Success');
        })
        .fail(function(){
          console.log('Error');
        });
        alert('Duyệt thành công');
        location.reload();
    });
  
    $('body').on('click','.js-btn-xoa-hoptac', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('#js-form-delete').attr('action','admin/taikhoan/'+id);
    });
    //Phim
    $('body').on('change', '.js-checkbox-update-status', function (e) {
        e.preventDefault();
        var status = 0;
        var phimId = $(this).val();

        if($(this).prop('checked'))
            status = 1;
        else
            status = 0;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "admin/ajax/status",
            data: { status : status, phimId : phimId },
        })
        .done(function(data) {
            console.log("success");
        })
        .fail(function() {
            console.log("error");
        });
    });

    $('body').on('click', '.js-btn-xoa-phim', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('#js-form-delete').attr('action', 'hangphim/phim/' + id);
    });
    //Quyền
    $('body').on('click', '.js-btn-capnhat-quyen', function (e) {
        e.preventDefault();
        var quyen = $(this).attr('quyen-id');
  
        $.ajax({
          type: "get",
          url: "admin/quyen/" + quyen + "/edit",
          dataType: "json",
          success: function (response) {
            $('input[name=ten_quyen]').val(response.ten_quyen);
            $('#form-capnhat-quyen').attr('action', 'admin/quyen/' + quyen);
            $('#modal-capnhat-quyen').modal('show');
          }
        });
      });
  
    $('body').on('click', '.js-btn-xoa-quyen', function (e) {
        e.preventDefault();
        var quyen = $(this).attr('data-id');
        $('#js-form-delete').attr('action','admin/quyen/' + quyen);
    });
    //Tài khoản
    $('body').on('click', '.js-btn-capnhat-taikhoan', function (e) {
        e.preventDefault();
        var userId = $(this).attr('user-id');
        $.ajax({
          type: "get",
          url: "admin/taikhoan/" + userId + "/edit",
          dataType: "json",
          success: function (response) {        
            $('#form-update-taikhoan').attr('action', 'admin/taikhoan/' + userId);    
            $('input[name=ten_hien_thi]').val(response.ten_hien_thi);
            $('input[name=email]').val(response.email);
            $('select[name=goidangky_id]').val(response.goidangky_id);
            $('select[name=quyen_id]').val(response.quyen_id);
            $('#modal-capnhat-taikhoan').modal('show');
          }
        });
    });
  
    $('body').on('click', '.js-btn-xoa-taikhoan', function (e) {
        e.preventDefault();
        var userId = $(this).attr('user-id');
        $('#js-form-delete').attr('action','admin/taikhoan/' + userId);
    });
    //Phân quyền
    // Khoá
    $('body').on('change', '.js-btn-lock-taikhoan', function (e) {
        e.preventDefault();
        var lock = 0;
        var userId = $(this).val();
        var check = $(this).prop('checked');

        if(check)
        lock = 1;
        else
        lock = 0;

        $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: "admin/ajax/lockuser",
        data: { userId : userId, lock : lock }
        })
        .done(function(data) {
        console.log("success");
        })
        .fail(function() {
        console.log("error");
        });   
    });

    //Phân quyền
    $('body').on('change', '.js-radio-phanquyen', function (e) {
        e.preventDefault();
        var userId = $(this).attr('user-id');
        var quyenId = $(this).val();
        
        if(quyenId==1)
        {
        var result = confirm('Bạn có muốn trao quyền admin cho người này?');
        if(result==true)
        {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
            url: 'admin/phanquyen',
            type: 'POST',
            data: { userId : userId, quyenId : quyenId },
            success: function(data)
            {
                console.log(data);
            }
            });
            alert('Phân quyền admin thành công!');
        }
        else
        {
            location.reload();
        }
        }
        else
        {
        var result = confirm('Bạn có chắc chắn?');
        if(result==true)
        {
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                url: 'admin/phanquyen',
                type: 'POST',
                data: { userId : userId, quyenId : quyenId },
                success: function(data)
                {
                console.log(data);
                }
            });
            alert('Phân quyền thành công!');
        }
        else
        {
            location.reload();
        }
        }
    });
});