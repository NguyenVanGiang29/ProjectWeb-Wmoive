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