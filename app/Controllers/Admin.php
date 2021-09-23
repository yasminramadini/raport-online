<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function __construct() 
    {
      $this->validation = \Config\Services::validation();
      $this->kelasModel = new \App\Models\KelasModel();
      $this->mapelModel = new \App\Models\MapelModel();
      $this->sekolahModel = new \App\Models\SekolahModel();
      helper('filesystem');
    }
    
    public function index()
    {
      $data = [
        'title' => 'Data Raport Siswa'
        ];
        
      return view('admin/siswa/siswa', $data);
    }
    
    public function mapel() 
    {
      //jika ada searching
      $keyword = $this->request->getPost('keyword');
      if($keyword) {
        $mapel = $this->mapelModel->cari_mapel($keyword);
      }
      else {
        $mapel = $this->mapelModel;
      }
      
      //penomoran
      if(!$this->request->getGet('page')) {
        $current_page = 1;
      }
      else {
        $current_page = $this->request->getGet('page');
      }
      
      $data = [
        'title' => 'Mata Pelajaran',
        'mapel' => $mapel->paginate(5),
        'pager' => $this->mapelModel->pager,
        'current_page' => $current_page
        ];
        
      return view('admin/mapel/mapel', $data);
    }
    
    public function tipe_ujian()
    {
      $data = [
        'title' => 'Tipe Ujian'
        ];
        
      return view('admin/ujian/tipe_ujian', $data);
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
        
      return view('admin/kelas/data_kelas', $data);
    }
    
    public function data_sekolah()
    {
      session();
      
      $data = [
        'sekolah' => $this->sekolahModel->findAll(),
        'title' => 'Data Sekolah',
        'errors' => $this->validation
        ];
        
      return view('admin/sekolah/data_sekolah', $data);
    }
    
    public function detail_siswa()
    {
      $data = [
        'title' => 'Detail Siswa'
        ];
        
      return view('admin/siswa/detail_siswa', $data);
    }
    
    public function create_kelas() 
    {
      session();
      
      $data = [
        'title' => 'Tambah Kelas',
        'errors' => $this->validation
        ];
        
      return view('admin/kelas/tambah_kelas', $data);
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
        
      return view('admin/kelas/edit_kelas', $data);
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
    
    public function tambah_mapel()
    {
      session();
      
      $data = [
        'title' => 'Tambah Mata Pelajaran',
        'errors' => $this->validation
        ];
      
      return view('admin/mapel/tambah_mapel', $data);
    }
    
    public function store_mapel()
    {
      $data = [
        'nama' => $this->request->getPost('nama'),
        'tipe' => $this->request->getPost('tipe'),
        'kkm' => $this->request->getPost('kkm')
        ];
        
      //validasi data 
      $this->validation->run($data, 'mapel');
      $errors = $this->validation->getErrors();
      
      //jika ada errors
      if($errors) {
        return redirect()->back()->withInput();
      }
      
      //jika tidak ada errors, insert data 
      $this->mapelModel->save($data);
      session()->setFlashdata('tambah', 'Mata Pelajaran berhasil ditambahkan');
      return redirect()->to('/admin/mapel');
    }
    
    public function edit_mapel($id)
    {
      session();
      
      $data = [
        'title' => 'Edit Mata Pelajaran',
        'mapel' => $this->mapelModel->find($id),
        'errors' => $this->validation
        ];
        
      return view('admin/mapel/edit_mapel', $data);
    }
    
    public function update_mapel()
    {
      $data = [
        'nama' => $this->request->getPost('nama'),
        'tipe' => $this->request->getPost('tipe'),
        'kkm' => $this->request->getPost('kkm')
        ];
        
      //validasi data 
      $this->validation->run($data, 'mapel');
      $errors = $this->validation->getErrors();
      
      //jika ada error 
      if($errors) {
        return redirect()->back()->withInput();
      }
      
      //jika tidak ada error, insert data 
      $this->mapelModel->update($this->request->getPost('id'), $data);
      session()->setFlashdata('update', 'Mata Pelajaran berhasil diupdate');
      return redirect()->to('/admin/mapel');
    }
    
    public function hapus_mapel()
    {
      $id = $this->request->getPost('id');
      $this->mapelModel->delete($id);
      session()->setFlashdata('hapus', 'Mata Pelajaran berhasil dihapus');
      return redirect()->to('/admin/mapel');
    }
    
    public function update_sekolah()
    {
      $data = [
        'nama' => $this->request->getPost('nama'),
        'alamat' => $this->request->getPost('alamat'),
        'logo' => $this->request->getFile('logo')
        ];
        
      //validasi data 
      $this->validation->run($data, 'sekolah');
      $errors = $this->validation->getErrors();
      
      //jika ada error
      if($errors) {
        return redirect()->back()->withInput();
      }
      
      //ambil file logo 
      $fileLogo = $this->request->getFile('logo');
      
      //jika user mengupload logo
      if($fileLogo->isValid()) {
      $namaFile = $fileLogo->getRandomName();
      //pindahkan logo 
      $fileLogo->move('logo', $namaFile);
      //hapus logo lama 
      unlink('./logo/'.$this->request->getPost('gambarLama'));
      }
      //jika user tidak mengupload logo 
      else {
        //gunakan gambar lama 
        $namaFile = $this->request->getPost('gambarLama');
      }
      
      //jika tidak ada error, insert data 
      $this->sekolahModel->update(1, [
        'nama' => $this->request->getPost('nama'),
        'alamat' => $this->request->getPost('alamat'),
        'logo' => $namaFile
        ]);
        
      session()->setFlashdata('update', 'Data sekolah berhasil diupdate');
      return redirect()->to('/admin/data_sekolah');
    }
    
}
