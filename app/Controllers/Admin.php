<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function index()
    {
      $data = [
        'title' => 'Data Raport Siswa'
        ];
        
      return view('admin/index', $data);
    }
    
    public function mapel() 
    {
      $data = [
        'title' => 'Mata Pelajaran'
        ];
        
      return view('admin/mapel', $data);
    }
    
    public function tipe_ujian()
    {
      $data = [
        'title' => 'Tipe Ujian'
        ];
        
      return view('admin/tipe_ujian', $data);
    }
    
    public function data_kelas()
    {
      $data = [
        'title' => 'Data Kelas'
        ];
        
      return view('admin/data_kelas', $data);
    }
    
    public function data_sekolah()
    {
      $data = [
        'title' => 'Data Sekolah'
        ];
        
      return view('admin/data_sekolah', $data);
    }
    
    public function detail_siswa()
    {
      $data = [
        'title' => 'Detail Siswa'
        ];
        
      return view('admin/detail_siswa', $data);
    }
    
}
