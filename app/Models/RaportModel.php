<?php

namespace App\Models;

use CodeIgniter\Model;

class RaportModel extends Model
{
    protected $table = 'raport';
    protected $returnType = 'array';
    protected $allowedFields = ['id_siswa', 'id_ujian', 'nama_file', 'thn_pelajaran', 'sakit', 'izin', 'alfa', 'catatan'];
    protected $useTimestamps = true;
    
    public function insertData($dataRaport) 
    {
      $this->table('raport')->insert([
        'id_siswa' => $dataRaport['id_siswa'],
        'id_ujian' => $dataRaport['id_ujian'],
        'nama_file' => $dataRaport['nama_file'],
        'thn_pelajaran' => $dataRaport['thn_pelajaran'],
        'sakit' => $dataRaport['sakit'],
        'izin' => $dataRaport['izin'],
        'alfa' => $dataRaport['alfa'],
        'catatan' => $dataRaport['catatan']
        ]);
        
      return $this->table('raport')->insertID();
      
    }
}
