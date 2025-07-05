<div class="modal-header">
    <h5 class="modal-title">إضافة صلاحية جديدة</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<form method="POST" action="<?= site_url('permissions/create') ?>">
    <?= csrf_field() ?>
    <input type="hidden" name="group_id" value="<?= esc($group_id) ?>">
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label required">الوصف (ماذا تفعل الصلاحية)</label>
            <input type="text" class="form-control" name="description" placeholder="مثال: القدرة على إضافة عقار جديد" required>
        </div>
        <div class="mb-3">
            <label class="form-label required">المفتاح البرمجي (انجليزي، فريد)</label>
            <input type="text" class="form-control" name="permission_key" placeholder="مثال: add_property" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">إلغاء</button>
        <button type="submit" class="btn btn-primary">حفظ الصلاحية</button>
    </div>
</form>