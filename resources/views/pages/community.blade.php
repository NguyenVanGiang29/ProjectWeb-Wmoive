@extends('layouts.index')
@section('content')
<div class="container" style="margin-top: 4.5rem; min-height:400px">
    
    <div class="row">

        <div class="col-md-8">
            <div class="col-md-12 bg-white rounded-lg shadow-sm mb-3">
                <nav class="nav nav-underline" id="myTab" role="tablist">
                    <a class="nav-link text-dark active" id="tatca-tab" data-toggle="tab" href="#tatca" role="tab" aria-controls="tatca" aria-selected="true">Tất cả</a>
                    <a class="nav-link text-dark" id="phantich-tab" data-toggle="tab" href="#phantich" role="tab" aria-controls="phantich" aria-selected="false">Phân tích</a>
                    <a class="nav-link text-dark" id="hoidap-tab" data-toggle="tab" href="#hoidap" role="tab" aria-controls="hoidap" aria-selected="false">Hỏi đáp</a>
                    <a class="nav-link text-dark" id="chiase-tab" data-toggle="tab" href="#chiase" role="tab" aria-controls="chiase" aria-selected="false">Chia sẻ</a>
                    <a class="nav-link text-dark" id="tintuc-tab" data-toggle="tab" href="#tintuc" role="tab" aria-controls="tintuc" aria-selected="false">Tin tức</a>
                </nav>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tatca" role="tabpanel" aria-labelledby="tatca-tab">
                    @forelse ($baiDangs as $baiDang)
                        <a class="text-decoration-none" href="{{ $baiDang->url() }}">
                        <div class="card mb-3 col-md-12 border-0 bg-white shadow">
                        <div class="row no-gutters">
                            <div class="col-4 my-auto ml-0">
                            <img src="upload/post/{{ $baiDang->anh_poster }}" class="card-img">
                            </div>
                            <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $baiDang->tieu_de }}</h5>
                                <p class="card-text">
                                    <small class="text-muted mr-2">{{ date_format($baiDang->created_at, 'd/m/Y') }}</small>
                                    <span class="badge badge-secondary">{{ $baiDang->loaiBaiDang->ten_loai }}</span>
                                </p>
                                <p class="card-text text-dark"><i class="fas fa-comment text-dark"></i> 0 bình luận &nbsp;<i class="far fa-eye text-info"></i> {{ $baiDang->luot_xem }} lượt xem &nbsp;<i class="fas fa-heart text-danger"></i>{{ get_demLuotThich($baiDang->id) }} điểm</p>
                            </div>
                            </div>
                        </div>
                        </div>
                        </a>
                    @empty
                        <div class="text-center">Chưa có bài nào</div>
                    @endforelse
                </div>

                <div class="tab-pane fade" id="phantich" role="tabpanel" aria-labelledby="phantich-tab">
                    @forelse ($baiDangs->where('loaibd_id',2) as $baiDang)
                        <a class="text-decoration-none" href="{{ $baiDang->url() }}">
                        <div class="card mb-3 col-md-12 border-0 bg-white shadow">
                        <div class="row no-gutters">
                            <div class="col-4 my-auto ml-0">
                            <img src="upload/post/{{ $baiDang->anh_poster }}" class="card-img" style="height:130px">
                            </div>
                            <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $baiDang->tieu_de }}</h5>
                                <p class="card-text">
                                    <small class="text-muted mr-2">{{ date_format($baiDang->created_at, 'd/m/Y') }}</small>
                                    <span class="badge badge-secondary">{{ $baiDang->loaiBaiDang->ten_loai }}</span>
                                </p>
                                <p class="card-text text-dark"><i class="fas fa-comment text-dark"></i> 0 bình luận &nbsp;<i class="far fa-eye text-info"></i> {{ $baiDang->luot_xem }} lượt xem &nbsp;<i class="fas fa-heart text-danger"></i>{{ get_demLuotThich($baiDang->id) }} điểm</p>
                            </div>
                            </div>
                        </div>
                        </div>
                        </a>
                    @empty
                        <div class="text-center">Chưa có bài nào</div>
                    @endforelse
                </div>

                <div class="tab-pane fade" id="hoidap" role="tabpanel" aria-labelledby="hoidap-tab">
                    @forelse ($baiDangs->where('loaibd_id',3) as $baiDang)
                        <a class="text-decoration-none" href="{{ $baiDang->url() }}">
                        <div class="card mb-3 col-md-12 border-0 bg-white shadow">
                        <div class="row no-gutters">
                            <div class="col-4 my-auto ml-0">
                            <img src="upload/post/{{ $baiDang->anh_poster }}" class="card-img" style="height:130px">
                            </div>
                            <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $baiDang->tieu_de }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">{{ date_format($baiDang->created_at, 'd/m/Y') }}</small>
                                    <span class="badge badge-secondary">{{ $baiDang->loaiBaiDang->ten_loai }}</span>
                                </p>
                                <p class="card-text text-dark"><i class="fas fa-comment"></i> 0 bình luận &nbsp;<i class="far fa-eye"></i> {{ $baiDang->luot_xem }} lượt xem &nbsp;<i class="fas fa-heart"></i>{{ get_demLuotThich($baiDang->id) }} điểm</p>
                            </div>
                            </div>
                        </div>
                        </div>
                        </a>
                    @empty
                        <div class="text-center">Chưa có bài nào</div>
                    @endforelse
                </div>

                <div class="tab-pane fade" id="chiase" role="tabpanel" aria-labelledby="chiase-tab">
                    @forelse ($baiDangs->where('loaibd_id',4) as $baiDang)
                        <a class="text-decoration-none" href="{{ $baiDang->url() }}">
                        <div class="card mb-3 col-md-12 border-0 bg-white shadow">
                        <div class="row no-gutters">
                            <div class="col-4 my-auto ml-0">
                            <img src="upload/post/{{ $baiDang->anh_poster }}" class="card-img" style="height:130px">
                            </div>
                            <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $baiDang->tieu_de }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">{{ date_format($baiDang->created_at, 'd/m/Y') }}</small>
                                    <span class="badge badge-secondary">{{ $baiDang->loaiBaiDang->ten_loai }}</span>
                                </p>
                                <p class="card-text text-dark"><i class="fas fa-comment"></i> 0 bình luận &nbsp;<i class="far fa-eye"></i> {{ $baiDang->luot_xem }} lượt xem &nbsp;<i class="fas fa-heart"></i>{{ get_demLuotThich($baiDang->id) }} điểm</p>
                            </div>
                            </div>
                        </div>
                        </div>
                        </a>
                    @empty
                        <div class="text-center">Chưa có bài nào</div>
                    @endforelse
                </div>

                <div class="tab-pane fade" id="tintuc" role="tabpanel" aria-labelledby="tintuc-tab">
                    @forelse ($baiDangs->where('loaibd_id',1) as $baiDang)
                        <a class="text-decoration-none" href="{{ $baiDang->url() }}">
                        <div class="card mb-3 col-md-12 border-0 bg-white shadow">
                        <div class="row no-gutters">
                            <div class="col-4 my-auto ml-0">
                            <img src="upload/post/{{ $baiDang->anh_poster }}" class="card-img" style="height:130px">
                            </div>
                            <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $baiDang->tieu_de }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">{{ date_format($baiDang->created_at, 'd/m/Y') }}</small>
                                    <span class="badge badge-secondary">{{ $baiDang->loaiBaiDang->ten_loai }}</span>
                                </p>
                                <p class="card-text text-dark"><i class="fas fa-comment"></i> 0 bình luận &nbsp;<i class="far fa-eye"></i> {{ $baiDang->luot_xem }} lượt xem &nbsp;<i class="fas fa-heart"></i>lượt yêu thích</p>
                            </div>
                            </div>
                        </div>
                        </div>
                        </a>
                    @empty
                        <div class="text-center">Chưa có bài nào</div>
                    @endforelse
                </div>

            </div>
        </div>

        <div class="col-md-4 d-none d-sm-block mb-2">
            <div class="card border-0 rounded-lg shadow-sm">
            <div class="card-header text-center font-weight-normal">
            Bài đăng nổi bật
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($baiNoiBats as $baiNoiBat) 
                <li class="list-group-item">
                    <a class="card-link text-dark" href="{{ $baiNoiBat->url() }}">{{ $baiNoiBat->tieu_de }}</a>
                </li>
                @endforeach
            </ul>
            </div>
        </div>

    </div>
    
</div>
@endsection