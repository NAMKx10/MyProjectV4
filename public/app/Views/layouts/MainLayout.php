<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    
    <!-- ✨ سيتم وضع عنوان كل صفحة هنا ديناميكيًا ✨ -->
    <title><?= $this->renderSection('title') ?> - نظام إدارة الأملاك</title>
    
    <!-- ملفات CSS (سنضع مسارات ملفات Tabler هنا لاحقًا) -->
    <link href="<?= base_url('assets/css/tabler.rtl.min.css') ?>" rel="stylesheet"/>

  </head>
  <body class="layout-fluid">
    <div class="page">
      
      <!-- الهيدر (يمكننا إضافته لاحقًا) -->
      <header class="navbar navbar-expand-md d-print-none">
          <div class="container-xl">
              <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href=".">
                  ديار ادارة الأملاك
                </a>
              </h1>
          </div>
      </header>

      <!-- القائمة العلوية (يمكننا إضافتها لاحقًا) -->
      <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar">
                <div class="container-xl">
                    <!-- محتوى القائمة سيأتي هنا -->
                </div>
            </div>
        </div>
      </div>
      
      <div class="page-wrapper">
        <div class="page-body">
          <div class="container-xl">
            <!-- ✨ سيتم وضع محتوى كل صفحة هنا ديناميكيًا ✨ -->
            <?= $this->renderSection('content') ?>
          </div>
        </div>
        
        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
             <p>الحقوق محفوظة © <?= date('Y') ?></p>
          </div>
        </footer>

      </div>
    </div>
    
    <!-- ملفات JS (سنضع مسارات ملفات Tabler هنا لاحقًا) -->
    <script src="<?= base_url('assets/js/tabler.min.js') ?>" defer></script>
    
  </body>
</html>