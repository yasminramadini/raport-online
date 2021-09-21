<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px">
  <h1><i class="bi bi-easel me-2"></i>Data Kelas</h1>
  <hr>
  <div class="row mt-5">
    <div class="col-lg-6">
      <a href="#" class="my-3 btn btn-primary">Tambah Kelas</a>
      <input type="search" name="kelas" id="kelas" class="form-control" placeholder="Cari kelas...">
      
      <div style="overflow-x: auto">
        <table class="table table-bordered table-striped mt-3">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>10 RPL</td>
              <td>
                <a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                <a href="#" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      
    </div>
  </div>
</section>

<?= $this->endSection() ?>