@extends('layouts.index')
@section('content')
<section class="container" style="margin-top: 4.5rem">
    <div class="row">
        <div class="col-md-12">
            <img class="w-100 shadow" src="upload/phim/{{ $phim->anh_cover }}" alt="{{ $phim->ten_chinh }}">
        </div>
    </div>
</section>
<section class="container">
    <div class="row" style="">
        <div class="col-md-3 col-3">
            <img class="w-100" src="upload/phim/{{ $phim->anh_poster }}" alt="{{ $phim->ten_chinh }}">
        </div>
        <div class="col-md-9 col-9">
            <div class="clearfix mb-n3">
                <div class="float-left">
                    <h4 >{{ $phim->ten_chinh }}</h4>
                    <h5 class="text-muted font-weight-normal">{{ $phim->ten_phu }}</h5>
                    <ul class="list-inline my-1">
                        <li class="list-inline-item">
                            <h4 class="badge badge-secondary">{{ $phim->doTuoi()->first()->ma }}</h4>
                        </li>
                        <li class="list-inline-item">
                            <h4 class="badge badge-secondary">{{ $phim->thoi_luong }}'</h4>
                        </li>
                        <li class="list-inline-item">
                            <span class="badge badge-warning imdbRatingPlugin" data-title="{{ $phim->imdb_id }}" data-style="p4">&nbsp;<img class="p-1" src="image/imdb.png" width="35px"></span>
                            <script>(function(d,s,id){var js,stags=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return;}js=d.createElement(s);js.id=id;js.src="https://ia.media-imdb.com/images/G/01/imdb/plugins/rating/js/rating.js";stags.parentNode.insertBefore(js,stags);})(document,"script","imdb-rating-api");</script>
                        </li>
                    </ul>
                    <h6 class="font-italic font-weight-normal">{{ get_theLoaiPhim($phim->id) }}</h6>
                </div>
                <div class="float-right">
                    <div class="js-dem-danh-gia">
                        <h5>Lượt đánh giá: {{ get_countDanhGia($phim->id) }}</h5>
                    </div>
                    <div class="js-diem-tb-danh-gia">
                        <h6>Điểm trung bình: {{ number_format(get_diemTrungBinh($phim->id), 1) }}</h6>
                    </div>
                </div>
            </div>
            <hr>
            <!-- Centered nav -->
            <ul class="nav justify-content-center font-weight-bold mt-n3" style ="background: rgb(179, 176, 176)">
                <li class="nav-item">
                    <a class="nav-link text-dark active" data-toggle="tab" href="#noidung">Nội dung</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#danhgia">Đánh giá</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#trailer">Trailer</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container active" id="noidung">
                    {{ $phim->noi_dung }}
                </div>
                <div class="tab-pane container" id="danhgia">
                    @guest
                        <p>Vui lòng <a class="text-success" data-toggle="modal" href="#modalLogin">đăng nhập</a> để đánh giá.</p>
                    @endguest
                    @auth
                    @if(is_daDanhGia($phim->id))
                    <div class="row">
                        <div class="col-md-4 text-center pt-3">
                            <div class="text-muted js-text-danhgia">Bạn đã đánh giá</div>
                            <input type="hidden" id=dg class="rating js-rating_capnhat_diem" data-start="0" data-stop="10" data-filled="fas fa-star fa-1x" data-empty="far fa-star fa-1x" value="{{ $danhGias->where('user_id', Auth::user()->id)->first()->diem }}" data-step="1">
                        </div>
                        <div class="col-md-8">
                            <div class="box-capnhat-danhgia d-none">
                                <input type="text" class="form-control js-rating_capnhat_noidung"
                                 placeholder="Viết nội dung" value="{{ $danhGias->where('user_id', Auth::user()->id)->first()->noi_dung }}">
                                <button class="btn btn-outline-dark my-2 js-btn-capnhat-danhgia" id-phim="{{ $phim->id }}" 
                                 id-danhgia="{{ $danhGias->where('user_id', Auth::user()->id)->first()->id }}">Sửa</button>
                                <button class="btn btn-dark my-2 js-btn-huy-danhgia">Huỷ</button>
                            </div>
                            <button class="btn btn-outline-dark my-2 d-block js-btn-sua-danhgia">Sửa đánh giá</button>
                        </div>
                    </div>
                    @else
                    <div class="col-12 text-center text-success font-weight-bold js-text-thongbao"></div>
                    <div class="box-danh-gia">
                        <div class="row">
                            <div class="col-md-4 text-center pt-3">
                                <input type="hidden" id=dg class="rating rating_diem" data-start="0" data-stop="10" data-filled="fas fa-star fa-1x" data-empty="far fa-star fa-1x" value="" data-step="1"/>
                            </div>
                            <div class="col-md-8">
                                <textarea class="form-control rating_noidung" placeholder="Viết nội dung"></textarea>
                                <button class="btn btn-outline-dark ml-auto my-2 btn_gui_danhgia" id-phim="{{ $phim->id }}">Gửi đánh giá</button>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endauth
                </div>
                <div class="tab-pane container fade" id="trailer">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $phim->trailer_yt_id }}" allowfullscreen="true"></iframe>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="container mt-2">
    <div class="row">
        <div class="col-md-3">
            <h5 class="font-weight-normal mb-2">Thông tin phim</h5>
            <hr>
            <h6 class="font-weight-normal"><strong>Rated:</strong> {{ $phim->doTuoi()->first()->ma }}</h6>
            <h6 class="font-weight-normal"><strong>Thể loại:</strong> {{ get_theLoaiPhim($phim->id) }}</h6>
            <h6 class="font-weight-normal"><strong>Đạo diễn:</strong> {{ $phim->dao_dien }}</h6>
            <h6 class="font-weight-normal"><strong>Diễn viên:</strong> {{ $phim->dien_vien }}</h6>
            <h6 class="font-weight-normal"><strong>Khơi chiếu:</strong> {{ $phim->ngay_khoi_chieu }}</h6>
            <h6 class="font-weight-normal"><strong>Thời lượng:</strong> {{ $phim->thoi_luong }} phút</h6>
        </div>

        <div class="col-md-9">
            <div class="clearfix mb-n2">
                <div class="float-left">
                    <h6 class="font-weight-normal">Đánh giá</h6>
                </div>
                <div class="float-right">
                    <select class="form-control btn btn-sm">
                        <option value="1">Mới nhất</option>
                        <option value="0">Cũ nhât</option>
                    </select>
                </div>
            </div>
            
            <hr class="bg-dark">

            <div id="bangdanhgia" >
                
            </div>

        </div>
    </div>
</section>
@endsection
@section('script')
<script>
$(function () {
    // $('.js-dem-danh-gia').load('dem-danh-gia');
    // $('.js-diem-tb-danh-gia').load('diem-tb-danh-gia');
    $('#bangdanhgia').load('ajax/danhgia/{{ $phim->id }}');
});
</script>
@endsection