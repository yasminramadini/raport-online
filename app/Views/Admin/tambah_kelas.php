<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px">
  <h1 class="my-4">Tambah Kelas</h1>
  <hr>
  <div class="row mt-5">
    <div class="col-lg-6">
      
      <form method="post" action="<?= base_url('admin/store_kelas') ?>">
        <?= csrf_field() ?>
        <div class="mb-3">
          <label for="nama">Nama Kelas</label>
          <input type="text" id="nama" name="nama" class="form-control <?= $errors->hasError('nama') ? 'is-invalid' : '' ?>" value="<?= old('nama') ?>" autocomplete="off">
          <p class="invalid-feedback"><?= $errors->getError('nama') ?></p>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
      </form>
      
    </div>
  </div>
</section>

<?= $this->endSection() ?>