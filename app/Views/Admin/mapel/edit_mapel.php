<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px">
  <h1 class="my-4">Edit Mata Pelajaran</h1>
  <hr>
  <div class="row mt-5">
    <div class="col-lg-6">
      
      <form method="post" action="<?= base_url('admin/update_mapel') ?>">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= $mapel['id'] ?>">
        <div class="mb-3">
          <label for="nama">Nama Pelajaran</label>
          <input type="text" id="nama" name="nama" class="form-control <?= $errors->hasError('nama') ? 'is-invalid' : '' ?>" value="<?= old('nama') ? old('nama') : $mapel['nama'] ?>" autocomplete="off" required>
          <p class="invalid-feedback"><?= $errors->getError('nama') ?></p>
        </div>
        <div class="mb-3">
          <label for="tipe">Tipe Pelajaran</label>
          <select name="tipe" class="form-select <?= $errors->hasError('tipe') ? 'is-invalid' : '' ?>" id="tipe">
            <option value="pelajaran umum" <?= $mapel['tipe'] === 'pelajaran umum' ? 'selected' : '' ?>>pelajaran umum</option>
            <option value="muatan lokal" <?= $mapel['tipe'] === 'muatan lokal' ? 'selected' : '' ?>>muatan lokal</option>
          </select>
          <p class="invalid-feedback errorTipe"><?= $errors->getError('tipe') ?></p>
        </div>
        <div class="mb-3">
          <label for="kkm">KKM (nilai minimal)</label>
          <input type="number" id="kkm" name="kkm" class="form-control <?= $errors->hasError('kkm') ? 'is-invalid' : '' ?>" value="<?= old('kkm') ? old('kkm') : $mapel['kkm'] ?>" autocomplete="off" required>
          <p class="invalid-feedback"><?= $errors->getError('kkm') ?></p>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
      </form>
      
    </div>
  </div>
</section>

<?= $this->endSection() ?>