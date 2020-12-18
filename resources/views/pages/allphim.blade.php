@extends('layouts.index')
@section('content')
<div class="container" style="margin-top: 5rem;">
    <h4 class="font-weight-normal">Tất cả phim</h4>
    <hr>
    <div class="form-inline my-3">
        <input type="text" class="form-control mr-2" placeholder="Tìm theo tên">
        <label for="theloai">Thể loại</label>
        <select class="form-control mx-2" name="theloai" id="theloai">
            <option selected>Chọn</option>
            @foreach ($theLoais as $theLoai)
            <option value="{{ $theLoai->id }}">{{ $theLoai->ten_the_loai }}</option>
            @endforeach
        </select>
    </div>
    <div id="all-phim">
        <div class="card-deck row">
            @foreach($allPhim as $phim)
            <div class="col-lg-2 col-md-4">
                <a class="text-decoration-none" href="{{ $phim->path() }}">
                    <div class="card border border-0 m-0">
                        <img class="card-img-top rounded-lg" src="upload/phim/{{ $phim->anh_poster }}">
                        <div class="card-body py-3 px-1">
                            <h6 class="card-title text-center text-muted">{{ $phim->ten_chinh }}</h6>
                        </div>
                    </div>
                </a>
            </div>        
            @endforeach
        </div>
    </div>
    <div class="col-md-12">
        <ul class="pagination justify-content-center" style="margin:10px 0">
            <li class="page-item">{!! $allPhim->links() !!}</li>
        </ul>
    </div>
</div>
@endsection