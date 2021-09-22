<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function __construct() 
    {
      $this->validation = \Config\Services::validation();
      $this->kelasModel = new \App\Models\KelasModel();
    }
    
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
      //rumus penomoran 
      //(current_page * data/hal) - (data/hal - 1)
      
      if(!$this->request->getGet('page')) {
        $current_page = 1;
      }
      else {
        $current_page = $this->request->getGet('page');
      }
      
      //jika ada searching
      $keyword = $this->request->getPost('keyword');
      if($keyword) {
        $kelas = $this->kelasModel->cari_kelas($keyword);
      }
      else {
        $kelas = $this->kelasModel;
      }
      
      $data = [
        'kelas' => $kelas->paginate(5),
        'title' => 'Data Kelas',
        'pager' => $this->kelasModel->pager,
        'current_page' => $current_page
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
    
    public function create_kelas() 
    {
      session();
      
      $data = [
        'title' => 'Tambah Kelas',
        'errors' => $this->validation
        ];
        
      return view('admin/tambah_kelas', $data);
    }
    
    public function store_kelas() 
    {
      //validasi data 
      $kelas = [
        'nama' => $this->request->getPost('nama')
        ];
      $this->validation->run($kelas, 'kelas');
      $errors = $this->validation->getErrors();
      
      //jika validasi gagal
      if($errors) {
        return redirect()->back()->withInput();
      }
      
      //insert data jika tidak ada error 
      $this->kelasModel->save($kelas);
      session()->setFlashdata('sukses', 'Kelas berhasil ditambahkan');
      return redirect()->to('/admin/data_kelas');
    }
    
    public function edit_kelas($id)
    {
      session();
      
      $data = [
        'kelas' => $this->kelasModel->find($id),
        'errors' => $this->validation,
        'title' => 'Edit Kelas'
        ];
        
      return view('admin/edit_kelas', $data);
    }
    
    public function update_kelas() 
    {
      $kelas = [
        'nama' => $this->request->getPost('nama')
        ];
      
      //validasi data 
      $this->validation->run($kelas, 'kelas');
      $errors = $this->validation->getErrors();
      
      //jika ada error 
      if($errors) {
        return redirect()->back()->withInput();
      }
      
      //update data jika tidak ada error 
      $this->kelasModel->update($this->request->getPost('id'), $kelas);
      session()->setFlashdata('update', 'Kelas berhasil diupdate');
      return redirect()->to('/admin/data_kelas');
    }
    
    public function hapus_kelas()
    {
      $this->kelasModel->delete($this->request->getPost('id'));
      session()->setFlashdata('hapus', 'Kelas berhasil dihapus');
      return redirect()->to('/admin/data_kelas');
    }
    
}
