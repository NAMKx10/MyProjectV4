<div class="modal-header">
    <h5 class="modal-title">إضافة مجموعة صلاحيات جديدة</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<form method="POST" action="<?= site_url('permissions/create-group') ?>">
    <?= csrf_field() ?>
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label required">اسم المجموعة</label>
            <input type="text" class="form-control" name="group_name" placeholder="مثال: إدارة العقود" required>
        </div>
        <div class="mb-3">
            <label class="form-label required">المفتاح البرمجي</label>
            <input type="text" class="form-control" name="group_key" placeholder="مثال: contracts_management" required>
        </div>
        <div class="mb-3">
            <label class="form-label">ترتيب العرض</label>
            <input type="number" class="form-control" name="display_order" value="0">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">إلغاء</button>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </div>
</form>