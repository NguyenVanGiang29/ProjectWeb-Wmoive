@forelse ($danhGias as $danhGia)
    <div class="media border-0 p-2 my-2 rounded-lg" id="danh_gia">
        <img src="upload/users/{{ $danhGia->user->hinh_dai_dien }}" class="mr-3 mt-3 rounded-circle" style="width:50px;">
        <div class="media-body">
            <h6>{{ $danhGia->user->ten_hien_thi }} <span class="badge badge-dark"><i class="fas fa-star"></i> {{ $danhGia->diem }}</span></h6>
            <small><i>{{ $danhGia->created_at->diffForHumans(get_now()) }}</i></small>
            <p>{{ $danhGia->noi_dung }}</p>
        </div>
        @can('view', $danhGia)
        <span class="text-success font-weight-bold p-2 my-auto js-btn-xoa-danhgia" id-danhgia="{{ $danhGia->id }}" id-phim="{{ $phim->id }}" style="cursor: pointer">
            Xoá
        </span>
        @endcan
    </div>
    <hr>
@empty
    <span class="font-weight-normal">Chưa có đánh giá nào</span>
@endforelse