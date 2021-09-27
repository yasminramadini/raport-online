<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Siswa extends BaseController
{
    public function __construct()
    {
      $this->siswaModel = new \App\Models\SiswaModel();
      $this->raportModel = new \App\Models\RaportModel();
    }
    public function index()
    {
      $data = ['title' => 'Website Raport Online'];
        return view('siswa/index', $data);
    }
    
    public function cari_raport()
    {
      $nis = $this->request->getPost('keyword');
      
      //cari siswa berdasarkan nis, lalu ambil idnya
      $siswa = $this->siswaModel->where('nis', $nis)->first();
      
      //ambil raport sesuai id siswa 
      $raport = $this->raportModel->join('tipe_ujian', 'raport.id_ujian=tipe_ujian.id')->select('raport.*')->select('tipe_ujian.nama as ujian')->where('id_siswa', $siswa['id'])->findAll();
      
      $data = [
        'title' => 'Cari Raport',
        'raport' => $raport,
        'siswa' => $siswa['nama']
        ];
        
      return view('siswa/download_raport', $data);
    }
}
