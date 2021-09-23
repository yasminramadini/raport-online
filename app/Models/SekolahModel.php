<?php

namespace App\Models;

use CodeIgniter\Model;

class SekolahModel extends Model
{
    protected $table = 'sekolah';
    protected $returnType = 'array';
    protected $allowedFields = ['nama', 'alamat', 'logo'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
}
