$(document).ready(function () {
    //Js rating
    $(".p_rating").rating();
    //Scroll section
    $('#myScrollspy a.nav-link').click(function(e) {
    	e.preventDefault();
    	$('html, body').animate({ scrollTop: $($(this).attr("href")).offset().top -120 }, 500);
    });
    //Lên đầu trang
    $('[data-toggle="tooltip"]').tooltip();
    $("a[href='#page-top']").on("click", function(event) {
        event.preventDefault();
        var hash = this.hash;

        $("html, body").animate(
            {
                scrollTop: $(hash).offset().top
            },
            1000,
            function() {
                window.location.hash = hash;
            }
        );
    });

    //Gửi đánh giá
    $('body').on('click', '.btn_gui_danhgia', function (e) {
        e.preventDefault();
        var diem = $('.rating_diem').rating('rate');
        var noiDung = $('.rating_noidung').val();
        var idPhim = $(this).attr('id-phim');

        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: "post",
          url: "ajax/danhgia",
          data: { diem:diem, noi_dung:noiDung, phim_id:idPhim }
        })
        .done(function(data){
            console.log('Succsess');
            if(data.error==false){
                $('.js-text-thongbao').text('Đánh giá thành công!');
                $('.box-danh-gia').addClass('d-none');
                $('#bangdanhgia').load('ajax/danhgia/'+idPhim);
            }
        })
        .fail(function() {
            console.log("Error");
        });
    });

    //Gửi bình luận
    $('body').on('click', '.js-btn-gui-bl', function (e) {
        e.preventDefault(); 
        var noiDung = $('.js-noi-dung-bl').val();
        var idBaiDang = $(this).attr('id-baidang');

        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          type: "post",
          url: "ajax/binhluan",
          data: { noi_dung : noiDung, baidang_id : idBaiDang }
        })
        .done(function(data){
          console.log('Succsess');
          if(data.error==false){
            $('#bangbinhluan').load('ajax/binhluan/'+idBaiDang);
          }
        })
        .fail(function() {
          console.log("Error");
        });
    });
    //Xoá đánh giá
    $('body').on('click', '.js-btn-xoa-danhgia', function () {
        var phimId = $(this).attr('id-phim');
        var danhGiaId = $(this).attr('id-danhgia');
        
        $.get("ajax/danhgia/xoa/"+danhGiaId,
            function (data) {
                console.log(data);
                if(data.error == false)
                    $('#bangdanhgia').load('ajax/danhgia/'+phimId);
            }
        );
    });
    //Sửa Bình luận
    $('body').on('click', '.js-btn-sua-binhluan', function () {
        var id = $(this).attr('id-binhluan');
        var noiDung = $('.js-noidung-binhluan-'+id).text();
        $('.js-noidung-binhluan-'+id).addClass('d-none');
        $('.js-noidung-sua-binhluan-'+id).removeClass('d-none');
        $('.js-noidung-sua-binhluan-'+id).addClass('d-block');
        $('input[name=noi_dung_sua_binh_luan]').val(noiDung);
        $(this).addClass('d-none');
    });

    $('body').on('click', '.js-btn-huy-sua-binhluan', function () {
        var id = $(this).attr('id-binhluan');
        $('.js-noidung-binhluan-'+id).removeClass('d-none');
        $('.js-noidung-sua-binhluan-'+id).removeClass('d-block');
        $('.js-noidung-sua-binhluan-'+id).addClass('d-none');
        $('.js-btn-sua-binhluan').removeClass('d-none');
    });
    $('body').on('click', '.js-btn-capnhat-binhluan', function (e) {
        e.preventDefault();
        var binhLuanId = $(this).attr('id-binhluan');
        var baiDangId = $(this).attr('id-baidang');
        var noiDung = $('.nd-'+binhLuanId).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "ajax/binhluan/sua",
            data: {noi_dung : noiDung, id : binhLuanId},
            dataType: "json",
            success: function (response) {
                console.log(response);
                if(response.error == false)
                $('#bangbinhluan').load('ajax/binhluan/'+baiDangId);
            }
        });      
    });

    //Xoá bình luận
    $('body').on('click', '.js-btn-xoa-binhluan', function () {
        var baiDangId = $(this).attr('id-baidang');
        var binhLuanId = $(this).attr('id-binhluan');
        
        $.get("ajax/binhluan/xoa/"+binhLuanId,
            function (data) {
                console.log(data);
                if(data.error == false)
                $('#bangbinhluan').load('ajax/binhluan/'+baiDangId);
            }
        );
    });
    //Profile
    $('input[type=image]').click(function (e) { 
        e.preventDefault();

        $('#upload-hinh').click();
    });
    $('#upload-hinh').change(function (e) { 
        e.preventDefault();

        $('#form-upload-hinh').submit();
    });
    $('.js-btn-edit-profile').click(function (e) { 
        e.preventDefault();

        $(this).addClass('d-none');
        $('.js-btn-doimatkhau').addClass('d-none');
        $('.js-btn-huy').removeClass('d-none');
        $('.js-btn-luu').removeClass('d-none');
        $('#form-edit-profile input').attr('disabled', false);
    });
    $('.js-btn-huy').click(function (e) { 
        e.preventDefault();

        $(this).addClass('d-none');
        $('.js-btn-luu').addClass('d-none');
        $('.js-btn-edit-profile').removeClass('d-none');
        $('.js-btn-doimatkhau').removeClass('d-none');
        $('#form-edit-profile input').attr('disabled', true);
    });
    //End Profile

    //Phim
    // $('#box-anh-poster').load('ajax/phim/load-anh-poster/'+ );
    $('input[id=show-poster]').click(function (e) { 
        e.preventDefault();
        $('input[id=anh_poster1]').click();
    });
    $('input[id=show-cover]').click(function (e) { 
        e.preventDefault();
        $('input[id=anh_cover1]').click();
    });
    $('body').on('click', '.js-btn-update-phim', function (e) {
        e.preventDefault();
        var phimId = $(this).attr('id-phim');

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: "hangphim/phim/" + phimId + "/edit",
            dataType: "json",
            success: function (data) {
            console.log(data);
            
            $('#js-form-capnhat-phim').attr('action', 'hangphim/phim/' + phimId);
            $('#show-poster').attr('src', 'upload/phim/' + data.anh_poster);
            $('#show-cover').attr('src', 'upload/phim/' + data.anh_cover);
            $('input[name=ten_chinh1]').val(data.ten_chinh);
            $('input[name=ten_phu1]').val(data.ten_phu);
            $('input[name=thoi_luong1]').val(data.thoi_luong);
            $('input[name=dao_dien1]').val(data.dao_dien);
            $('input[name=dien_vien1]').val(data.dien_vien);
            $('input[name=imdb_id1]').val(data.imdb_id);
            $('input[name=link_trailer1]').val(data.link_trailer);
            $('input[name=ngay_khoi_chieu1]').val(data.ngay_khoi_chieu);
            $('select[name=trang_thai1]').val(data.trang_thai);
            $('select[name=dotuoi_id1]').val(data.dotuoi_id);
            $('textarea[name=noi_dung1]').val(data.noi_dung);
            $('#modal-capnhat-phim').modal('toggle');
            }
        });
    });

    $('#anh_poster1').change(function (e) { 
        e.preventDefault();
        var a = $('#form-change-anhposter').attr('src');
        alert(a);
        $('#form-change-anhposter').submit();
    });

    $('body').on('click', '.js-btn-xoa-phim', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('#js-form-delete').attr('action', 'hangphim/phim/' + id);
    });
    //Like
    $('.js-like').click(function (e) { 
        e.preventDefault();
        var baiDangId = $(this).attr('baidang-id');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "ajax/like",
            data: { baiDangId : baiDangId },
            success: function (response) {
                console.log(response);
            }
        });
    });
    $('.js-dislike').click(function (e) { 
        e.preventDefault();
        var baiDangId = $(this).attr('baidang-id');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "ajax/dislike",
            data: { baiDangId : baiDangId },
            success: function (response) {
                console.log(response);
            }
        });
    });
    //Cập nhật đánh giá
    $('body').on('click', '.js-btn-sua-danhgia', function (e) {
        e.preventDefault();
        $('.js-text-danhgia').text('Sửa đánh giá');
        $(this).removeClass('d-block');
        $(this).addClass('d-none');
        $('.box-capnhat-danhgia').removeClass('d-none');
        $('.box-capnhat-danhgia').addClass('d-block');
    });
    $('body').on('click', '.js-btn-huy-danhgia', function (e) {
        e.preventDefault();
        $('.js-text-danhgia').text('Bạn đã đánh giá');
        $('.box-capnhat-danhgia').removeClass('d-block');
        $('.box-capnhat-danhgia').addClass('d-none');
        $('.js-btn-sua-danhgia').removeClass('d-none')
        $('.js-btn-sua-danhgia').addClass('d-block')
    });
    $('body').on('click', '.js-btn-capnhat-danhgia', function (e) {
        e.preventDefault();
        $('.js-btn-huy-danhgia').click();
        var danhGiaId = $(this).attr('id-danhgia');
        var phimId = $(this).attr('id-phim');
        var diemCapNhat = $('.js-rating_capnhat_diem').val();
        var noiDungCapNhat = $('.js-rating_capnhat_noidung').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "ajax/danhgia/capnhat",
            data: { danhGiaId : danhGiaId, phimId : phimId, diemCapNhat : diemCapNhat, noiDungCapNhat : noiDungCapNhat },
            // dataType: "json",
            success: function (response) {
                console.log('Updated');
                if(response.error==false){
                    $('#bangdanhgia').load('ajax/danhgia/' + phimId);
                }
            }
        });
    });
});
    
