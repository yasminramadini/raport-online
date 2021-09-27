<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function __construct()
    {
      $this->sekolahModel = new \App\Models\SekolahModel();
      $this->userModel = new \App\Models\UserModel();
      $this->validation = \Config\Services::validation();
    }
    
    public function index()
    {
        session();
        
        if(session()->get('isLogin') === 'true') {
          return redirect()->to('/admin');
        }
        
        $data = [
          'title' => 'Login',
          'sekolah' => $this->sekolahModel->findAll(),
          'errors' => $this->validation
          ];
          
        return view('auth/login', $data);
    }
    
    public function register()
    {
      session();
      
      if(session()->get('isLogin') === 'true') {
        return redirect()->to('/admin');
      }
      
      $data = [
        'errors' => $this->validation,
        'title' => 'Register',
        'sekolah' => $this->sekolahModel->findAll()
        ];
        
      return view('auth/register', $data);
    }
    
    public function store_register()
    {
      session();
      
      //validasi data 
      $this->validation->run($this->request->getPost(), 'register');
      $errors = $this->validation->getErrors();
      
      //jika ada errors 
      if($errors) {
        return redirect()->to('/register')->withInput();
      }
      
      //hash password
      $rawPassword = $this->request->getPost('password');
      $hashPassword = password_hash($rawPassword, PASSWORD_DEFAULT);

      $data = [
        'username' => $this->request->getPost('username'),
        'password' => $hashPassword,
        'role' => 1
        ];
      
      //insert data 
      $this->userModel->insert($data);
      session()->setFlashdata('register', 'Anda berhasil mendaftar! silahkan login');
      return redirect()->to('/login');
    }
    
    public function store_login()
    {
      session();
      
      //validasi data 
      $this->validation->run($this->request->getPost(), 'login');
      
      //cek username atau email
      $username = $this->request->getPost('username');
      $cekUsername = $this->userModel->where('username', $username)->orWhere('email', $username)->first();
      
      //jika username ada, cek password 
      if($cekUsername) {
        $rawPassword = $this->request->getPost('password');
        $hashPassword = $cekUsername['password'];
        
        if(password_verify($rawPassword, $hashPassword)) {
          $data = [
            'role' => $cekUsername['role'],
            'username' => $cekUsername['username'],
            'isLogin' => 'true'
            ];
          session()->set($data);
          
          return redirect()->to('/admin');
        }
        
        //jika password salah
        session()->setFlashdata('passwordSalah', 'password tidak cocok');
        return redirect()->back()->withInput();
      }
      
      //jika username tidak ada, redirect balik
        session()->setFlashdata('usernameSalah', 'username atau email tidak ditemukan');
        return redirect()->back()->withInput();
    }
    
    public function logout()
    {
      session()->destroy();
      return redirect()->to('/login');
    }
    
}
