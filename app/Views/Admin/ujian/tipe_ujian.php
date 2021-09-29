<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px">
  <h1><i class="bi bi-file-earmark-post me-2"></i>Tipe Ujian</h1>
  <hr>
  
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
  
  <?php if(session()->getFlashdata('dontDelete')) { ?>
  <script>alert('Tipe ujian tidak bisa dihapus karena sudah memiliki raport. Silahkan hapus raportnya terlebih dahulu')</script>
  <?php } ?>
  
  <div class="row mt-5">
    <div class="col-lg-6">
      <a href="<?= base_url('admin/tambah_tipe_ujian') ?>" class="my-3 btn btn-primary">Tambah Ujian</a>
      
      <form method="post" action="">
        <div class="input-group">
          <input type="search" name="keyword" class="form-control" placeholder="Cari tipe ujian..." autocomplete="off">
          <button class="btn btn-success" name="cari">Cari</button>
        </div>
      </form>
      
      <?php if(isset($_POST['cari'])) { ?>
      <p class="mt-3"><?= count($ujian) ?> hasil pencarian untuk <b><?= esc($_POST['keyword']) ?></b>:</p>
      <a style="text-decoration: none;" href="<?= base_url('admin/tipe_ujian') ?>">Tampilkan semua</a>
      <?php } ?>
      
      <div style="overflow-x: auto">
        <table class="table table-bordered table-striped mt-3">
          <thead>
            <tr>
              <th>No</th>
              <th>Tipe</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = ($current_page * 10) - (10 - 1) ?>
            <?php foreach ($ujian as $u) { ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= esc($u['nama']) ?></td>
              <td>
                <form method="post" action="/admin/hapus_tipe_ujian">
                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                <button class="btn btn-danger" onclick="return confirm('Yakin mau menghapus?')"><i class="bi bi-trash"></i></button>
                </form>
                <a href="<?= base_url('admin/edit_tipe_ujian/'.$u['id']) ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?= $pager->links() ?>
        <?php if(count($ujian) === 0) { ?>
        <div class="alert alert-warning mt-3">Tidak ada tipe ujian</div>
        <?php } ?>
      </div>
      
    </div>
  </div>
</section>

<?= $this->endSection() ?>