<?php
$uri = service('uri');
$segment1 = $uri->getSegment(1, 'dashboard');

$foundations_pages = ['branches', 'owners', 'properties', 'units', 'clients', 'suppliers'];
$operations_pages  = ['contracts', 'documents', 'maintenance'];
$financial_pages   = ['accounts', 'transactions', 'invoices', 'checks'];
$admin_pages       = ['users', 'roles', 'permissions', 'lookups', 'archive', 'settings'];

$is_foundations_active = in_array($segment1, $foundations_pages);
$is_operations_active  = in_array($segment1, $operations_pages);
$is_financial_active   = in_array($segment1, $financial_pages);
$is_admin_active       = in_array($segment1, $admin_pages);
?>


<ul class="navbar-nav">
  <!-- الرئيسية -->
  <li class="nav-item <?= ($segment1 === 'dashboard') ? 'active' : '' ?>">
    <a class="nav-link" href="<?= site_url('dashboard') ?>">
      <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-home"></i></span>
      <span class="nav-link-title">الرئيسية</span>
    </a>
  </li>

  <!-- قسم الأساسيات -->
  <li class="nav-item dropdown <?= $is_foundations_active ? 'active' : '' ?>">
    <a class="nav-link dropdown-toggle" href="#navbar-foundations" data-bs-toggle="dropdown" role="button" aria-expanded="<?= $is_foundations_active ? 'true' : 'false' ?>">
      <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-building-community"></i></span>
      <span class="nav-link-title">الأساسيات</span>
    </a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?= site_url('branches') ?>">الفروع</a>
      <a class="dropdown-item" href="<?= site_url('owners') ?>">الملاك</a>
      <a class="dropdown-item" href="<?= site_url('properties') ?>">العقارات</a>
      <a class="dropdown-item" href="<?= site_url('units') ?>">الوحدات</a>
      <a class="dropdown-item" href="<?= site_url('clients') ?>">العملاء</a>
      <a class="dropdown-item" href="<?= site_url('suppliers') ?>">الموردين</a>
    </div>
  </li>
  
  <!-- قسم العمليات -->
  <li class="nav-item dropdown <?= $is_operations_active ? 'active' : '' ?>">
    <a class="nav-link dropdown-toggle" href="#navbar-operations" data-bs-toggle="dropdown" role="button" aria-expanded="<?= $is_operations_active ? 'true' : 'false' ?>">
      <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-rotate-clockwise-2"></i></span>
      <span class="nav-link-title">العمليات</span>
    </a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?= site_url('contracts') ?>">العقود</a>
      <a class="dropdown-item" href="<?= site_url('documents') ?>">الوثائق</a>
      <a class="dropdown-item" href="<?= site_url('maintenance') ?>">الصيانة <span class="badge badge-sm bg-green-lt ms-auto">قريباً</span></a>
    </div>
  </li>

  <!-- قسم المركز المالي (مستقبلي) -->
  <li class="nav-item dropdown <?= $is_financial_active ? 'active' : '' ?>">
    <a class="nav-link dropdown-toggle" href="#navbar-financial" data-bs-toggle="dropdown" role="button" aria-expanded="<?= $is_financial_active ? 'true' : 'false' ?>">
      <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-cash"></i></span>
      <span class="nav-link-title">المركز المالي</span>
    </a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">الحسابات البنكية <span class="badge badge-sm bg-green-lt ms-auto">قريباً</span></a>
      <a class="dropdown-item" href="#">الحركات المالية <span class="badge badge-sm bg-green-lt ms-auto">قريباً</span></a>
      <a class="dropdown-item" href="#">الفواتير <span class="badge badge-sm bg-green-lt ms-auto">قريباً</span></a>
      <a class="dropdown-item" href="#">الشيكات <span class="badge badge-sm bg-green-lt ms-auto">قريباً</span></a>
    </div>
  </li>
  
  <!-- قسم الإدارة (مُحدّث) -->
  <li class="nav-item dropdown <?= $is_admin_active ? 'active' : '' ?>">
    <a class="nav-link dropdown-toggle" href="#navbar-admin" data-bs-toggle="dropdown" role="button" aria-expanded="<?= $is_admin_active ? 'true' : 'false' ?>">
      <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-settings"></i></span>
      <span class="nav-link-title">الإدارة</span>
    </a>
    <div class="dropdown-menu">
      <a class="dropdown-item <?= ($segment1 === 'users') ? 'active' : '' ?>" href="<?= site_url('users') ?>">المستخدمين</a>
      <a class="dropdown-item <?= ($segment1 === 'roles') ? 'active' : '' ?>" href="<?= site_url('roles') ?>">الأدوار</a>
      <a class="dropdown-item <?= ($segment1 === 'permissions') ? 'active' : '' ?>" href="<?= site_url('permissions') ?>">الصلاحيات</a>
      <a class="dropdown-item <?= ($segment1 === 'lookups') ? 'active' : '' ?>" href="<?= site_url('lookups') ?>">تهيئة المدخلات</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item <?= ($segment1 === 'archive') ? 'active' : '' ?>" href="<?= site_url('archive') ?>">الأرشيف</a>
      <a class="dropdown-item <?= ($segment1 === 'settings') ? 'active' : '' ?>" href="<?= site_url('settings') ?>">الإعدادات العامة</a>
    </div>
  </li>
</ul>