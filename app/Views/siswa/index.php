<?= $this->extend('siswa/layout') ?>

<?= $this->section('content') ?>

<div class="wrapper">
  <img src="<?= base_url('student.png') ?>" width="50%" class="d-block mt-4">
  <div class="card bg-white shadow p-3 text-center" style="width: 80%; height: 300px; max-width: 700px;">
    <div class="mb-4">
      <h2 class="display-3">Selamat Datang!</h2>
      <p>Silahkan tulis NIS anda untuk mencari raport</p>
    </div>
    <form action="" method="post">
      <div class="input-group" id="myForm">
        <input type="number" name="keyword" class="form-control" id="keyword" placeholder="Masukkan NIS" required>
        <button id="submit" type="submit" class="btn btn-success">Cari</button>
      </div>
      <p class="invalid-feedback" id="error"></p>
    </form>
  </div>
</div>

<?= $this->endSection() ?>