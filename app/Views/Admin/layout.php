<!doctype html>
<html lang="id">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- bootstrap-icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <!-- file css siswa -->
    <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>">
    
    <style>
      body {
        font-family: 'Roboto', Sans-Serif;
        background: #f5f5f5;
        overflow-x: hidden;
      }
    </style>

    <title><?= $title ?></title>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-light bg-info">
      <div class="container">
        <span class="d-flex align-items-center"><img class="navbar-brand mb-0 h1" src="<?= base_url('logo.png') ?>" width="50px"><strong class="fs-3">SMK Informatika</strong></span>
      </div>
    </nav>

    <div class="row" style="overflow-x: hidden">
      <div class="col-lg-3">
        <aside class="bg-dark text-white p-3" id="sidebar">
          <div class="profil my-4 text-center">
            <img src="<?= base_url('user.png') ?>" width="100px" class="d-block mx-auto">
            <p class="fs-4 mb-0 pb-0"><strong>John Doe</strong></p>
            <span class="text-muted">Administrator</span>
          </div>
          <hr>
          <?php $uri = uri_string() ?>
          <nav>
            <ul>
              <li class="nav-item">
                <a href="<?= base_url('admin') ?>" class="nav-link text-white <?= $uri === 'admin' ? 'active' : '' ?>"><i class="bi bi-journals me-2"></i>Data Raport</a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/mapel') ?>" class="nav-link text-white <?= $uri === 'admin/mapel' ? 'active' : '' ?>"><i class="bi bi-stack me-2"></i>Mata Pelajaran</a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/tipe_ujian') ?>" class="nav-link text-white <?= $uri === 'admin/tipe_ujian' ? 'active' : '' ?>"><i class="bi bi-file-earmark-post me-2"></i>Tipe Ujian</a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/data_kelas') ?>" class="nav-link text-white <?= $uri === 'admin/data_kelas' ? 'active' : '' ?>"><i class="bi bi-easel me-2"></i>Data Kelas</a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/data_sekolah') ?>" class="nav-link text-white <?= $uri === 'admin/data_sekolah' ? 'active' : '' ?>"><i class="bi bi-building me-2"></i>Data Sekolah</a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('logout') ?>" class="nav-link text-white"><i class="bi bi-box-arrow-right me-2"></i>Log Out</a>
              </li>
            </ul>
          </nav>
        </aside>
      </div>
      <div class="col-lg-9">
        <div class="container my-5">
          <?= $this->renderSection('content') ?>
          <div class="nav-btn mobile-only bg-danger text-white" draggable="true">
            <i class="bi bi-list" id="navBtn"></i>
          </div>
        </div>
      </div>
    </div>
    
    <script>
      var sidebar = document.getElementById('sidebar');
      var navBtn = document.getElementById('navBtn');
      
      navBtn.onclick = function() {
        sidebar.classList.toggle('nav-toggle');
        if(navBtn.className === 'bi bi-list') {
          navBtn.className = 'bi bi-x';
        }
        else {
          navBtn.className = 'bi bi-list';
        }
      }
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/eruda"></script>
    <script>eruda.init();</script>
  </body>
</html>