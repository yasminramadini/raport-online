<?= $this->extend('siswa/layout') ?>

<?= $this->section('content') ?>

<div class="container">
  <div class="wrapper" style="background: #f5f5f5">
    
    <?php if(session()->getFlashdata('register')) { ?>
    <div class="alert alert-success my-3">
      <?= session()->getFlashdata('register') ?>
    </div>
    <?php } ?>
    
    <?php if(session()->getFlashdata('passwordSalah')) { ?>
    <div class="alert alert-danger my-3">
      <?= session()->getFlashdata('passwordSalah') ?>
    </div>
    <?php } ?>
    
    
    <?php if(session()->getFlashdata('usernameSalah')) { ?>
    <div class="alert alert-danger my-3">
      <?= session()->getFlashdata('usernameSalah') ?>
    </div>
    <?php } ?>
    <div class="login bg-white p-3 shadow" style="width: 90%; max-width: 500px; border-radius: 10px; margin-top: 40px">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-2">
          <img src="/logo/<?= $sekolah[0]['logo'] ?>" style="width: 80px;" class="d-block mx-auto">
        </div>
        <div class="col-md-10 text-center">
          <h4 class="d-inline-block"><b><?= $sekolah[0]['nama'] ?></b></h4>
        </div>
      </div>
      <form method="post" action="<?= base_url('store_login') ?>">
        <?= csrf_field() ?>
        <div class="my-3 position-relative">
          <input type="text" name="username" placeholder="Username atau email" class="form-control <?= $errors->hasError('username') ? 'is-invalid' : '' ?>" autocomplete="off" value="<?= old('username') ?>" required>
          <p class="invalid-feedback"><?= $errors->getError('username') ?></p>
        </div>
        <div class="mb-3 position-relative">
          <input type="password" name="password" class="form-control <?= $errors->hasError('password') ? 'is-invalid' : '' ?>" placeholder="Password" required>
          <p class="invalid-feedback"><?= $errors->getError('password') ?></p>
        </div>
        <div class="mb-4 d-grid">
          <button type="submit" class="btn btn-success d-block">Login</button>
        </div>
        <a style="none; color: #777;" class="text-center nav-link" href="<?= base_url('register') ?>">Belum punya akun?</a>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>