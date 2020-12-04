<!-- Logout Modal-->
<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Bạn chắc chắn chứ?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <form id="js-form-delete" action="" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-body">Chọn "Xoá" để xác nhận xoá</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ</button>
                <button type="submit" class="btn btn-primary">Xoá</button>
            </div>
            </div>
        </form>
    </div>
</div>