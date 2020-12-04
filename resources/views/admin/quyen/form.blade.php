<div class="modal-body">
    <div>@include('layouts.errors')</div>
    @csrf
    <div class="form-group">
        <label for="ten_quyen">Tên quyền</label>
        <input type="text" class="form-control" id="ten_quyen" name="ten_quyen"
            placeholder="Nhập tên quyền" required>
    </div>
</div>