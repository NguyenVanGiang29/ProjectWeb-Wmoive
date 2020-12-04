$(document).ready(function () {
    //Selectpicker
    $('.selectpicker').selectpicker();
    //Datepicker
    $('#ngay_khoi_chieu').datepicker({
        format : 'yyyy/mm/dd',
        autoclose : true
    });

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
            $('input[name=trailer_yt_id1]').val(data.trailer_yt_id);
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
    //End Phim
    //Đánh giá hãng phim
    $('body').on('click', '.js-btn-xem-ngdanhgia', function (e) {
        e.preventDefault();
        var userId = $(this).attr('id-ngdanhgia');

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "hangphim/ajax/thongtinnguoidanhgia",
            data: { userId : userId },
            success: function (data) {
            $('#show-email').val(data.email);
            $('#show-ten').val(data.ten_hien_thi);
            $('#show-hinh').attr('src','upload/users/' + data.hinh_dai_dien);
            $('#modal-show-tt-ngdanhgia').modal('toggle');
            }
        });
    });

    $('body').on('click', '.js-btn-xoa-danh-gia-hp', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');

        $('#js-form-delele').attr('action', 'hangphim/danhgia/' + id);
    });
    //End Đánh giá hãng phim
});