<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px">
  <h1><i class="bi bi-person me-2"></i>Detail Siswa</h1>
  <hr>
  <div class="row mt-5">
    <div class="col-lg-6">
      
      <?php if(session()->getFlashdata('update')) { ?>
      <div class="alert alert-success mb-3">
        <?= session()->getFlashdata('update') ?>
      </div>
      <?php } ?>
      
      <?php if(session()->getFlashdata('tambahRaport')) { ?>
      <div class="alert alert-success mb-3">
        <?= session()->getFlashdata('tambahRaport') ?>
      </div>
      <?php } ?>
      
      <?php if(session()->getFlashdata('hapusRaport')) { ?>
      <div class="alert alert-success mb-3">
        <?= session()->getFlashdata('hapusRaport') ?>
      </div>
      <?php } ?>

        <input type="hidden" name="id" value="<?= $siswa['id'] ?>">
        <div class="mb-3">
          <label for="nama">Nama Siswa</label>
          <input type="text" value="<?= $siswa['nama'] ?>" disabled id="nama" class="form-control">
        </div>
        <div class="mb-3">
          <label for="kelas">Kelas</label>
          <input type="text" id="kelas" disabled class="form-control" value="<?= $kelas['nama'] ?>">
        </div>
        <div class="mb-3">
          <label for="nis">Nomor Induk Siswa (NIS)</label>
          <input type="number" id="nis" class="form-control" value="<?= $siswa['nis'] ?>" disabled>
        </div>
        <div class="mb-3">
          <p>Ditambahkan pada: <?= $siswa['created_at'] ?></p>
          <p>Terakhir diupdate: <?= $siswa['updated_at'] ?></p>
        </div>
        <a class="btn btn-warning d-inline-block" href="<?= base_url('admin/edit_siswa/'.$siswa['id']) ?>">Edit Siswa</a>
        <form method="post" action="/admin/hapus_siswa" class="d-inline-block">
          <input type="hidden" name="id" value="<?= $siswa['id'] ?>">
          <button class="btn btn-danger" onclick="return confirm('Yakin mau menghapus?')">Hapus Siswa</button>
        </form>
        <hr class="mt-4">
        <h2 class="mt-4">Daftar raport siswa:</h2>
        <a href="<?= base_url('admin/tambah_raport/'.$siswa['id']) ?>" class="btn btn-primary">Tambah Raport</a>
    </div>
  </div>
      
      <div class="row mt-4">
        <?php foreach ($raport as $r) { ?>
        <div class="col-lg-4 col-md-6">
          <div class="card mt-3 me-3">
            <div class="card-body">
              <p class="card-title"><b>Raport <?= $r['ujian'] . ' ' . $r['thn_pelajaran'] ?></b></p>
              <p class="card-text">Created at: <?= $r['created_at'] ?></p>
            </div>
            <div class="card-footer d-flex justify-content-between">
              <a href="<?= base_url('admin/lihat_raport/'.$r['id']) ?>" class="btn btn-primary"><i class="bi bi-eye"></i></a>
              <form method="post" action="/admin/hapus_raport">
                <input type="hidden" name="idRaport" value="<?= $r['id'] ?>">
                <input type="hidden" name="idSiswa" value="<?= $siswa['id'] ?>">
                <button class="btn btn-danger" onclick="return confirm('Yakin mau menghapus?')"><i class="bi bi-trash"></i></button>
              </form>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      
</section>

<script>
  $(document).ready(function() {
    $('input').on('click', function() {
      $(this).removeAttr('disabled');
    })
  })
</script>

<?= $this->endSection() ?>