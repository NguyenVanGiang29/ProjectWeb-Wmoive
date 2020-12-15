@extends('layouts.index')
@section('content')
<div class="container" style="margin-top: 6rem">
    <div class="row">
        <div class="col-md-2">
            <div class="my-sidebar">
            <ul class="my-sidebar-content nav d-flex flex-column" id="myScrollspy">
                {{-- <li class="nav-item mx-auto">
                    <span class="nav-link js-like text-{{ Auth::user()->thich()->where('baidang_id', $baiDang->id)->first()->thich==1 ? 'success' : 'dark' }}"
                     baidang-id="{{ $baiDang->id }}" style="cursor: pointer">
                        <i class="fas fa-plus"></i>
                    </span>
                </li> --}}
                <li class="nav-item mx-auto">
                    <span class="nav-link js-like text-dark"
                     baidang-id="{{ $baiDang->id }}" style="cursor: pointer">
                        <i class="fas fa-thumbs-up"></i>
                    </span>
                </li>
                <li class="nav-item mx-auto">
                    {{ get_demLuotThich($baiDang->id) }} điểm
                </li>
                {{-- <li class="nav-item mx-auto">
                    <span class="nav-link js-dislike text-{{ Auth::user()->thich()->where('baidang_id', $baiDang->id)->first()->thich==0 ? 'success' : 'dark' }}"
                     baidang-id="{{ $baiDang->id }}" style="cursor: pointer">
                        <i class="fas fa-minus"></i>
                    </span>
                </li> --}}
                <li class="nav-item mx-auto">
                    <span class="nav-link js-dislike text-dark"
                     baidang-id="{{ $baiDang->id }}" style="cursor: pointer">
                        <i class="fas fa-thumbs-down"></i>
                    </span>
                </li>
                <li class="nav-item mx-auto">
                    <a href="#section_binhluan" class="text-dark nav-link">
                        <i class="fas fa-comment"></i>
                    </a>
                </li>
            </ul>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card border-0">  
                <div class="card-body">
                    <h4 class="card-title">{{ $baiDang->tieu_de }}</h4>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <img class="rounded-circle" src="upload/users/{{ $baiDang->user()->first()->hinh_dai_dien }}" width="40px">
                        </li>
                        <li class="list-inline-item">
                            <p class="card-text">{{ $baiDang->user()->first()->ten_hien_thi }}</p>
                        </li>
                        <li class="list-inline-item">
                            <p class="card-text">{{ $baiDang->created_at }}</p>
                        </li>
                        <li class="list-inline-item">
                            <span class="badge badge-secondary">{{ $baiDang->loaiBaiDang()->first()->ten_loai }}</span>
                        </li>
                        <li class="list-inline-item">
                            <p class="card-text mx-2"><i class="far fa-eye"></i>&nbsp;{{ $baiDang->luot_xem }} lượt xem</p>
                        </li>
                    </ul>
                    <hr>
                    <img class="card-img-top" src="upload/post/{{ $baiDang->anh_poster }}">
                    <p class="card-text">{!! $baiDang->noi_dung !!}</p>
                </div>
            </div>

            <section id="section_binhluan" class="card border-0">                
                <div class="card-body">
                    @guest
                    <div class="text-center">
                        <p class="font-weight-bold">Vui lòng <a class="text-success" data-toggle="modal" href="#modalLogin">đăng nhập</a> để bình luận.</p>
                    </div>
                    @endguest
                    @auth
                    <h5 class="card-title">Bình luận</h5>
                    <hr>                    
                    <div class="form-group">
                        <textarea class="form-control js-noi-dung-bl" rows="3" placeholder="Viết bình luận của bạn..."></textarea>
                        <div class="d-flex">
                            <button class="btn btn-dark my-2 ml-auto js-btn-gui-bl" id-baidang="{{ $baiDang->id }}" type="submit">Gửi</button>
                        </div>
                    </div>
                    @endauth                    
                </div>
            </section>

            <div class="card border-0 py-0 mb-3">
                <div class="card-body">
                    <hr>
                    <div id="bangbinhluan"></div>
                </div>
            </div>
        </div>

        <div class="col-md-2"></div>
    </div>
</div>
@endsection
@section('script')
<script>
$(function () {
    $('#bangbinhluan').load('ajax/binhluan/{{ $baiDang->id }}');
});
</script>
@endsection