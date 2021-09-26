<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table = 'nilai';
    protected $returnType = 'array';
    protected $allowedFields = ['id_raport', 'id_mapel', 'nilai'];
    protected $useTimestamps = false;
    
    public function hapusNilai($id_raport) 
    {
      $this->table('nilai')->delete(['id_raport' => $id_raport]);
      return $this->getCompiledDelete('nilai');
    }
}
