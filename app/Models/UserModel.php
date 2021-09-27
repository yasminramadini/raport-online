<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $returnType = 'array';
    protected $allowedFields = ['username', 'password', 'role'];
    protected $useTimestamps = false;
}
