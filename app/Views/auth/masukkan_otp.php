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
    
    <div class="otp bg-white p-3 shadow" style="width: 90%; max-width: 500px; border-radius: 10px; margin-top: 40px">
      <form method="post" action="<?= base_url('proses_otp') ?>">
        <?= csrf_field() ?>
        <p>Masukkan kode OTP anda</p>
        <div class="my-3 position-relative">
          <input type="number" name="otp" class="form-control" autocomplete="off" value="<?= old('otp') ?>" required>
        </div>
        <div class="mb-4 d-grid">
          <button type="submit" class="btn btn-success d-block">Cek OTP</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>