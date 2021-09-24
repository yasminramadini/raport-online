<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px">
  <h1><i class="bi bi-journals me-2"></i>Data Raport</h1>
  <hr>
  
  <?php if(session()->getFlashdata('tambah')) { ?>
  <div class="alert alert-success mb-3">
    <?= session()->getFlashdata('tambah') ?>
  </div>
  <?php } ?>
  
  <?php if(session()->getFlashdata('hapus')) { ?>
  <div class="alert alert-success mb-3">
    <?= session()->getFlashdata('hapus') ?>
  </div>
  <?php } ?>
  
  <div class="row mt-5">
    <div class="col-lg-6">

      <p><?= count($siswa) ?> hasil pencarian untuk <b><?= $_POST['keyword'] ?></b></p>
      <a style="text-decoration: none;" href="<?= base_url('admin') ?>">Tampilkan semua</a>
      
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
            <?php $i = ($current_page * 5) - (5 - 1) ?>
            <?php foreach ($siswa as $s) { ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= $s['nama'] ?></td>
              <td><?= $s['nis'] ?></td>
              <td><?php foreach($kelas as $k) {
              if($k['id'] === $s['id_kelas']) { echo $k['nama']; }
              }?></td>
              <td>
                <a href="<?= base_url('admin/detail_siswa/'.$s['id']) ?>" class="btn btn-success"><i class="bi bi-eye"></i></a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?= $pager->links() ?>
        <?php if(count($siswa) === 0) { ?>
        <div class="alert alert-warning mt-3">
          Tidak ada data siswa
        </div>
        <?php } ?>
      </div>
      
    </div>
  </div>
</section>

<?= $this->endSection() ?>