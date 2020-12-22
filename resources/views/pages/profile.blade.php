@extends('layouts.index')
@section('content')
<div class="container" style="margin-top: 4.5rem; min-height: 550px">

    <div class="col-md-8 offset-md-2 bg-white rounded-lg shadow-sm mb-3">
        <nav class="nav nav-underline" id="myTab" role="tablist">
            <a class="nav-link text-dark active" id="taikhoan-tab" data-toggle="tab" href="#taikhoan" role="tab" aria-controls="taikhoan" aria-selected="true">Tài khoản</a>
            <a class="nav-link text-dark" id="baiviet-tab" data-toggle="tab" href="#baiviet" role="tab" aria-controls="baiviet" aria-selected="false">Bài viết</a>
            <a class="nav-link text-dark" id="danhgia-tab" data-toggle="tab" href="#danhgia" role="tab" aria-controls="danhgia" aria-selected="false">Đánh giá</a>
            <a class="nav-link text-dark" id="daluu-tab" data-toggle="tab" href="#daluu" role="tab" aria-controls="daluu" aria-selected="false">Đã lưu</a>
        </nav>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="taikhoan" role="tabpanel" aria-labelledby="taikhoan-tab">
            <div class="row col-md-8 offset-md-2">
                <div class="col-md-12">
                    @include('layouts.alert-custom')
                </div>
                <div class="col-md-4">                  
                    <form action="{{ route('ajax-upload-image') }}" id="form-upload-hinh" method="post" enctype="multipart/form-data">
						@csrf
                        <input type="image" src="upload/users/{{ $user->hinh_dai_dien }}" width="200px">
						<input type="file" class="d-none" name="hinh_dai_dien" id="upload-hinh" />
                    </form>
                    <div class="text-center">
                        <small class="font-weight-normal font-italic">Chọn ảnh để thay đổi ảnh</small>
                    </div>
                </div>
                <div class="col-md-8">
                    <form id="form-edit-profile" action="{{ route('register.update', ['register' => auth()->user()->id]) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="form-group row">
                            <label class="col-3 col-form-label" for="email">Email:</label>
                            <div class="col-9">
                                <input type="text" readonly class="form-control-plaintext" id="email" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label" for="tenhienthi">Tên hiển thị:</label>
                            <div class="col-9">
                                <input type="text" disabled="true" class="form-control" name="ten_hien_thi" id="tenhienthi" value="{{ $user->ten_hien_thi }}">
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-end">
                            <button type="button" class="btn btn-dark d-none mx-2 js-btn-huy">Huỷ</button>
                            <button type="submit" class="btn btn-success d-none js-btn-luu">Lưu</button>
                            <button type="button" class="btn btn-outline-info mx-2 js-btn-doimatkhau" data-toggle="modal"
                                data-target="#modal-doimatkhau">Đổi mật khẩu</button>
                            <button type="button" class="btn btn-outline-dark js-btn-edit-profile">Chỉnh sửa</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>

        <div class="tab-pane fade" id="baiviet" role="tabpanel" aria-labelledby="baiviet-tab">
        @if($baiDangs->count()>0)
        @foreach($baiDangs as $baiDang)
        <a class="text-decoration-none" href="{{ $baiDang->url() }}">
            <div class="card mb-3 col-12 col-md-8 offset-md-2 border-0 shadow">
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
                    <p class="card-text text-dark"><i class="fas fa-comment text-dark"></i> 0 bình luận &nbsp;<i class="far fa-eye text-info"></i> {{ $baiDang->luot_xem }} lượt xem &nbsp;<i class="fas fa-heart text-danger"></i> {{ $baiDang->diem }} lượt yêu thích</p>
                </div>
                </div>
            </div>
            </div>
        </a>
        @endforeach
        @else
            <p class="text-center">Chưa có bài đăng nào</p>
        @endif
        </div>

        <div class="tab-pane fade" id="danhgia" role="tabpanel" aria-labelledby="danhgia-tab">
        @if($danhGias->count() > 0)
        @foreach($danhGias as $danhGia)
        <a class="text-decoration-none text-dark" href="{{ $danhGia->phim->path() }}">
        <div class="media border-0 col-12 col-md-8 offset-md-2 p-2 my-2 rounded-lg shadow">
            <div class="media-body">
                <h5>{{ $danhGia->phim->ten_chinh }}</h5>
                <h6><span class="badge badge-dark"><i class="fas fa-star"></i> {{ $danhGia->diem }}</span>&nbsp;<small><i>{{ date_format($danhGia->created_at, 'd/m/Y') }}</i></small></h6>
                
                <p>{{ $danhGia->noi_dung }}</p>
            </div>
        </div>
        </a>
        @endforeach
        @else
            <p class="text-center">Chưa có đánh giá nào</p>
        @endif
        </div>
        <div class="tab-pane fade" id="daluu" role="tabpanel" aria-labelledby="daluu-tab">
            <div class="col-md-8 offset-md-2">
                Chưa lưu mục nào
            </div>      
        </div>
    </div>

</div>

@include('layouts.formdoimk')

@endsection