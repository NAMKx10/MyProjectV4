<div class="modal-header">
    <h5 class="modal-title">إضافة فرع جديد</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form method="POST" action="<?= site_url('branches/create') ?>">
    <?= csrf_field() ?>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-8 mb-3">
                <label class="form-label required">اسم الفرع/الشركة</label>
                <input type="text" class="form-control" name="branch_name" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">كود الفرع</label>
                <input type="text" class="form-control" name="branch_code">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label required">نوع الكيان</label>
                <select name="entity_type_key" class="form-select">
                    <?php foreach($entity_types as $type): ?>
                        <option value="<?= $type['option_key'] ?>"><?= $type['option_value'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- (جديد) تمت إضافة قائمة منسدلة للحالة -->
            <div class="col-md-6 mb-3">
                <label class="form-label required">الحالة</label>
                <select name="status" class="form-select">
                    <?php foreach($statuses as $status): ?>
                        <option value="<?= $status['option_key'] ?>"><?= $status['option_value'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">رقم السجل التجاري</label>
                <input type="text" class="form-control" name="registration_number">
            </div>
             <div class="col-md-6 mb-3">
                <label class="form-label">الرقم الضريبي</label>
                <input type="text" class="form-control" name="tax_number">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">الجوال/الهاتف</label>
                <input type="tel" class="form-control" name="phone">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" class="form-control" name="email">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">العنوان</label>
            <textarea class="form-control" name="address" rows="2"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">ملاحظات</label>
            <textarea class="form-control" name="notes" rows="2"></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">إلغاء</button>
        <button type="submit" class="btn btn-primary">حفظ الفرع</button>
    </div>
</form>