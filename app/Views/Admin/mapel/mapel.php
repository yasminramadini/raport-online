<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px">
  <h1><i class="bi bi-stack me-2"></i>Mata Pelajaran</h1>
  <hr>
  <div class="row mt-5">
    <div class="col-lg-6">
      
      <?php if(session()->getFlashdata('tambah')) { ?>
      <div class="alert alert-success mb-3">
        <?= session()->getFlashdata('tambah') ?>
      </div>
      <?php } ?>
      
      <?php if(session()->getFlashdata('update')) { ?>
      <div class="alert alert-success mb-3">
        <?= session()->getFlashdata('update') ?>
      </div>
      <?php } ?>
      
      <?php if(session()->getFlashdata('hapus')) { ?>
      <div class="alert alert-success mb-3">
        <?= session()->getFlashdata('hapus') ?>
      </div>
      <?php } ?>
      
      <form method="post" action="">
        <div class="input-group">
          <input type="search" name="keyword" class="form-control" placeholder="Cari mata pelajaran..." autocomplete="off">
          <button type="submit" class="btn btn-success" name="cari">Cari</button>
        </div>
      </form>
      
      <?php if(isset($_POST['cari'])) { ?>
      <p><?= count($mapel) ?> hasil pencarian untuk <b><?= $_POST['keyword'] ?></b>:</p>
      <p class="mt-3"><a href="<?= base_url('admin/mapel') ?>" style="text-decoration: none;">Tampilkan semua</a></p>
      <?php } ?>
      
      <?php if(session()->getFlashdata('dontDelete')) { ?>
      <script>alert('Mapel tidak bisa dihapus karena sudah memiliki beberapa nilai')</script>
      <?php } ?>
      
      <a href="<?= base_url('admin/tambah_mapel') ?>" class="btn btn-primary mt-3">Tambah Mapel</a>
      
      <div style="overflow-x: auto">
        <table class="table table-bordered table-striped mt-3">
          <thead>
            <tr>
              <th>No</th>
              <th>Mata Pelajaran</th>
              <th>Tipe</th>
              <th>KKM</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = ($current_page * 5) - (5 - 1) ?>
            <?php foreach($mapel as $m) { ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= esc($m['nama']) ?></td>
              <td><?= esc($m['tipe']) ?></td>
              <td><?= esc($m['kkm']) ?></td>
              <td>
                <form method="post" action="/admin/hapus_mapel">
                  <input type="hidden" name="id" value="<?= $m['id'] ?>">
                   <button class="btn btn-danger"><i class="bi bi-trash" onclick="return confirm('Yakin mau menghapus?')"></i></button>
                </form>
                <a href="<?= base_url('admin/edit_mapel/' . $m['id']) ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?= $pager->links() ?>
      </div>
      
    </div>
  </div>
</section>

<?= $this->endSection() ?>