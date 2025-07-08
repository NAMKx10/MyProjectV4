<div class="modal-header">
    <h5 class="modal-title">تعديل المجموعة</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<form method="POST" action="<?= site_url('permissions/update-group') ?>">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= esc($group['id']) ?>">
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label required">اسم المجموعة</label>
            <input type="text" class="form-control" name="group_name" value="<?= esc($group['group_name']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label required">المفتاح البرمجي</label>
            <input type="text" class="form-control" name="group_key" value="<?= esc($group['group_key']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">ترتيب العرض</label>
            <input type="number" class="form-control" name="display_order" value="<?= esc($group['display_order']) ?>">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">إلغاء</button>
        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
    </div>
</form>