<?= $this->extend('siswa/layout') ?>

<?= $this->section('content') ?>

<div class="container">
<div class="wrapper">
  <p><b><?= count($raport) ?></b> raport <b><?= $siswa ?></b></p>
  <div class="row">
    
  <?php foreach ($raport as $r) { ?>
  <div class="col-md-6 col-lg-4">
    <div class="card mt-3 me-3">
      <p class="card-title p-2 my-0"><b>Raport <?= $r['ujian']?></b></p>
      <p class="p-2 my-0">TP <?= $r['thn_pelajaran'] ?></p>
      <div class="card-footer">
        <a href="<?= base_url('admin/lihat_raport/'.$r['id']) ?>/download" class="btn btn-danger p-2">Download PDF</a>
      </div>
    </div>
  </div>
  <?php } ?>
  
  </div>
</div>
</div>

<?= $this->endSection() ?>