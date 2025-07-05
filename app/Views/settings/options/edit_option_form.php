<div class="modal-header">
    <h5 class="modal-title">تعديل الخيار: "<?= esc($option['option_value']) ?>"</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form method="POST" action="<?= site_url('lookups/update-option') ?>">
    <?= csrf_field() ?>
    
    <!-- حقول مخفية لإرسال البيانات الضرورية للمعالج -->
    <input type="hidden" name="id" value="<?= esc($option['id']) ?>">
    <input type="hidden" name="group_key" value="<?= esc($option['group_key']) ?>">

    <div class="modal-body">
        <div class="mb-3">
            <label for="option_value" class="form-label required">القيمة (للعرض)</label>
            <input type="text" class="form-control" name="option_value" id="option_value" value="<?= esc($option['option_value']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="option_key" class="form-label required">المفتاح (انجليزي، بدون مسافات)</label>
            <input type="text" class="form-control" name="option_key" id="option_key" value="<?= esc($option['option_key']) ?>" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="bg_color" class="form-label">لون الخلفية</label>
                <input type="color" class="form-control form-control-color" name="bg_color" id="bg_color" value="<?= esc($option['bg_color'] ?? '#6c757d') ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="color" class="form-label">لون النص</label>
                <input type="color" class="form-control form-control-color" name="color" id="color" value="<?= esc($option['color'] ?? '#ffffff') ?>">
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">إلغاء</button>
        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
    </div>
</form>