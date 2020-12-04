<!-- Modal Post -->
<div class="modal fade" id="modalPost" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Đăng bài</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <textarea type="Text" class="form-control{{ $errors->has('tieu_de') ? ' is-invalid' : '' }}"
                            name="tieu_de" placeholder="Tiêu đề" autocomplete="off" required></textarea>

                        @if ($errors->has('tieu_de'))
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('tieu_de') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <textarea class="form-control{{ $errors->has('noi_dung') ? ' is-invalid' : '' }}"
                            name="noi_dung" rows="5" id="editor_noidung"></textarea>

                        @if ($errors->has('noi_dung'))
                        <div class="invalid-feedback d-block" role="alert">
                            <strong>{{ $errors->first('noi_dung') }}</strong>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="form-group col-4 mr-auto">
                            <input type="file" class="form-control-file form-control-sm py-1
                                {{ $errors->has('anh_poster') ? 'is-invalid' : '' }}" name="anh_poster">

                            @if ($errors->has('anh_poster'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('anh_poster') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-4 mr-0">
                            <select class="form-control form-control-sm" name="loaibd_id" required>
                                <option value="" selected>Chọn danh mục</option>
                                @can('is_admin')
                                    @foreach($loaiBaiDangs as $loaiBaiDang)
                                    <option value="{{ $loaiBaiDang->id }}">{{ $loaiBaiDang->ten_loai }}</option>
                                    @endforeach
                                @else
                                    @foreach($loaiBaiDangs->where('id','!=','1') as $loaiBaiDang)
                                        <option value="{{ $loaiBaiDang->id }}">{{ $loaiBaiDang->ten_loai }}</option>
                                    @endforeach
                                @endcan
                            </select>
                        </div>
                    </div>     
                    <button type="submit" class="btn btn-dark btn-block">Đăng bài</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Post -->