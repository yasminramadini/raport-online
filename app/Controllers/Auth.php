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
      $this->email = \Config\Services::email();
    }
    
    private function sendEmail($from, $nama, $to, $subject, $message) 
    {
      $this->email->setFrom($from, $nama);
      $this->email->setTo($to);
      $this->email->setSubject($subject);
      $this->email->setMessage($message);
      
      if(!$this->email->send()) {
        return false;
      }
      return true;
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
    
    public function lupa_password()
    {
      $data = [
        'title' => 'Cek Email',
        'errors' => $this->validation
        ];
      
      return view('auth/cek_email', $data);
    }
    
    public function cek_email()
    {
      $emailUser = $this->request->getPost('email');
      $user = $this->userModel->where('email', $emailUser)->first();
      
      //bandingkan email 
      if(!$user) {
        //jika email tidak ditemukan
        session()->setFlashdata('emailSalah', 'Email anda belum terdaftar');
        return redirect()->back()->withInput();
      }
      
      //jika email ada, kirim kode OTP
      $otp = rand(1, 999999);
      $msg = '<h2>Halo, ' . $user['username'] . '!</h2><p>Berikut ini adalah kode OTP kamu untuk mengganti password: <b>' . $otp . '</b></p>';
      
      $this->sendEmail('mastercoc1231@gmail.com', 'Admin Website Raport', $user['email'], 'Kode OTP', $msg);
      
      //update kolom otp user 
      $data = [
        'otp' => $otp
        ];
      $this->userModel->update($user['id'], $data);
      
      session()->set(['otpUsername' => $user['username']]);
      
      session()->setFlashdata('otp', 'Kami sudah mengirim kode OTP ke email ' . $user['email'] . ', silahkan cek email anda dan masukkan kodenya.');
      return redirect()->to('/masukkan_otp');
    }
    
    public function masukkan_otp()
    {
      $data = [
        'title' => 'Masukkan OTP'
        ];
        
      return view('auth/masukkan_otp', $data);
    }
    
    public function proses_otp()
    {
      $inputOtp = $this->request->getPost('otp');
      
      $otpUser = $this->userModel->where('username', session()->get('otpUsername'))->first();
      
      if($otpUser['otp'] !== $inputOtp) {
        session()->setFlashdata('otpSalah', 'Kode OTP yang anda masukkan salah');
        return redirect()->back()->withInput();
      }
      
      return redirect()->to('/ubah_password');
    }
    
    public function ubah_password()
    {
      $data = [
        'title' => 'Ubah Password',
        'errors' => $this->validation
        ];
        
      return view('auth/ubah_password', $data);
    }
    
    public function simpan_password()
    {
      //validasi 
      $this->validation->run($this->request->getPost(), 'ubah_password');
      $errors = $this->validation->getErrors();
      
      if($errors) {
        return redirect()->back()->withInput();
      }
      
      //cari username yang sama dengan otpUsername
      $user = $this->userModel->where('username', session()->get('otpUsername'))->first();
      
      //hash password 
      $rawPassword = $this->request->getPost('password');
      $hashPassword = password_hash($rawPassword, PASSWORD_DEFAULT);
      
      $data = [
        'password' => $hashPassword,
        'otp' => 0
        ];
      
      $this->userModel->update($user['id'], $data);
      
      session()->setFlashdata('updatePassword', 'Password anda berhasil diubah! silahkan login');
      return redirect()->to('/login');
    }
    
}
