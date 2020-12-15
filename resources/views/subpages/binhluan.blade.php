@forelse ($binhLuans as $binhLuan)
    <div class="media border-0 p-2 my-2 rounded-lg" id="danh_gia">
        <img src="upload/users/{{ $binhLuan->user->hinh_dai_dien }}" class="mr-3 mt-3 rounded-circle" style="width:50px;">
        <div class="media-body">
            <h6>{{ $binhLuan->user->ten_hien_thi }}
                &nbsp;<small><i>{{ $binhLuan->created_at->diffForHumans(get_now()) }}</i></small>
            </h6>
            <p class="js-noidung-binhluan-{{ $binhLuan->id }}">{{ $binhLuan->noi_dung }}</p>
            <div class="js-noidung-sua-binhluan-{{ $binhLuan->id }} d-none">
                <div class="d-flex my-1">
                    <input class="form-control mr-2 nd-{{ $binhLuan->id }}" name="noi_dung_sua_binh_luan"
                         placeholder="Nhập nội dung...">
                    <button id-binhluan="{{ $binhLuan->id }}" id-baidang="{{ $baiDang->id }}"
                         class="btn btn-sm btn-success mr-1 js-btn-capnhat-binhluan">Lưu</button>
                    <button class="btn btn-sm btn-dark js-btn-huy-sua-binhluan"
                        id-binhluan={{ $binhLuan->id }}>Huỷ</button>
                </div>
            </div>
            {{-- <a class="text-success font-weight-bold mr-2" href="#">Trả lời</a> --}}
            @can('view', $binhLuan)
                <span class="text-success ml-2 js-btn-sua-binhluan" role="button" 
                id-binhluan={{ $binhLuan->id }} style="cursor:pointer">Sửa</span>
                <span class="text-success ml-2 js-btn-xoa-binhluan" role="button" 
                id-binhluan={{ $binhLuan->id }} id-baidang="{{ $baiDang->id }}" style="cursor:pointer">Xoá</span>
            @endcan            
        </div>
    </div>
    <hr>
@empty
    <span class="font-weight-normal">Chưa có bình luận nào</span>
@endforelse