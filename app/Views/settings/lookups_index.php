<?php
echo $this->extend('layout/default');
echo $this->section('content');

// --- حساب الإحصائيات ---
$total_groups = count($grouped_options);
$total_options = 0;
foreach ($grouped_options as $group) {
    $total_options += count($group['options'] ?? []);
}
// --- جلب بيانات المجموعة النشطة لتسهيل الوصول إليها ---
$active_group_data = $grouped_options[$active_group_key] ?? null;
$active_group_options = $active_group_data['options'] ?? [];

?>

<!-- رأس الصفحة -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col"><h2 class="page-title"><?= esc($title) ?></h2></div>
        </div>
    </div>
</div>

<!-- جسم الصفحة -->
<div class="page-body">
    <div class="container-xl">

        <!-- صف الإحصائيات -->
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="card card-sm"><div class="card-body"><div class="row align-items-center">
                    <div class="col-auto"><span class="bg-primary text-white avatar"><i class="ti ti-layers-intersect"></i></span></div>
                    <div class="col"><div class="font-weight-medium"><?= $total_groups ?></div><div class="text-muted">مجموعة مدخلات</div></div>
                </div></div></div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card card-sm"><div class="card-body"><div class="row align-items-center">
                    <div class="col-auto"><span class="bg-info text-white avatar"><i class="ti ti-list-details"></i></span></div>
                    <div class="col"><div class="font-weight-medium"><?= $total_options ?></div><div class="text-muted">خيار معرف</div></div>
                </div></div></div>
            </div>
        </div>

        <!-- صف "اللوحة المزدوجة" -->
        <div class="row g-4">

            <!-- القسم الأيمن: قائمة المجموعات -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">المجموعات</h3>
                        <a href="<?= site_url('lookups/new-group') ?>" 
   class="btn btn-primary btn-icon" 
   title="إضافة مجموعة جديدة"
   data-bs-toggle="modal" 
   data-bs-target="#main-modal">
    <i class="ti ti-plus"></i>
</a>
                    </div>
                    <div class="card-body border-bottom py-2">
                        <input type="search" class="form-control" placeholder="بحث عن مجموعة...">
                    </div>
                    <div class="list-group list-group-flush" style="max-height: 500px; overflow-y: auto;">
                        <?php if (empty($grouped_options)): ?>
                            <div class="p-3 text-muted text-center">لا توجد مجموعات.</div>
                        <?php else: ?>
                                                        <?php foreach ($grouped_options as $group_key => $group_data): ?>
                                <?php
                                    $is_active = ($group_key === $active_group_key);
                                    $options_count = count($group_data['options'] ?? []);
                                ?>
                                <!-- الهيكل الجديد والبسيط لعنصر القائمة -->
                                <div class="list-group-item <?= $is_active ? 'active' : '' ?>">
                                    <div class="row align-items-center">
                                        <!-- الجزء الأيمن: الاسم ورابط التحديد -->
                                        <div class="col">
                                            <a href="<?= site_url('lookups?group=' . $group_key) ?>" class="text-reset text-decoration-none">
                                                <div class="text-body d-block"><?= esc($group_data['display_name'] ?? $group_key) ?></div>
                                                <div class="text-muted text-truncate mt-n1 small"><?= esc($group_key) ?></div>
                                            </a>
                                        </div>
                                        <!-- الجزء الأيسر: عدد الخيارات والأزرار -->
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center">
                                                <span class="badge bg-secondary-lt me-3"><?= $options_count ?></span>
                                                <div class="btn-group">
                                                    <a href="<?= site_url('lookups/edit-group/' . $group_key) ?>" class="btn btn-icon text-warning" title="تعديل المجموعة" data-bs-toggle="modal" data-bs-target="#main-modal">
                                                        <i class="ti ti-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-icon btn text-danger" title="حذف المجموعة">
                                                        <i class="ti ti-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- =================================================================== -->
            <!-- (مُحدّث) القسم الأيسر: جدول الخيارات                                -->
            <!-- =================================================================== -->
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">خيارات: "<?= esc($active_group_data['display_name'] ?? $active_group_key) ?>"</h3>
                        <div class="card-actions">
                            <a href="#" class="btn btn-primary"><i class="ti ti-plus me-2"></i>إضافة خيار</a>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover table-selectable">
                            <thead>
                                <tr>
                                    <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" title="تحديد الكل"></th>
                                    <th>القيمة (للعرض)</th>
                                    <th>المفتاح (البرمجي)</th>
                                    <th class="w-1">معاينة</th>
                                    <th class="w-1">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($active_group_options)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            هذه المجموعة لا تحتوي على خيارات بعد.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($active_group_options as $option): ?>
                                        <tr>
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox" value="<?= $option['id'] ?>"></td>
                                            <td><?= esc($option['option_value']) ?></td>
                                            <td><code><?= esc($option['option_key']) ?></code></td>
                                            <td>
                                                <span class="badge" style="background-color: <?= esc($option['bg_color'] ?? '#6c757d') ?>; color: <?= esc($option['color'] ?? '#ffffff') ?>">
                                                    <?= esc($option['option_value']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <a href="#" class="btn btn-secondary btn-icon" title="تعديل الخيار"><i class="ti ti-edit"></i></a>
                                                    <a href="#" class="btn btn-danger btn-icon" title="حذف الخيار"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-muted">عرض <span><?= count($active_group_options) ?></span> من <span><?= count($active_group_options) ?></span> مدخلات</p>
                        <!-- هنا يمكننا إضافة ترقيم الصفحات مستقبلاً -->
                    </div>
                </div>
            </div>

        </div> <!-- نهاية صف اللوحة المزدوجة -->

    </div>
</div>

<?php
echo $this->endSection();
?>