<?= $this->extend('siswa/layout') ?>

<?= $this->section('content') ?>

<div class="container">
  <div class="wrapper" style="background: #f5f5f5">
    <div class="login bg-white p-3" style="width: 90%; max-width: 500px; border-radius: 10px; margin-top: 40px">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-2">
          <img src="/logo/<?= $sekolah[0]['logo'] ?>" style="width: 80px;" class="d-block mx-auto">
        </div>
        <div class="col-md-10 text-center">
          <h4 class="d-inline-block"><b><?= $sekolah[0]['nama'] ?></b></h4>
        </div>
      </div>
      <form method="post" action="<?= base_url('auth/store_register') ?>">
        <?= csrf_field() ?>
        <div class="my-3 position-relative">
          <input type="email" name="email" placeholder="Email" class="form-control <?= $errors->hasError('email') ? 'is-invalid' : '' ?>" autocomplete="off" value="<?= old('email') ?>" required>
          <p class="invalid-feedback"><?= $errors->getError('email') ?></p>
        </div>
        <div class="my-3 position-relative">
          <input type="text" name="username" placeholder="Username" class="form-control <?= $errors->hasError('username') ? 'is-invalid' : '' ?>" autocomplete="off" value="<?= old('username') ?>" required>
          <p class="invalid-feedback"><?= $errors->getError('username') ?></p>
        </div>
        <div class="mb-3 position-relative">
          <input type="password" name="password" class="form-control <?= $errors->hasError('password') ? 'is-invalid' : '' ?>" placeholder="Password" required>
          <p class="invalid-feedback"><?= $errors->getError('password') ?></p>
        </div>
        <div class="mb-3 position-relative">
          <input type="password" class="form-control <?= $errors->hasError('confirmPassword') ? 'is-invalid' : '' ?>" name="confirmPassword" placeholder="Konfirmasi password" required>
          <p class="invalid-feedback"><?= $errors->getError('confirmPassword') ?></p>
        </div>
        <div class="mb-4 d-grid">
          <button type="submit" class="btn btn-success d-block">Register</button>
        </div>
        <a style="none; color: #777;" class="text-center nav-link" href="<?= base_url('login') ?>">Sudah punya akun?</a>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>