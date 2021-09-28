<?= $this->extend('siswa/layout') ?>

<?= $this->section('content') ?>

<div class="container">
  <div class="wrapper" style="background: #f5f5f5">
    
    <?php if(session()->getFlashdata('emailSalah')) { ?>
    <div class="alert alert-danger my-3">
      <?= session()->getFlashdata('emailSalah') ?>
    </div>
    <?php } ?>
    <div class="cek_email bg-white p-3 shadow" style="width: 90%; max-width: 500px; border-radius: 10px; margin-top: 40px">
      <form method="post" action="<?= base_url('cek_email') ?>">
        <?= csrf_field() ?>
        <p>Masukkan email yang anda gunakan ketika login</p>
        <div class="my-3 position-relative">
          <input type="email" name="email" class="form-control <?= $errors->hasError('email') ? 'is-invalid' : '' ?>" autocomplete="off" value="<?= old('email') ?>" required>
          <p class="invalid-feedback"><?= $errors->getError('email') ?></p>
        </div>
        <div class="mb-4 d-grid">
          <button type="submit" class="btn btn-success d-block">Cek Email</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>