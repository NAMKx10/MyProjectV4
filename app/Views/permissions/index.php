<?php
echo $this->extend('layout/default');
echo $this->section('content');
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

        <!-- هذا هو الصف الخاص ببطاقات الإحصائيات -->
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="card card-sm"><div class="card-body"><div class="row align-items-center">
                    <div class="col-auto"><span class="bg-primary text-white avatar"><i class="ti ti-layers-intersect"></i></span></div>
                    <div class="col"><div class="font-weight-medium"><?= $total_groups ?></div><div class="text-muted">مجموعة صلاحيات</div></div>
                </div></div></div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card card-sm"><div class="card-body"><div class="row align-items-center">
                    <div class="col-auto"><span class="bg-info text-white avatar"><i class="ti ti-key"></i></span></div>
                    <div class="col"><div class="font-weight-medium"><?= $total_permissions ?></div><div class="text-muted">صلاحية معرفة</div></div>
                </div></div></div>
            </div>
        </div>

        <!-- هذا هو الصف الخاص باللوحة المزدوجة -->
        <div class="row g-4">

            <!-- القسم الأيمن: قائمة المجموعات -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">المجموعات</h3>
                        <a href="<?= site_url('permissions/new-group') ?>" class="btn btn-primary btn-icon" title="إضافة مجموعة جديدة" data-bs-toggle="modal" data-bs-target="#main-modal"><i class="ti ti-plus"></i></a>
                    </div>
                    <div class="card-body border-bottom py-2">
                        <input type="search" class="form-control" placeholder="بحث عن مجموعة...">
                    </div>
                    <div class="list-group list-group-flush" style="max-height: 500px; overflow-y: auto;">
                        <?php foreach ($groups as $group): ?>
                            <div class="list-group-item <?= ($group['id'] == $active_group_id) ? 'active' : '' ?>">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <a href="<?= site_url('permissions?group_id=' . $group['id']) ?>" class="text-reset text-decoration-none">
                                            <div class="text-body d-block"><?= esc($group['group_name']) ?></div>
                                            <div class="text-muted text-truncate mt-n1 small"><?= esc($group['group_key']) ?></div>
                                        </a>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-secondary-lt me-3"><?= $group['permissions_count'] ?></span>
                                            <div class="btn-group">
                                                <a href="<?= site_url('permissions/edit-group/' . $group['id']) ?>" class="btn btn-icon text-warning" title="تعديل المجموعة" data-bs-toggle="modal" data-bs-target="#main-modal"><i class="ti ti-edit"></i></a>
                                                <a href="<?= site_url('permissions/delete-group/' . $group['id']) ?>" class="btn btn-icon text-danger confirm-delete" title="حذف المجموعة" data-csrf-token="<?= csrf_hash() ?>"><i class="ti ti-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- القسم الأيسر: جدول الصلاحيات -->
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">صلاحيات: "<?= esc($active_group['group_name'] ?? 'اختر مجموعة') ?>"</h3>
                        <div class="card-actions">
                            <?php if ($active_group): ?>
                                <a href="<?= site_url('permissions/new/' . $active_group_id) ?>" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#main-modal"><i class="ti ti-plus me-2"></i>إضافة صلاحية</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter">
                            <thead><tr><th>الوصف</th><th>المفتاح البرمجي</th><th class="w-1">الإجراءات</th></tr></thead>
                            <tbody>
                                <?php if (empty($permissions)): ?>
                                    <tr><td colspan="3" class="text-center text-muted py-4">لا توجد صلاحيات في هذه المجموعة.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($permissions as $permission): ?>
                                        <tr>
                                            <td><?= esc($permission['description']) ?></td>
                                            <td><code><?= esc($permission['permission_key']) ?></code></td>
                                            <td><div class="btn-list flex-nowrap">
                                                <a href="<?= site_url('permissions/edit/' . $permission['id']) ?>" class="btn btn-icon text-warning" title="تعديل" data-bs-toggle="modal" data-bs-target="#main-modal"><i class="ti ti-edit"></i></a>
                                                <a href="<?= site_url('permissions/delete/' . $permission['id']) ?>" class="btn btn-icon text-danger confirm-delete" title="حذف" data-csrf-token="<?= csrf_hash() ?>"><i class="ti ti-trash"></i></a>
                                            </div></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>