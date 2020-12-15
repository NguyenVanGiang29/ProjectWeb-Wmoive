@extends('layouts.index')
@section('content')
<section class="container" style="margin-top: 5rem">
    <!-- Hot -->
    <ul class="nav" >
        <li class="nav-item">
            <h4 class="font-weight-normal">Đang Hot</h4>
         
        </li>
        
        <li class="nav-item">
            <h6><a class="nav-link font-weight-normal text-dark" href="">Tất cả phim</a></h6>
            {{-- {{ route('all-movies') }} --}}
        </li>
    </ul>
    
    <hr class="bg-dark mt-n1">
    <div class="row responsive1">
        @foreach($phims as $phim)
        <div class="col-md-2 col-sm-6 col-6">
            <a class="text-decoration-none" href="">
                <div class="card border border-0 ">
                <img src="upload/phim/{{ $phim->anh_poster }}" class="card-img-top rounded-lg" alt="{{ $phim->ten_chinh }}">
                <div class="card-body py-3 px-1">
                    <h6 class="card-title text-muted text-center">{{ $phim->ten_chinh }}</h6>
                </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <!-- End Hot -->
</section>

<br>
<br>

<section class="container">
    <!-- News -->
    <h4 class="font-weight-normal">Tin tức</h4>
    <hr class="bg-dark">
    <div class="row">
        <div class="card-deck">
        @foreach($tinTucs as $tinTuc)
        <div class="col-md-4">
        <a class="text-decoration-none" href="">
                <div class="card mx-0 my-3 rounded-lg border-0 shadow-sm" style="min-height: 18rem">
                <img src="upload/post/{{ $tinTuc->anh_poster }}" class="card-img-top" style="height: 11rem" alt="">
                <div class="card-body py-1">
                    <p class="card-text text-dark">{{ $tinTuc->tieu_de }}</p>
                </div>
                <div class="card-footer border-top-0 bg-transparent">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="text-dark"> &nbsp;<i class="font-weight-light text-muted">{{ date_format($tinTuc->created_at, 'd/m/Y') }}</i></h6>
                        <small class="font-weight-nomarl text-dark">{{ get_demLuotThich($tinTuc->id) }} điểm</small>
                    </div>
                </div>
                </div>
            </a>
        </div>
        @endforeach
        </div>
        <div class="col-md-12 text-center">
            <a class="btn btn-outline-dark rounded-pill" role="button" href="">
                Xem thêm
            </a>
        </div>
    </div>
    <!-- End News -->
</section>

<br>
<br>

<section class="container my-3">
    <h4 class="font-weight-normal">Bài viết</h4>
    <hr class="bg-dark">
    <div class="row">
        <div class="card-deck">
            @foreach($baiViets as $baiViet)
            <div class="col-md-4">
                <a class="text-decoration-none" href="">
                    <div class="card mx-0 my-3 rounded-lg border-0 shadow-sm" style="min-height: 18rem">
                    <img src="upload/post/{{ $baiViet->anh_poster }}" class="card-img-top" style="height: 11rem" alt="{{ $baiViet->tieu_de }}">
                    <div class="card-body py-1">
                        <p class="card-text text-dark">{{ $baiViet->tieu_de }}</p>
                    </div>
                    <div class="card-footer border-top-0 bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-dark">&nbsp;<i class="font-weight-light text-muted">{{ date_format($baiViet->created_at, 'd/m/Y') }}</i></h6>
                            <small class="font-weight-nomarl text-dark">{{ get_demLuotThich($baiViet->id) }} điểm</small>
                        </div>
                    </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="col-md-12 text-center">
            <a class="btn btn-outline-dark rounded-pill" role="button" href="">
                Xem thêm
            </a>
        </div>
    </div>
</section>
@endsection