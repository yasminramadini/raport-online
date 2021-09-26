<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px">
  <h1 class="my-4">Tambah Raport</h1>
  <hr>
  <div class="row mt-5">
    <div class="col-lg-6">

      <form method="post" action="<?= base_url('admin/store_raport') ?>">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= $siswa['id'] ?>">
        <div class="mb-3">
          <label for="nama">Nama Siswa</label>
          <input type="text" id="nama" name="nama" class="form-control" value="<?= $siswa['nama'] ?>" readonly>
        </div>
        <div class="mb-3">
          <label for="kelas">Kelas</label>
          <input type="text" name="kelas" class="form-control" readonly value="<?= $kelas['nama'] ?>">
        </div>
        <div class="mb-3">
          <label for="nis">Nomor Induk Siswa (NIS)</label>
          <input type="number" id="nis" name="nis" class="form-control" readonly value="<?= $siswa['nis'] ?>">
        </div>
        <div class="mb-3">
          <label for="tipe_ujian">Tipe Ujian</label>
          <select name="tipe_ujian" class="form-select <?= $errors->hasError('tipe_ujian') ? 'is-invalid' : '' ?>">
            <?php foreach($ujian as $u) { ?>
            <option value="<?= $u['nama'] ?>" <?= old('tipe_ujian') === $u['nama'] ? 'selected' : '' ?>><?= $u['nama'] ?></option>
            <?php } ?>
          </select>
          <p class="invalid-feedback"><?= $errors->getError('tipe_ujian') ?></p>
        </div>
        <div class="mb-3">
          <label for="thn_pelajaran">Tahun Pelajaran</label>
          <input type="text" id="thn_pelajaran" name="thn_pelajaran" class="form-control <?= $errors->hasError('thn_pelajaran') ? 'is-invalid' : '' ?>" value="<?= old('thn_pelajaran') ?>" required>
          <small class="text-small">contoh: 2020-2021</small>
          <p class="invalid-feedback"><?= $errors->getError('thn_pelajaran') ?></p>
        </div>
        <hr class="my-3 d-block">
        <h3 class="mb-5">Mata Pelajaran</h3>
        <?php foreach($mapel as $m) { ?>
        <div class="mb-3">
          <label><?= $m['nama'] ?></label>
          <input type="number" name="mapel[<?= $m['nama'] ?>]" class="form-control <?= $errors->hasError($m['nama']) ? 'is-invalid' : '' ?>" maxlength="3" min="1" value="<?php old(url_title($m['nama'], '_')) ?>">
          <p class="invalid-feedback"><?= $errors->getError(url_title($m['nama'], '_')) ?></p>
        </div>
        <?php } ?>
        <hr>
        <div class="mb-5">
          <label for="catatan">Catatan</label>
          <textarea name="catatan" class="form-control <?= $errors->hasError('catatan') ? 'is-invalid' : '' ?>" id="catatan" rows="10" maxlength="1000"><?= old('catatan') ?></textarea>
          <p class="invalid-feedback"><?= $errors->getError('catatan') ?></p>
        </div>
        <hr>
        <h3 class="mb-5">Ketidakhadiran</h3>
        <div class="mb-3">
          <label for="sakit">Sakit</label>
          <input type="number" name="sakit" class="form-control <?= $errors->hasError('sakit') ? 'is-invalid' : '' ?>" value="<?= old('sakit') ?>">
          <p><?= $errors->getError('sakit') ?></p>
        </div>
        <div class="mb-3">
          <label for="izin">Izin</label>
          <input type="number" class="form-control <?= $errors->hasError('izin') ? 'is-invalid' : '' ?>" name="izin" value="<?= old('izin') ?>">
          <p><?= $errors->getError('izin') ?></p>
        </div>
        <div class="mb-3">
          <label for="alfa">Tanpa Keterangan</label>
          <input type="number" class="form-control <?= $errors->hasError('alfa') ? 'is-invalid' : '' ?>" id="alfa" name="alfa" value="<?= old('alfa') ?>">
          <p><?= $errors->getError('alfa') ?></p>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
      </form>
      
    </div>
  </div>
</section>

<?= $this->endSection() ?>