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
        <a class="btn btn-warning d-inline-block" href="<?= base_url('admin/edit_siswa/'.$siswa['id']) ?>">Edit Siswa</a>
        <form method="post" action="/admin/hapus_siswa" class="d-inline-block">
          <input type="hidden" name="id" value="<?= $siswa['id'] ?>">
          <button class="btn btn-danger" onclick="return confirm('Yakin mau menghapus?')">Hapus Siswa</button>
        </form>
    </div>
  </div>
      
      <div class="row mt-4">
        <div class="col-lg-4 col-md-6">
          <div class="card mt-3 me-3">
            <div class="card-body">
              <p class="card-title"><b>Raport Ulangan Tengah Semester 2021/2021</b></p>
              <p class="card-text">Created at: 1 Mei 2021</p>
            </div>
            <div class="card-footer d-flex justify-content-between">
              <a href="#" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
              <a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a>
            </div>
          </div>
        </div>
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