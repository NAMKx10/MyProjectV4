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

    <style> body { font-feature-settings: "cv03", "cv04", "cv11"; } </style>
  </head>
  
  <body class="layout-fluid">
    <div class="page">
      
      <header class="navbar navbar-expand-md d-print-none">
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
            <!-- (جديد) هذا القسم مسؤول عن عرض رسائل النجاح أو الخطأ -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- هذا هو المكان الذي سيتم فيه حقن محتوى كل صفحة -->
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
    
    <!-- (جديد) النافذة المنبثقة الرئيسية التي سيتم تحميل كل النماذج بداخلها -->
    <div class="modal modal-blur fade" id="main-modal" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <!-- سيتم حقن المحتوى هنا عبر JavaScript -->
        </div>
      </div>
    </div>

    <!-- =================================================================== -->
    <!-- ملفات JavaScript الأساسية                                         -->
    <!-- =================================================================== -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/NAMKx10/mytabler130@main/tabler-js/tabler.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.22.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
    <!-- (جديد) السكريبت المخصص لتشغيل النوافذ المنبثقة -->
    <script>
      $(document).ready(function() {
        // هذا الكود يستمع لأي عنصر يحتوي على data-bs-toggle="modal"
        // وعند الضغط عليه، يقوم بتحميل محتوى النافذة من الرابط الموجود في href
        $('#main-modal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var url = button.attr('href');
            var modal = $(this);
            // نعرض أيقونة تحميل مؤقتة
            modal.find('.modal-content').html('<div class="modal-body text-center p-4"><div class="spinner-border"></div></div>');
            // نقوم بتحميل المحتوى من الرابط
            modal.find('.modal-content').load(url, function(response, status, xhr) {
                if (status == "error") {
                    // في حالة حدوث خطأ، نعرض رسالة خطأ
                    $(this).html('<div class="modal-body"><div class="alert alert-danger">فشل تحميل المحتوى. يرجى المحاولة مرة أخرى.</div></div>');
                }
            });
        });

        // هذا الكود يقوم بإفراغ محتوى النافذة بعد إغلاقها للحفاظ على الأداء
        $('#main-modal').on('hidden.bs.modal', function(){
            $(this).find('.modal-content').html('');
        });
      });
    </script>

  </body>
</html>