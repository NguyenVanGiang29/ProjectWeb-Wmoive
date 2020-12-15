@extends('hangphim.layouts.index')

@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">

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
                            <a href="{{ route('filmstudio.danhgia.index') }}" class="text-decoration-none text-success float-right">Xem đánh giá</a>
                        </div>
                    </div>
                    <hr>
                    <ul class="nav justify-content-center mt-n3">
                        <li class="nav-item">
                            <a class="nav-link text-dark font-weight-bold active" data-toggle="tab" href="#thongtin">Thông tin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark font-weight-bold" data-toggle="tab" href="#noidung">Nội dung</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark font-weight-bold" data-toggle="tab" href="#trailer">Trailer</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane container active" id="thongtin">
                            <div class="font-weight-normal">
                                <h6><strong>Rated:</strong> {{ $phim->doTuoi()->first()->ma }}</h6>
                                <h6><strong>Thể loại:</strong> {{ get_theLoaiPhim($phim->id) }}</h6>
                                <h6><strong>Đạo diễn:</strong> {{ $phim->dao_dien }}</h6>
                                <h6><strong>Diễn viên:</strong> {{ $phim->dien_vien }}</h6>
                                <h6><strong>Khơi chiếu:</strong> {{ $phim->ngay_khoi_chieu }}</h6>
                                <h6><strong>Thời lượng:</strong> {{ $phim->thoi_luong }} phút</h6>
                            </div>
                        </div>
                        <div class="tab-pane container" id="noidung">
                            {{ $phim->noi_dung }}
                        </div>
                        <div class="tab-pane container fade" id="trailer">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $phim->trailer_yt_id }}" allowfullscreen="true"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-2 text-center">
                    <a href="{{ $phim->path() }}" class="text-decoration-none text-primary">Xem trên trang chủ</a>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection