<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px">
  <h1><i class="bi bi-journals me-2"></i>Data Raport</h1>
  <hr>
  <div class="row mt-5">
    <div class="col-lg-6">
      <input type="search" name="namaSiswa" id="namaSiswa" class="form-control" placeholder="Cari nama siswa...">
      
      <div style="overflow-x: auto">
        <table class="table table-bordered table-striped mt-3">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Siswa</th>
              <th>NIS</th>
              <th>Kelas</th>
              <th>Detail</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Ronaldo</td>
              <td>9283</td>
              <td>11 RPL</td>
              <td>
                <a href="#" class="btn btn-success"><i class="bi bi-eye"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      
    </div>
  </div>
</section>

<?= $this->endSection() ?>