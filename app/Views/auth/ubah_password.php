<?= $this->extend('siswa/layout') ?>

<?= $this->section('content') ?>

<div class="container">
  <div class="wrapper" style="background: #f5f5f5">
    
    <?php if(session()->getFlashdata('otp')) { ?>
    <div class="alert alert-success my-3">
      <?= session()->getFlashdata('otp') ?>
    </div>
    <?php } ?>
    
    <?php if(session()->getFlashdata('otpSalah')) { ?>
    <div class="alert alert-danger my-3">
      <?= session()->getFlashdata('otpSalah') ?>
    </div>
    <?php } ?>
    
    <div class="password bg-white p-3 shadow" style="width: 90%; max-width: 500px; border-radius: 10px; margin-top: 40px">
      <form method="post" action="<?= base_url('simpan_password') ?>">
        <?= csrf_field() ?>
        <div class="my-3">
          <label>Masukkan password baru anda</label>
          <input type="password" name="password" class="form-control <?= $errors->hasError('password') ? 'is-invalid' : '' ?>" autocomplete="off" required>
          <p class="invalid-feedback"><?= $errors->getError('password') ?></p>
        </div>
        <div class="my-3">
          <label>Masukkan ulang password anda</label>
          <input type="password" name="confirmPassword" class="form-control <?= $errors->hasError('confirmPassword') ? 'is-invalid' : '' ?>" required>
          <p class="invalid-feedback"><?= $errors->getError('confirmPassword') ?></p>
        </div>
        <div class="mb-4 d-grid">
          <button type="submit" class="btn btn-success d-block">Simpan Password</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>