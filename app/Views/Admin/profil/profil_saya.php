<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px">
  <h1><i class="bi bi-person me-2"></i>Profil Saya</h1>
  <hr>
  <div class="row mt-5">
    <div class="col-lg-6">
      
      <?php if(session()->getFlashdata('update_profil')) { ?>
      <div class="alert alert-success mb-3">
        <?= session()->getFlashdata('update_profil') ?>
      </div>
      <?php } ?>
      
      <?php if(session()->getFlashdata('username')) { ?>
      <div class="alert alert-danger mb-3">
        <?= session()->getFlashdata('username') ?>
      </div>
      <?php } ?>
      
      <?php if(session()->getFlashdata('email')) { ?>
      <div class="alert alert-danger mb-3">
        <?= session()->getFlashdata('email') ?>
      </div>
      <?php } ?>
      
      <p><i>*ketuk dua kali pada inputan untuk mengeditnya</i></p>

      <form action="/admin/update_profil" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= session()->get('id') ?>">
        <div class="mb-3">
          <label for="nama">Username</label>
          <input type="text" value="<?= esc($user['username']) ?>" readonly id="username" class="form-control <?= $errors->hasError('username') ? 'is-invalid' : '' ?>" name="username" autocomplete="off">
          <p class="invalid-feedback"><?= $errors->getError('username') ?></p>
        </div>
        <div class="mb-3">
          <label for="kepsek">Email</label>
          <input type="email" name="email" value="<?= esc($user['email']) ?>" id="email" class="form-control <?= $errors->hasError('email') ? 'is-invalid' : '' ?>" value="<?= old('email') ?>" readonly autocomplete="off">
          <p class="invalid-feedback"><?= $errors->getError('email') ?></p>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
      </form>
      
      <form action="/admin/hapus_profil" method="post" class="mt-4">
        <input type="hidden" name="id" value="<?= session()->get('id') ?>">
        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau menghapus akun anda?')">Hapus Akun</button>
      </form>
      
    </div>
  </div>
</section>

<script>
  $(document).ready(function() {
    $('#username').on('dblclick', function() {
      $(this).removeAttr('readonly')
    })
    $('#username').on('blur', function() {
      $(this).attr('readonly', '')
    })
    
    $('#email').on('dblclick', function() {
      $(this).removeAttr('readonly')
    })
    $('#email').on('blur', function() {
      $(this).attr('readonly', '')
    })
  })
</script>

<?= $this->endSection() ?>