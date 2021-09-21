<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px">
  <h1><i class="bi bi-stack me-2"></i>Mata Pelajaran</h1>
  <hr>
  <div class="row mt-5">
    <div class="col-lg-6">
      <input type="search" name="mapel" id="mapel" class="form-control" placeholder="Cari mata pelajaran...">
      
      <div style="overflow-x: auto">
        <table class="table table-bordered table-striped mt-3">
          <thead>
            <tr>
              <th>No</th>
              <th>Mata Pelajaran</th>
              <th>Tipe</th>
              <th>KKM</th>
              <th>Detail</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Matematika</td>
              <td>pelajaran umum</td>
              <td>75</td>
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