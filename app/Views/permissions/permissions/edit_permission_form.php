<div class="modal-header">
    <h5 class="modal-title">تعديل الصلاحية</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<form method="POST" action="<?= site_url('permissions/update') ?>">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= esc($permission['id']) ?>">
    <input type="hidden" name="group_id" value="<?= esc($permission['group_id']) ?>">
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label required">الوصف</label>
            <input type="text" class="form-control" name="description" value="<?= esc($permission['description']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label required">المفتاح البرمجي</label>
            <input type="text" class="form-control" name="permission_key" value="<?= esc($permission['permission_key']) ?>" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">إلغاء</button>
        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
    </div>
</form>