<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'siswa';
    protected $returnType = 'array';
    protected $allowedFields = ['nama', 'id_kelas', 'nis'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    
    public function cari_siswa($keyword) 
    {
      return $this->table('siswa')->like('nama', $keyword);
    }
}
