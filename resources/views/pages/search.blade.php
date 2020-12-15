@extends('layouts.index')

@section('content')
<div class="container mb-4" style="margin-top: 5rem; min-height: 550px">
    <div class="col-md-8">
        <div class="mb-2">
            <i class="text-dark">Tìm thấy
                <strong class="font-italic">{{ get_demKetQuaSearch($phims, $baiDangs) }} kết quả</strong> phù hợp
            </i>
        </div>
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link text-dark active" id="phim-tab" data-toggle="tab" href="#phimTab" role="tab" aria-controls="phim" aria-selected="true">Phim</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" id="baidang-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="baidang" aria-selected="false">Bài đăng</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="phimTab" role="tabpanel" aria-labelledby="phim-tab">
            @forelse ($phims as $phim)
                <a class="text-decoration-none" href="{{ $phim->path() }}">
                    <div class="card mb-3 col-md-12 border-0">
                    <div class="row no-gutters">
                        <div class="col-md-1 col-2 my-auto ml-0">
                        <img src="upload/phim/{{ $phim->anh_poster }}" width="70px" class="rounded-lg">
                        </div>
                        <div class="col-md-11 col-10">
                        <div class="card-body my-auto">
                            <p class="card-text text-dark">{{ $phim->ten_chinh }} - {{ $phim->ten_phu }}</p>
                            <p class="card-text text-muted">Trạng thái: {{ get_trangThaiPhim($phim->trang_thai) }}</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </a>
                <hr>
            @empty
                <div class="text-center">Không có kết quả</div>
            @endforelse
            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="baidang-tab">
            @forelse ($baiDangs as $baiDang)
                <a class="text-decoration-none" href="{{ $baiDang->url() }}">
                    <div class="card mb-3 col-md-12 border-0">
                    <div class="row no-gutters">
                        <div class="col-4 my-auto ml-0">
                        <img src="upload/post/{{ $baiDang->anh_poster }}" class="card-img rounded-lg">
                        </div>
                        <div class="col-8">
                        <div class="card-body">
                            <h5 class="card-title text-dark">{{ $baiDang->tieu_de }}</h5>
                            <p class="card-text">
                                <small class="text-muted mr-2">{{ date_format($baiDang->created_at, 'd/m/Y') }}</small>
                                <span class="badge badge-secondary">{{ $baiDang->loaiBaiDang->ten_loai }}</span>
                            </p>
                            <p class="card-text text-dark"><i class="fas fa-comment text-dark"></i> 0 bình luận &nbsp;<i class="far fa-eye text-info"></i> {{ $baiDang->luot_xem }} lượt xem &nbsp;<i class="fas fa-heart text-danger"></i> {{ $baiDang->diem }} lượt yêu thích</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </a>
                <hr>
            @empty
                <div class="text-center">Không có kết quả</div>
            @endforelse
            </div>
        </div>
    </div>
</div>
@endsection