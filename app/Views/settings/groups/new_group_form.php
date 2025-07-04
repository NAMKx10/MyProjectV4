<div class="modal-header">
    <h5 class="modal-title">إضافة مجموعة جديدة</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<!-- عند إرسال هذا النموذج، سيتم استدعاء دالة "createGroup" في المتحكم -->
<form method="POST" action="<?= site_url('lookups/create-group') ?>">
    
    <!-- هذا الحقل ضروري لحماية النموذج من هجمات CSRF، وهو ميزة أمان في CodeIgniter -->
    <?= csrf_field() ?>

    <div class="modal-body">
        <div class="mb-3">
            <label for="option_value" class="form-label required">اسم المجموعة (للعرض)</label>
            <input type="text" class="form-control" name="option_value" id="option_value" placeholder="مثال: أنواع العقارات" required>
        </div>
        <div class="mb-3">
            <label for="group_key" class="form-label required">مفتاح المجموعة (انجليزي، بدون مسافات)</label>
            <input type="text" class="form-control" name="group_key" id="group_key" placeholder="مثال: property_types" required>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">إلغاء</button>
        <button type="submit" class="btn btn-primary">حفظ المجموعة</button>
    </div>
</form>