<?php echo $this->extend('layout/default'); ?>
<?php echo $this->section('content'); ?>

<!-- رأس الصفحة: العنوان وأزرار الإجراءات الرئيسية -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title"><?= esc($title) ?></h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="#" class="btn"><i class="ti ti-printer me-2"></i>طباعة</a>
                    <a href="<?= site_url('branches/new') ?>" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#main-modal">
                        <i class="ti ti-plus me-2"></i>فرع جديد
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- جسم الصفحة -->
<div class="page-body">
    <div class="container-xl">
        
        <!-- بطاقات الإحصائيات (مُصحّحة) -->
        <div class="row row-cards mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-primary-fg">
                    <div class="card-stamp"><div class="card-stamp-icon bg-white text-primary"><i class="ti ti-building-community"></i></div></div>
                    <div class="card-body">
                        <h3 class="card-title m-0">إجمالي الفروع</h3>
                        <p class="h1 mt-1 mb-0"><?= esc($stats['total'] ?? 0) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-success-fg">
                    <div class="card-stamp"><div class="card-stamp-icon bg-white text-success"><i class="ti ti-circle-check"></i></div></div>
                    <div class="card-body">
                        <h3 class="card-title m-0">الفروع النشطة</h3>
                        <p class="h1 mt-1 mb-0"><?= esc($stats['active'] ?? 0) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-info-fg">
                    <div class="card-stamp"><div class="card-stamp-icon bg-white text-info"><i class="ti ti-building-skyscraper"></i></div></div>
                    <div class="card-body">
                        <h3 class="card-title m-0">كيانات (منشأة)</h3>
                        <p class="h1 mt-1 mb-0"><?= esc($stats['companies'] ?? 0) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-warning-fg">
                    <div class="card-stamp"><div class="card-stamp-icon bg-white text-warning"><i class="ti ti-user-circle"></i></div></div>
                    <div class="card-body">
                        <h3 class="card-title m-0">كيانات (فرد)</h3>
                        <p class="h1 mt-1 mb-0"><?= esc($stats['individuals'] ?? 0) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- منطقة الفرز والبحث (تبقى كما هي) -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="<?= site_url('branches') ?>" method="get">
                    <div class="row g-3">
                        <div class="col-md-5"><input type="text" name="q" class="form-control" placeholder="ابحث بالاسم، الكود، السجل..." value="<?= esc(request()->getGet('q')) ?>"></div>
                        <div class="col-md-3">
                            <select name="type" class="form-select">
                                <option value="">كل الأنواع</option>
                                <?php foreach($entity_types as $type): ?>
                                <option value="<?= $type['option_key'] ?>" <?= (request()->getGet('type') == $type['option_key']) ? 'selected' : '' ?>><?= $type['option_value'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="status" class="form-select">
                                <option value="">كل الحالات</option>
                                <?php foreach($statuses as $status): ?>
                                <option value="<?= $status['option_key'] ?>" <?= (request()->getGet('status') == $status['option_key']) ? 'selected' : '' ?>><?= $status['option_value'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex">
                            <button type="submit" class="btn btn-primary w-100 me-2">بحث</button>
                            <a href="<?= site_url('branches') ?>" class="btn btn-outline-secondary" title="إلغاء الفرز"><i class="ti ti-refresh"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- جدول البيانات (يبقى كما هو) -->
        <div class="card">
            <div class="table-responsive">
                <table class="table card-table table-vcenter table-hover table-selectable">
                    <thead><tr>
                        <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" onclick="toggleAllCheckboxes(this)"></th>
                        <th class="w-1">#</th>
                        <th>الفرع/الشركة</th><th>البيانات الرئيسية</th><th>معلومات التواصل</th><th>نوع الكيان</th>
                        <th>الحالة</th><th>الأصول</th><th>الأطراف</th><th>العقود</th><th>ملاحظات</th><th class="w-1"></th>
                    </tr></thead>
                    <tbody>
                    <?php if (empty($branches)): ?>
                        <tr><td colspan="12" class="text-center">لا توجد فروع لعرضها.</td></tr>
                    <?php else: ?>
                        <?php foreach ($branches as $index => $branch): ?>
                        <tr>
                            <td><input class="form-check-input m-0 align-middle" type="checkbox" name="row_id[]" value="<?= $branch['id'] ?>"></td>
                            <td><span class="text-muted"><?= (($pager->getCurrentPage() - 1) * $pager->getPerPage()) + ($index + 1) ?></span></td>
                            <td><div><b><?= esc($branch['branch_name']) ?></b></div><div class="text-muted"><?= esc($branch['branch_code']) ?></div></td>
                            <td><div>السجل: <?= esc($branch['registration_number']) ?></div><div class="text-muted">الضريبي: <?= esc($branch['tax_number']) ?></div></td>
                            <td><div>الجوال: <?= esc($branch['phone']) ?></div><div class="text-muted">الإيميل: <?= esc($branch['email']) ?></div></td>
                            <td><?= esc($branch['entity_type_name']) ?></td>
                            <td><span class="badge" style="background-color: <?= esc($branch['bg_color']) ?>; color: <?= esc($branch['color']) ?>"><?= esc($branch['status_name']) ?></span></td>
                            <td><div>العقارات: <?= esc($branch['properties_count']) ?></div><div class="text-muted">الوحدات: <?= esc($branch['units_count']) ?></div></td>
                            <td><div>عملاء: <?= esc($branch['clients_count']) ?></div><div class="text-muted">موردين: <?= esc($branch['suppliers_count']) ?></div></td>
                            <td><div>إيجار: <?= esc($branch['rental_contracts_count']) ?></div><div class="text-muted">توريد: <?= esc($branch['supply_contracts_count']) ?></div></td>
                            <td><?php if(!empty($branch['notes'])): ?><span class="text-info" data-bs-toggle="tooltip" title="<?= esc($branch['notes']) ?>"><i class="ti ti-info-circle"></i></span><?php endif; ?></td>
                            <td><div class="btn-list flex-nowrap">
                                <a href="#" class="btn btn-icon" title="طباعة"><i class="ti ti-printer"></i></a>
                                <a href="<?= site_url('branches/edit/' . $branch['id']) ?>" class="btn btn-icon text-warning" title="تعديل" data-bs-toggle="modal" data-bs-target="#main-modal"><i class="ti ti-edit"></i></a>
                                <a href="<?= site_url('branches/delete/' . $branch['id']) ?>" class="btn btn-icon text-danger confirm-delete" title="حذف" data-csrf-token="<?= csrf_hash() ?>"><i class="ti ti-trash"></i></a>
                            </div></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-muted">عرض <span><?= count($branches) ?></span> من <span><?= $pager->getTotal() ?></span> مدخلات</p>
                <div class="ms-auto d-flex align-items-center">
                    <div class="me-3">
                        <select class="form-select form-select-sm" id="per-page-select">
                            <option value="5" <?= ($perPage == 5) ? 'selected' : '' ?>>5</option>
                            <option value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10</option>
                            <option value="25" <?= ($perPage == 25) ? 'selected' : '' ?>>25</option>
                            <option value="50" <?= ($perPage == 50) ? 'selected' : '' ?>>50</option>
                            <option value="100" <?= ($perPage == 100) ? 'selected' : '' ?>>100</option>
                        </select>
                    </div>
                    <?= $pager->links('default', 'tabler_full') ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>