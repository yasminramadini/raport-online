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
      $this->ujianModel = new \App\Models\UjianModel();
      $this->siswaModel = new \App\Models\SiswaModel();
      $this->nilaiModel = new \App\Models\NilaiModel();
      $this->raportModel = new \App\Models\RaportModel();
      $this->userModel = new \App\Models\UserModel();
    }
    
    public function index()
    {
      if(!$this->request->getGet('page')) {
        $current_page = 1;
      }
      else {
        $current_page = $this->request->getGet('page');
      }
      
      $data = [
        'title' => 'Data Raport Siswa',
        'siswa' => $this->siswaModel->join('kelas', 'kelas.id=siswa.id_kelas')->select('siswa.*')->select('kelas.nama AS kelas')->orderBy('id', 'DESC')->paginate(10),
        'pager' => $this->siswaModel->pager,
        'current_page' => $current_page,
        'sekolah' => $this->sekolahModel->findAll()
        ];
        
      return view('admin/siswa/siswa', $data);
    }
    
    public function cari_siswa()
    {
      $keyword = $this->request->getPost('keyword');
      $siswa = $this->siswaModel->cari_siswa($keyword);
      $kelas = $this->kelasModel->find($siswa->id_kelas);
      
      if(!$this->request->getGet('page')) {
        $current_page = 1;
      }
      else {
        $current_page = $this->request->getGet('page');
      }
      
      $data = [
        'title' => 'Cari Siswa',
        'siswa' => $siswa->paginate(10),
        'kelas' => $kelas,
        'pager' => $this->siswaModel->pager,
        'current_page' => $current_page,
        'sekolah' => $this->sekolahModel->findAll()
        ];
        
      return view('admin/siswa/cari_siswa', $data);
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
        'mapel' => $mapel->orderBy('id', 'DESC')->paginate(10),
        'pager' => $this->mapelModel->pager,
        'current_page' => $current_page,
        'sekolah' => $this->sekolahModel->findAll()
        ];
        
      return view('admin/mapel/mapel', $data);
    }
    
    public function tipe_ujian()
    {
      //jika ada searching 
      $keyword = $this->request->getPost('keyword');
      if($keyword) {
        $ujian = $this->ujianModel->cari_tipe_ujian($keyword);
      } else {
        $ujian = $this->ujianModel;
      }
      
      //penomoran
      if(!$this->request->getGet('page')) {
        $current_page = 1;
      }
      else {
        $current_page = $this->request->getGet('page');
      }
      
      $data = [
        'title' => 'Tipe Ujian',
        'ujian' => $ujian->orderBy('id', 'DESC')->paginate(10),
        'pager' => $this->ujianModel->pager,
        'current_page' => $current_page,
        'sekolah' => $this->sekolahModel->findAll()
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
        'kelas' => $kelas->orderBy('id', 'DESC')->paginate(10),
        'title' => 'Data Kelas',
        'pager' => $this->kelasModel->pager,
        'current_page' => $current_page,
        'sekolah' => $this->sekolahModel->findAll()
        ];
        
      return view('admin/kelas/data_kelas', $data);
    }
    
    public function data_sekolah()
    {
      $data = [
        'sekolah' => $this->sekolahModel->findAll(),
        'title' => 'Data Sekolah',
        'errors' => $this->validation,
        'sekolah' => $this->sekolahModel->findAll()
        ];
        
      return view('admin/sekolah/data_sekolah', $data);
    }
    
    public function detail_siswa($id)
    {
      if(session()->get('isLogin') !== 'true') {
        return redirect()->to('/login');
      }
      
      $siswa = $this->siswaModel->find($id);
      //ambil nama kelas
      $kelas = $this->kelasModel->find($siswa['id_kelas']);
      $raport = $this->raportModel->join('tipe_ujian', 'raport.id_ujian=tipe_ujian.id')->select('tipe_ujian.nama as ujian')->select('raport.*')->where('id_siswa', $id)->orderBy('raport.id', 'DESC')->findAll();
      
      $data = [
        'title' => 'Detail Siswa',
        'siswa' => $siswa,
        'kelas' => $kelas,
        'raport' => $raport,
        'sekolah' => $this->sekolahModel->findAll()
        ];
      return view('admin/siswa/detail_siswa', $data);
    }
    
    public function create_kelas() 
    {
      $data = [
        'title' => 'Tambah Kelas',
        'errors' => $this->validation,
        'sekolah' => $this->sekolahModel->findAll()
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
      if(session()->get('isLogin') !== 'true') {
        return redirect()->to('/login');
      }
      
      $data = [
        'kelas' => $this->kelasModel->find($id),
        'errors' => $this->validation,
        'title' => 'Edit Kelas',
        'sekolah' => $this->sekolahModel->findAll()
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
      //cek apakah kelas sudah memiliki siswa 
      $kelas = $this->kelasModel->find($this->request->getPost('id'));
      $siswa = $this->siswaModel->where('id_kelas', $kelas['id'])->findAll();
      if(count($siswa) > 0) {
        return redirect()->back()->with('dontDelete', 'Kelas tidak bisa dihapus karena sudah memiliki siswa');
      }
      
      $this->kelasModel->delete($this->request->getPost('id'));
      session()->setFlashdata('hapus', 'Kelas berhasil dihapus');
      return redirect()->to('/admin/data_kelas');
    }
    
    public function tambah_mapel()
    {
      $data = [
        'title' => 'Tambah Mata Pelajaran',
        'errors' => $this->validation,
        'sekolah' => $this->sekolahModel->findAll()
        ];
      
      return view('admin/mapel/tambah_mapel', $data);
    }
    
    public function store_mapel()
    {
      $data = [
        'nama' => $this->request->getPost('nama'),
        'tipe' => $this->request->getPost('tipe'),
        'kkm' => $this->request->getPost('kkm'),
        'sekolah' => $this->sekolahModel->findAll()
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
      if(session()->get('isLogin') !== 'true') {
        return redirect()->to('/login');
      }
      
      $data = [
        'title' => 'Edit Mata Pelajaran',
        'mapel' => $this->mapelModel->find($id),
        'errors' => $this->validation,
        'sekolah' => $this->sekolahModel->findAll()
        ];
        
      return view('admin/mapel/edit_mapel', $data);
    }
    
    public function update_mapel()
    {
      $data = [
        'nama' => $this->request->getPost('nama'),
        'tipe' => $this->request->getPost('tipe'),
        'kkm' => $this->request->getPost('kkm'),
        'sekolah' => $this->sekolahModel->findAll()
        ];
        
      //validasi data 
      $this->validation->run($data, 'update_mapel');
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
      
      //cek apakah mapel sudah memiliki nilai 
      $mapel = $this->mapelModel->find($id);
      $nilai = $this->nilaiModel->where('id_mapel', $mapel['id'])->findAll();
      if(count($nilai) > 0) {
        return redirect()->back()->with('dontDelete', 'Mapel tidak bisa dihapus karena sudah memiliki beberapa nilai');
      }
      
      $this->mapelModel->delete($id);
      session()->setFlashdata('hapus', 'Mata Pelajaran berhasil dihapus');
      return redirect()->to('/admin/mapel');
    }
    
    public function update_sekolah()
    {
      $data = [
        'nama' => $this->request->getPost('nama'),
        'kepsek' => $this->request->getPost('kepsek'),
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
        'kepsek' => $this->request->getPost('kepsek'),
        'alamat' => $this->request->getPost('alamat'),
        'logo' => $namaFile
        ]);
        
      session()->setFlashdata('update', 'Data sekolah berhasil diupdate');
      return redirect()->to('/admin/data_sekolah');
    }
    
    public function tambah_tipe_ujian()
    {
      $data = [
        'title' => 'Tambah Tipe Ujian',
        'errors' => $this->validation,
        'sekolah' => $this->sekolahModel->findAll()
        ];
      
      return view('admin/ujian/tambah_tipe_ujian', $data);
    }
    
    public function store_tipe_ujian()
    {
      $data = [
        'nama' => $this->request->getPost('nama')
        ];
        
      //validasi data 
      $this->validation->run($data, 'tipe_ujian');
      $errors = $this->validation->getErrors();
      
      //jika ada errors
      if($errors) {
        return redirect()->back()->withInput();
      }
      
      //jika tidak ada errors, input data 
      $this->ujianModel->insert($data);
      session()->setFlashdata('tambah', 'Tipe ujian berhasil ditambahkan');
      return redirect()->to('/admin/tipe_ujian');
    }
    
    public function edit_tipe_ujian($id)
    {
      if(session()->get('isLogin') !== 'true')
      {
        return redirect()->to('/login');
      }
      $data = [
        'ujian' => $this->ujianModel->find($id),
        'title' => 'Edit Tipe Ujian',
        'errors' => $this->validation,
        'sekolah' => $this->sekolahModel->findAll()
        ];
        
      return view('admin/ujian/edit_tipe_ujian', $data);
    }
    
    public function update_tipe_ujian()
    {
      $data = [
        'nama' => $this->request->getPost('nama')
        ];
        
      //validasi data 
      $this->validation->run($data, 'tipe_ujian');
      $errors = $this->validation->getErrors();
      
      //jika ada errors
      if($errors) {
        return redirect()->back()->withInput();
      }
      
      //jika tidak ada errors, update data 
      $this->ujianModel->update($this->request->getPost('id'), $data);
      session()->setFlashdata('update', 'Tipe ujian berhasil diupdate');
      return redirect()->to('/admin/tipe_ujian');
    }
    
    public function hapus_tipe_ujian()
    {
      $id = $this->request->getPost('id');
      
      //cek apakah tipe ujian sudah memiliki raport 
      $tipe_ujian = $this->ujianModel->find($id);
      $raport = $this->raportModel->where('id_ujian', $tipe_ujian['id'])->findAll();
      if(count($raport) > 0) {
        return redirect()->back()->with('dontDelete', 'Tipe ujian tidak bisa dihapus karena sudah memiliki raport');
      }
      
      $this->ujianModel->delete($id);
      session()->setFlashdata('hapus', 'Tipe ujian berhasil dihapus');
      return redirect()->to('/admin/tipe_ujian');
    }
    
  public function tambah_siswa()
  {
    $data = [
      'title' => 'Tambah Siswa',
      'errors' => $this->validation,
      'daftarKelas' => $this->kelasModel->orderBy('nama', 'ASC')->findAll(),
      'sekolah' => $this->sekolahModel->findAll()
      ];
      
    return view('admin/siswa/tambah_siswa', $data);
  }
  
  public function store_siswa()
  {
    $data = [
      'nama' => $this->request->getPost('nama'),
      'kelas' => $this->request->getPost('kelas'),
      'nis' => $this->request->getPost('nis')
      ];
      
    //ambil id kelas 
    $id_kelas = $this->kelasModel->where('nama', $data['kelas'])->first();
    
    //validasi data 
    $this->validation->run($data, 'siswa');
    $errors = $this->validation->getErrors();
    
    //jika ada error 
    if($errors) {
      return redirect()->back()->withInput();
    }
    
    //jika tidak ada error, insert data 
    $this->siswaModel->save([
      'nama' => $this->request->getPost('nama'),
      'id_kelas' => $id_kelas['id'],
      'nis' => $this->request->getPost('nis')
      ]);
    session()->setFlashdata('tambah', 'Siswa berhasil ditambahkan');
    return redirect()->to('/admin');
  }
  
  public function edit_siswa($id)
  {
    if(session()->get('isLogin') !== 'true') {
      return redirect()->to('/login');
    }
    
    $siswa = $this->siswaModel->find($id);
    //ambil nama kelas 
    $kelas = $this->kelasModel->find($siswa['id_kelas']);
    
    $data = [
      'title' => 'Edit Siswa',
      'siswa' => $siswa,
      'kelas' => $kelas,
      'daftarKelas' => $this->kelasModel->orderBy('nama', 'ASC')->findAll(),
      'errors' => $this->validation,
      'sekolah' => $this->sekolahModel->findAll()
      ];
      
    return view('admin/siswa/edit_siswa', $data);
  }
  
  public function update_siswa()
  {
    $data = [
      'nama' => $this->request->getPost('nama'),
      'kelas' => $this->request->getPost('kelas'),
      'nis' => $this->request->getPost('nis')
      ];
      
    //validasi data 
    $this->validation->run($data, 'update_siswa');
    $errors = $this->validation->getErrors();
    
    //jika ada errors
    if($errors) {
      return redirect()->back()->withInput();
    }
    
    //jika nis sudah dipakai siswa lain 
    $cekNis = $this->siswaModel->where('nis', $data['nis'])->where('nama !=', $data['nama'])->first();
    if($cekNis) {
      session()->setFlashdata('nis', 'NIS sudah dipakai');
      return redirect()->back()->withInput();
    }
    
    //jika tidak ada error, update data 
    //ambil id kelas 
    $id_kelas = $this->kelasModel->where('nama', $data['kelas'])->first();
    
    $this->siswaModel->update($this->request->getPost('id'), [
      'nama' => $data['nama'],
      'id_kelas' => $id_kelas['id'],
      'nis' => $data['nis']
      ]);
    session()->setFlashdata('update', 'Siswa berhasil diupdate');
    return redirect()->to('/admin/detail_siswa/'.$this->request->getPost('id'));
  }
  
  public function hapus_siswa()
  {
    $id = $this->request->getPost('id');
    $siswa = $this->siswaModel->find($id);
    
    //hapus raport siswanya juga
    $raport = $this->raportModel->where('id_siswa', $siswa['id'])->findAll();
    
    if(count($raport) > 0) {
      foreach($raport as $r) {
        $nilai = $this->nilaiModel->where('id_raport', $r['id'])->findAll();
        foreach($nilai as $n) {
          //hapus juga nilai raportnya
          $this->nilaiModel->query('DELETE FROM nilai WHERE id_raport =' . $r['id']);
          }
        }
        $this->raportModel->query('DELETE FROM raport WHERE id_siswa =' .  $siswa['id']);
    }
  
    $this->siswaModel->delete($id);
    session()->setFlashdata('hapus', 'Siswa berhasil dihapus');
    return redirect()->to('/admin'); 
  }
  
  public function tambah_raport($id)
  {
    if(session()->get('isLogin') !== 'true') {
      return redirect()->to('/login');
    }
    $siswa = $this->siswaModel->find($id);
    
    $data = [
      'title' => 'Tambah Raport',
      'siswa' => $siswa,
      'errors' => $this->validation,
      'ujian' => $this->ujianModel->findAll(),
      'kelas' => $this->kelasModel->find($siswa['id_kelas']),
      'mapel' => $this->mapelModel->findAll(),
      'sekolah' => $this->sekolahModel->findAll()
      ];
      
    return view('admin/raport/tambah_raport', $data);
  }
  
  public function store_raport()
  {
    //validasi data 
    $this->validation->run($this->request->getPost(), 'raport');
    $errors = $this->validation->getErrors();
    
    //jika ada error
    if($errors) {
      return redirect()->back()->withInput();
    }
    
    //ambil id siswa 
    $idSiswa = $this->siswaModel->where('nama', $this->request->getPost('nama'))->first();
    $idSiswa = $idSiswa['id'];
  
  //ambil id tipe ujian 
  $idTipeUjian = $this->ujianModel->where('nama', $this->request->getPost('tipe_ujian'))->first();
  $idTipeUjian = $idTipeUjian['id'];
  
  $namaFileRaport = date('Y-m-d') . '_' . $this->request->getPost('nama') . '_' . $this->request->getPost('tipe_ujian');
  
  //insert data ke table raport 
  $dataRaport = [
    'id_siswa' => $idSiswa,
    'id_ujian' => $idTipeUjian,
    'nama_file' => $namaFileRaport,
    'thn_pelajaran' => $this->request->getPost('thn_pelajaran'),
    'sakit' => $this->request->getPost('sakit'),
    'izin' => $this->request->getPost('izin'),
    'alfa' => $this->request->getPost('alfa'),
    'catatan' => $this->request->getPost('catatan')
    ];
    $simpanDataRaport = $this->raportModel->insertData($dataRaport);
    
    //ambil id mapel
    $mapel = $this->request->getPost('mapel');
    
    foreach ($mapel as $key => $val) {
      $cariIdMapel = $this->mapelModel->where('nama', $key)->findAll();
      foreach ($cariIdMapel as $idMapel) {
        //insert ke table nilai
        $this->nilaiModel->insert([
          'id_raport' => $simpanDataRaport,
          'id_mapel' => $idMapel['id'],
          'nilai' => $val
          ]);
      }
    }
    
    return redirect()->to('/admin/detail_siswa/'.$this->request->getPost('id'))->with('tambahRaport', 'Raport berhasil ditambahkan');
    
  }
  
  public function hapus_raport()
  {
    $id = $this->request->getPost('idRaport');
    
    //ambil nilai raport 
    $raport = $this->raportModel->find($id);
    
    //hapus nilai
    $sql = "DELETE FROM nilai WHERE id_raport = ?";
    $this->nilaiModel->query($sql, [$raport['id'] ]);
    
    //hapus raport
    $this->raportModel->delete($id);
    
    session()->setFlashdata('hapusRaport', 'Raport berhasil dihapus');
    return redirect()->to('/admin/detail_siswa/'.$this->request->getPost('idSiswa'));
  }
  
  public function lihat_raport($id, $download = false)
  {
    $raport = $this->raportModel->find($id);
    $siswa = $this->siswaModel->find($raport['id_siswa']);
    $tipe_ujian = $this->ujianModel->find($raport['id_ujian']);
    $kelas = $this->kelasModel->find($siswa['id_kelas']);
    $nilai = $this->nilaiModel->join('mapel', 'nilai.id_mapel=mapel.id')->select('mapel.nama')->select('mapel.kkm')->select('nilai.*')->where('id_raport', $raport['id'])->findAll();
    
    $data = [
      'title' => 'Detail Raport',
      'raport' => $raport,
      'kelas' => $kelas,
      'siswa' => $siswa,
      'tipe_ujian' => $tipe_ujian,
      'nilai' => $nilai,
      'sekolah' => $this->sekolahModel->findAll()
      ];
      
    if($download === 'download') {
      $namaFileRaport = $raport['nama_file'];
      $dompdf = new \Dompdf\Dompdf();
      $dompdf->loadHtml(view('admin/raport/lihat_raport', $data));
      $dompdf->setPaper('A4', 'portrait');
      $dompdf->render();
      $dompdf->stream($namaFileRaport);
      return redirect()->to('/');
    }
      
    return view('admin/raport/lihat_raport', $data);
  }
  
  public function profil()
  {
    $data = [
      'title' => 'Profil Saya',
      'user' => $this->userModel->find(session()->get('id')),
      'errors' => $this->validation,
      'sekolah' => $this->sekolahModel->findAll()
      ];

    return view('admin/profil/profil_saya', $data);
  }
  
  public function update_profil()
  {
    $data = [
      'username' => $this->request->getPost('username'),
      'email' => $this->request->getPost('email')
      ];
      
    //validasi 
    $this->validation->run($data, 'update_profil');
    $errors = $this->validation->getErrors();
    
    //cek apakah username sudah dipakai 
    $cekUsername = $this->userModel->where('username', $data['username'])->where('id !=', $this->request->getPost('id'))->findAll();
    $cekEmail = $this->userModel->where('email', $data['email'])->where('id !=', $this->request->getPost('id'))->findAll();
    
    if($errors) {
      return redirect()->back()->withInput();
    }
    
    if(count($cekUsername) > 0) {
      session()->setFlashdata('username', 'Username sudah dipakai');
      return redirect()->back()->withInput();
    }
    
    if(count($cekEmail) > 0) {
      session()->setFlashdata('email', 'Email sudah dipakai');
      return redirect()->back()->withInput();
    }
    
    $this->userModel->update($this->request->getPost('id'), $data);
    session()->set('username', $data['username']);
    session()->setFlashdata('update_profil', 'Profil berhasil diupdate');
    return redirect()->to('/admin/profil');
  }
  
  public function hapus_profil()
  {
    $id = $this->request->getPost('id');
    $this->userModel->delete($id);
    session()->destroy();
    return redirect()->to('/login');
  }
    
}
