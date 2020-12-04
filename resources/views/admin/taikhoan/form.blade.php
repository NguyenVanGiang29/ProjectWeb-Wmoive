<div class="modal-body">
    <div>@include('layouts.errors')</div>
    @csrf
    <div class="form-group">
        <label for="ten_hien_thi">Tên hiển thị</label>
        <input type="text" class="form-control" name="ten_hien_thi"
            placeholder="Nhập tên hiển thị" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email"
            placeholder="Nhập email" required>
    </div>
    <label for="password">
        Mật khẩu
        <small class="font-weight-bold text-info">(Mật khẩu mặc định: 123456)</small>
    </label>
    <div class="form-group">
        <label for="goidangky_id">Gói đăng ký</label>
        <select class="form-control form-control-sm" name="goidangky_id" aria-describedby="goidkHelp">
            <option value="" selected>Chọn gói đăng ký</option>
            @foreach ($goiDangKys as $goiDangKy)
                <option value="{{ $goiDangKy->id }}">{{ $goiDangKy->ten_goi }}</option>
            @endforeach
        </select>
        <small id="goidkHelp" class="form-text text-muted">Không chọn mục này nếu không phải hãng phim.</small>
    </div>
    <div class="form-row my-2">
        <div class="col-6">
            <label for="quyen_id">Quyền</label>
            <select class="form-control form-control-sm" name="quyen_id" required>
                <option value="" selected>Chọn quyền</option>
                @foreach ($quyens as $quyen)
                    <option value="{{ $quyen->id }}">{{ $quyen->ten_quyen }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="hinh_dai_dien">Hình đại diện</label>
                <input type="file" name="hinh_dai_dien">
            </div>
        </div>
    </div>
</div>