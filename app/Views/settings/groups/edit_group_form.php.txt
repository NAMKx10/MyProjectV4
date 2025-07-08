<div class="modal-header">
    <h5 class="modal-title">تعديل المجموعة</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<!-- عند إرسال هذا النموذج، سيتم استدعاء دالة "updateGroup" في المتحكم -->
<form method="POST" action="<?= site_url('lookups/update-group') ?>">
    
    <?= csrf_field() ?>
    
    <!-- حقل مخفي للاحتفاظ بالمفتاح الأصلي للمجموعة -->
    <input type="hidden" name="original_group_key" value="<?= esc($group['group_key'] ?? '') ?>">

    <div class="modal-body">
        <div class="mb-3">
            <label for="option_value" class="form-label required">اسم المجموعة (للعرض)</label>
            <input type="text" class="form-control" name="option_value" id="option_value" value="<?= esc($group['option_value'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label for="group_key" class="form-label required">مفتاح المجموعة (انجليزي، بدون مسافات)</label>
            <input type="text" class="form-control" name="group_key" id="group_key" value="<?= esc($group['group_key'] ?? '') ?>" required>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">إلغاء</button>
        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
    </div>
</form>