<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'kelas';
    protected $returnType = 'array';
    protected $allowedFields = ['nama'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    
    public function cari_kelas($keyword) 
    {
      return $this->table('kelas')->like('nama', $keyword);
    }
}
