<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $table = 'mapel';
    protected $returnType = 'array';
    protected $allowedFields = ['nama', 'tipe', 'kkm'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    
    public function cari_mapel($keyword)
    {
      return $this->table('mapel')->like('nama', $keyword);
    }
}
