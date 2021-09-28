<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px; overflow-x: hidden">
  <h1><i class="bi bi-easel me-2"></i>Data Kelas</h1>
  <hr>
  <div class="row mt-5" style="overflow-x: hidden">
    <div class="col-lg-6">
      
      <?php 
        if(session()->getFlashdata('sukses')) { ?>
        <div class="alert alert-success mt-3"><?= session()->getFlashdata('sukses') ?></div>
      <?php } ?>
      
      <?php 
        if(session()->getFlashdata('update')) { ?>
        <div class="alert alert-success mt-3"><?= session()->getFlashdata('update') ?></div>
        <?php } ?>
        
      <?php
      if(session()->getFlashdata('hapus')) { ?>
      <div class="alert alert-success mt-3"><?= session()->getFlashdata('hapus') ?></div>
      <?php } ?>
      
      <?php if(session()->getFlashdata('dontDelete')) { ?>
      <script>alert('Kelas tidak bisa dihapus karena sudah memiliki siswa')</script>
      <?php } ?>
      
      <a href="<?= base_url('admin/create_kelas') ?>" class="my-3 btn btn-primary">Tambah Kelas</a>

      <form method="post" action="/admin/data_kelas">
        <div class="input-group">
          <input type="search" name="keyword" class="form-control" placeholder="Cari kelas..." autocomplete="off">
          <button type="submit" class="btn btn-success" name="cari">Cari</button>
        </div>
      </form>
      
      <?php 
      //penomoran
      $i = ($current_page * 10) - (10 - 1);
      ?>
      
      <?php if(isset($_POST['cari'])) { ?>
      <p class="mt-3"><?= count($kelas) ?> hasil pencarian untuk <b><?= esc($_POST['keyword']) ?></b>:</p>
      <p><a style="text-decoration: none;" href="<?= base_url('admin/data_kelas')?>">Tampilkan semua</a></p>
      <?php } ?>
      
      <div style="overflow-x: auto" id="content">
        <table class="table table-bordered table-striped mt-3">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($kelas as $k) { ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= esc($k['nama']) ?></td>
              <td>
                <form method="post" action="/admin/hapus_kelas"> 
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($k['id']) ?>">
                <button class="btn btn-danger" onclick="return confirm('Yakin mau menghapus?')"><i class="bi bi-trash"></i></button>
                </form>
                <a href="<?= base_url('admin/edit_kelas/'. esc($k['id'])) ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        
        <?= $pager->links() ?>
        
        <?php if(count(esc($kelas)) === 0) { ?>
        <div class="alert alert-warning mt-3">Tidak ada kelas</div>
        <?php } ?>
      </div>
      
    </div>
  </div>
</section>

<?= $this->endSection() ?>