<?php setlocale(LC_ALL, 'id_ID.utf8'); ?>

<html>
  <head>
    <title>Detail Raport</title>
    <style>
      * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
      }
      .container {
        margin: 0 auto;
        padding: 50px;
        width: 600px;
        margin: 0 auto;
      }
      header {
        text-align: center;
      }
      .biodata {
        margin-top: 30px;
      }
      .left {
        float: left;
      }
      .right {
        float: right;
      }
      .clear {
        clear: both;
      }
      .nilai {
        margin-top: 20px;
      }
      #daftarNilai{
        width: 100%;
        border-collapse: collapse;
        margin-top: 40px;
      }
      #absent {
        width: 80%;
        border-collapse: collapse;
      }
      #daftarNilai td, #daftarNilai th, #absent td, #absent th {
        padding: 8px 30px;
      }
      #absent {
        margin-top: 40px;
      }
      #detail {
        margin-top: 60px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <header>
        <h4 style="margin-bottom: 5px"><b>Laporan Hasil <?= esc($tipe_ujian['nama']) ?></b></h4>
        <h2><?= esc($sekolah[0]['nama']) ?></h2>
        <p style="margin-top: 5px"><?= esc($sekolah[0]['alamat']) ?></p>
      </header>
      <section class="biodata">
        <div class="left">
          <table>
            <tr>
              <td>Nama siswa:</td>
              <td><p style="margin-left: 5px;"><?= esc($siswa['nama']) ?></p></td>
            </tr>
            <tr>
              <td>No. induk:</td>
              <td><?= esc($siswa['nis']) ?></td>
            </tr>
          </table>
        </div>
        <div class="right">
          <table>
            <tr>
              <td>Tahun pelajaran: <?= esc($raport['thn_pelajaran']) ?></td>
            </tr>
            <tr>
              <td>Kelas: <?= esc($kelas['nama']) ?></td>
            </tr>
          </table>
        </div>
      </section>
      <div class="clear"></div>
      <section class="nilai">
        <table border="1px" id="daftarNilai">
          <tr>
            <th>No</th>
            <th>Pelajaran Umum</th>
            <th>KKM</th>
            <th>Nilai</th>
            <th>Rank</th>
          </tr>
          <?php $i = 1 ?>
          <?php foreach($nilai as $n) { ?>
          <tr>
            <td style="text-align: center"><?= $i++ ?></td>
            <td><?= esc($n['nama']) ?></td>
            <td style="text-align: center;"><?= esc($n['kkm']) ?></td>
            <td style="text-align: center;"><?= esc($n['nilai']) ?></td>
            <td style="text-align: center;">
              <?php
                if($n['nilai'] >= 90) {
                  echo "A";
                }
                else if($n['nilai'] >= 80) {
                  echo "B";
                }
                else if($n['nilai'] >= 70) {
                  echo "C";
                }
                else if($n['nilai'] >= 60) {
                  echo "D";
                }
                else if($n['nilai'] >= 50) {
                  echo "E";
                }
                else {
                  echo "F";
                }
              ?>
            </td>
          </tr>
          <?php } ?>
        </table>
        
        <table id="absent" border="1px">
          <tr>
            <th>No</th>
            <th>Ketidakhadiran</th>
            <th>Jumlah</th>
          </tr>
          <tr>
            <td style="text-align: center">1</td>
            <td>Sakit</td>
            <td style="text-align: center;"><?= esc($raport['sakit']) ?></td>
          </tr>
          <tr>
            <td style="text-align: center;">2</td>
            <td>Izin</td>
            <td style="text-align: center;"><?= esc($raport['izin']) ?></td>
          </tr>
          <tr>
            <td style="text-align: center;">3</td>
            <td>Tanpa Keterangan</td>
            <td style="text-align: center;"><?= esc($raport['alfa']) ?></td>
          </tr>
        </table>
        
        <p style="margin: 40px 0 10px">Catatan</p>
          <div style="width: 70%; max-height: 100px; border: 1px solid black; padding: 10px">
          <?= $raport['catatan'] ?>
          </div>
        </textarea>
        
      </section>
      
      <?php
      $hari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
      $namaHari = $hari[date('l', strtotime($raport['created_at']))];
      ?>
      <p style="margin-top: 30px;"><?= $namaHari . ', ' . date('d F Y', strtotime($raport['created_at'])) ?></p>
      <section id="detail">
        <div class="left">
          <p>Wali Kelas</p>
        </div>
        <div class="right">
          <p>Kepala Sekolah</p>
          <p style="margin-top: 35px;"><?= esc($sekolah[0]['kepsek']) ?></p>
        </div>
      </section>
      <div class="clear"></div>
    </div>
  </body>
</html>