<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px">
  <h1 class="my-4">Edit Siswa</h1>
  <hr>
  <div class="row mt-5">
    <div class="col-lg-6">
      
      <form method="post" action="<?= base_url('admin/update_siswa') ?>">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= $siswa['id'] ?>">
        <div class="mb-3">
          <label for="nama">Nama Siswa</label>
          <input type="text" id="nama" name="nama" class="form-control <?= $errors->hasError('nama') ? 'is-invalid' : '' ?>" value="<?= $siswa['nama'] ?>" autocomplete="off" required>
          <p class="invalid-feedback"><?= $errors->getError('nama') ?></p>
        </div>
        <div class="mb-3">
          <label for="kelas">Kelas</label>
          <select name="kelas" class="form-select">
            <?php foreach ($daftarKelas as $k) { ?>
            <option value="<?= $k['nama'] ?>" <?= $kelas['nama'] === $k['nama'] ? 'selected' : '' ?>><?= $k['nama'] ?></option>
            <?php } ?>
          </select>
          <p class="invalid-feedback errorTipe"><?= $errors->getError('kelas') ?></p>
        </div>
        <div class="mb-3">
          <label for="nis">Nomor Induk Siswa (NIS)</label>
          <input type="number" id="nis" name="nis" class="form-control <?= $errors->hasError('nis') ? 'is-invalid' : '' ?>" value="<?= $siswa['nis'] ?>" autocomplete="off" required>
          <p class="invalid-feedback"><?= $errors->getError('nis') ?></p>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
      </form>
      
    </div>
  </div>
</section>

<?= $this->endSection() ?>