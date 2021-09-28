<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px">
  <h1><i class="bi bi-building me-2"></i>Data Sekolah</h1>
  <hr>
  <div class="row mt-5">
    <div class="col-lg-6">
      
      <?php if(session()->getFlashdata('update')) { ?>
      <div class="alert alert-success mb-3">
        <?= session()->getFlashdata('update') ?>
      </div>
      <?php } ?>
      
      <p><i>*ketuk dua kali pada inputan untuk mengeditnya</i></p>

      <form action="/admin/update_sekolah" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="gambarLama" value="<?= $sekolah[0]['logo'] ?>">
        <div class="mb-3">
          <label for="nama">Nama Sekolah</label>
          <input type="text" value="<?= esc($sekolah[0]['nama']) ?>" readonly id="nama" class="form-control <?= $errors->hasError('nama') ? 'is-invalid' : '' ?>" name="nama">
          <p class="invalid-feedback"><?= $errors->getError('nama') ?></p>
        </div>
        <div class="mb-3">
          <label for="kepsek">Kepala Sekolah</label>
          <input type="text" name="kepsek" value="<?= esc($sekolah[0]['kepsek']) ?>" id="kepsek" class="form-control <?= $errors->hasError('kepsek') ? 'is-invalid' : '' ?>" value="<?= old('kepsek') ?>" readonly>
          <p class="invalid-feedback"><?= $errors->getError('kepsek') ?></p>
        </div>
        <div class="mb-3">
          <label for="alamat">Alamat Sekolah</label>
          <textarea class="form-control <?= $errors->hasError('alamat') ? 'is-invalid' : '' ?>" id="alamat" readonly name="alamat"><?= esc($sekolah[0]['alamat']) ?></textarea>
          <p class="invalid-feedback"><?= $errors->getError('alamat') ?></p>
        </div>
        <div class="mb-3">
          <img src="/logo/<?= $sekolah[0]['logo'] ?>" width="100px" class="d-block img-thumbnail mb-3">
          <label for="logo">Logo Sekolah</label>
          <input type="file" id="logo" class="form-control <?= $errors->hasError('logo') ? 'is-invalid' : '' ?>" name="logo">
          <p class="invalid-feedback"><?= $errors->getError('logo') ?></p>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
      </form>
      
    </div>
  </div>
</section>

<script>
  $(document).ready(function() {
    $('#nama').on('dblclick', function() {
      $(this).removeAttr('readonly')
    })
    
    $('#nama').on('blur', function() {
      $(this).attr('readonly', '')
    })
    
    $('#alamat').on('dblclick', function() {
      $(this).removeAttr('readonly')
    })
    
    $('#alamat').on('blur', function() {
      $(this).attr('readonly', '')
    })
    
    $('#kepsek').on('dblclick', function() {
      $(this).removeAttr('readonly');
    })
    
    $('#kepsek').on('blur', function() {
      $(this).attr('readonly', '')
    })
  })
</script>

<?= $this->endSection() ?>