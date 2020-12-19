<!-- Modal đổi mật khẩu tài khoản -->
<div class="modal fade" id="modal-doimatkhau" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Đổi mật khẩu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('changepassword') }}" method="POST">
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <label for="password">Mật khẩu cũ</label>
                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                 name="password" placeholder="Nhập mật khẩu cũ" required>

                @if ($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu mới</label>
                <input type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}"
                 name="new_password" placeholder="Nhập mật khẩu mới" required>
            </div>
            <div class="form-group">
                <label for="password">Xác nhận mật khẩu mới</label>
                <input type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}"
                 name="new_password_confirmation" placeholder="Xác nhận mật khẩu mới" required>
            </div>
            @if ($errors->has('new_password'))
            <div class="alert alert-danger">
                <strong>{{ $errors->first('new_password') }}</strong>
            </div>
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
            <button type="submit" class="btn btn-success">Cập nhật</button>
        </div>
        </form>
        </div>
    </div>
</div>
<!-- End modal đổi mật khẩu tài khoản -->