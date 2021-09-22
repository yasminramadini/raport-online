<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px">
  <h1><i class="bi bi-person me-2"></i>Detail Siswa</h1>
  <hr>
  <div class="row mt-5">
    <div class="col-lg-6">

      <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="nama">Nama Siswa</label>
          <input type="text" value="Ronaldo" disabled id="nama" class="form-control">
        </div>
        <div class="mb-3">
          <label for="kelas">Kelas</label>
          <input type="text" id="kelas" disabled class="form-control" value="11 RPL">
        </div>
        <div class="mb-3">
          <label for="nis">Nomor Induk Siswa (NIS)</label>
          <input type="number" id="nis" class="form-control" value="9283" disabled>
        </div>
        <button class="btn btn-warning">Edit Siswa</button>
        <button class="btn btn-danger">Hapus Siswa</button>
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