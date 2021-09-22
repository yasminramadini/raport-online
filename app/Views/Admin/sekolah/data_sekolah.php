<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<section class="raport bg-white" style="border-radius: 10px">
  <h1><i class="bi bi-building me-2"></i>Data Sekolah</h1>
  <hr>
  <div class="row mt-5">
    <div class="col-lg-6">
      
      <p><i>*ketuk dua kali pada inputan untuk mengeditnya</i></p>

      <form action="/admin/update_sekolah" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
          <label for="nama">Nama Sekolah</label>
          <input type="text" value="SMK Informatika" readonly id="nama" class="form-control">
        </div>
        <div class="mb-3">
          <label for="alamat">Alamat Sekolah</label>
          <textarea class="form-control" id="alamat" readonly>Jl. Silicon Valley, No 52, Sukabumi, Jawa Barat</textarea>
        </div>
        <div class="mb-3">
          <img src="<?= base_url('logo.png') ?>" width="100px" class="d-block img-thumbnail mb-3">
          <label for="logo">Logo Sekolah</label>
          <input type="file" id="logo" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
      </form>
      
    </div>
  </div>
</section>

<script>
  $(document).ready(function() {
    $('#nama').on('dblclick', function() {
      $(this).removeAttr('readonly')
    })
    
    $('#nama').on('blur', function() {
      $(this).attr('readonly', '')
    })
    
    $('#alamat').on('dblclick', function() {
      $(this).removeAttr('readonly')
    })
    
    $('#alamat').on('blur', function() {
      $(this).attr('readonly', '')
    })
  })
</script>

<?= $this->endSection() ?>