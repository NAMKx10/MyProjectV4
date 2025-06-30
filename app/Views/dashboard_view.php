<?= $this->extend('layouts/MainLayout') ?>

<?= $this->section('title') ?>
  لوحة التحكم
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <div class="page-header d-print-none">
    <div class="container-xl">
        <h2 class="page-title">
            لوحة التحكم الرئيسية
        </h2>
    </div>
  </div>

  <div class="page-body">
      <div class="container-xl">
          <p>أهلاً بك في نظام إدارة الأملاك (CodeIgniter) - الإصدار 4.0</p>
          <!-- هنا سنضع بطاقات الإحصائيات والجداول مستقبلاً -->
      </div>
  </div>
<?= $this->endSection() ?>