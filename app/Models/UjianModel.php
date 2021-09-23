<?php

namespace App\Models;

use CodeIgniter\Model;

class UjianModel extends Model
{
    protected $table = 'tipe_ujian';
    protected $returnType = 'array';
    protected $allowedFields = ['nama'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    
    public function cari_tipe_ujian($keyword) 
    {
      return $this->table('tipe_ujian')->like('nama', $keyword);
    }
}
