<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?= esc($title ?? 'منصة Namk') ?></title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/gh/NAMKx10/mytabler130@main/tabler-css/tabler.rtl.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.22.2/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" rel="stylesheet" />

    <style> body { font-feature-settings: "cv03", "cv04", "cv11"; }
            .table-selectable tr:has(input.form-check-input:checked) {
            background-color: var(--tblr-primary-lt) !important;
            box-shadow: inset -3px 0 0 0 var(--tblr-primary) !important;
      }
    </style>
  </head>
  
  <body class="layout-fluid">
    <div class="page">
      
      <header class="navbar navbar-expand-md d-print-none">
        <!-- ... محتوى الهيدر يبقى كما هو ... -->
         <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="<?= site_url('/') ?>">
              <img src="https://preview.tabler.io/static/logo-white.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">
                <span class="avatar avatar-sm" style="background-image: url(https://preview.tabler.io/static/avatars/000m.jpg)"></span>
                <div class="d-none d-xl-block ps-2">
                  <div>اسم المستخدم</div>
                  <div class="mt-1 small text-muted">مدير النظام</div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="<?= site_url('logout') ?>" class="dropdown-item">تسجيل الخروج</a>
              </div>
            </div>
          </div>
        </div>
      </header>
      
      <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <?= $this->include('layout/navbar'); ?>
            </div>
          </div>
        </div>
      </div>

      <div class="page-wrapper">
        <div class="page-body">
          <div class="container-xl">
            <!-- عرض رسائل النجاح أو الخطأ -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <!-- حقن محتوى كل صفحة -->
            <?= $this->renderSection('content') ?>
          </div>
        </div>
        
        <footer class="footer footer-transparent d-print-none">
             <div class="container-xl">
                <div class="row text-center align-items-center flex-row-reverse">
                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                    <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">جميع الحقوق محفوظة © <?= date('Y') ?></li>
                    </ul>
                </div>
                </div>
            </div>
        </footer>
      </div>
    </div>
    
    <!-- النافذة المنبثقة الرئيسية -->
    <div class="modal modal-blur fade" id="main-modal" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content"></div>
      </div>
    </div>

    <!-- =================================================================== -->
    <!-- ملفات JavaScript الأساسية                                         -->
    <!-- =================================================================== -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/NAMKx10/mytabler130@main/tabler-js/tabler.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.22.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
    <!-- (مُصحّح) هنا نقوم بتضمين ملف السكربتات الخارجي الخاص بنا -->
    <?= $this->include('layout/scripts'); ?>

  </body>
</html>