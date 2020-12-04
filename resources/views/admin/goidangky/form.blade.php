<div class="modal-body">
    @csrf
    <div>@include('layouts.errors')</div>
    <div class="form-group">
        <label for="tenGoi">Tên gói</label>
        <input type="text" class="form-control" id="tenGoi" name="ten_goi" 
            placeholder="Nhập tên gói" required>
    </div>
    <div class="form-group">
        <label for="soLuongPhim">Số lượng phim</label>
        <input type="number" class="form-control" id="soLuongPhim" name="so_luong_phim" 
            placeholder="Nhập số lượng phim" min="1" max="999" required>
    </div>
    <div class="form-group">
        <label for="thang">Tháng</label>
        <input type="number" class="form-control" id="thang" name="thang" 
            placeholder="Nhập tháng" min="1" max="12" required>
    </div>
</div>