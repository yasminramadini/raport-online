<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailColumnTableUser extends Migration
{
    public function up()
    {
        $column = [
          'email' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
            ]
          ];
        
        $this->forge->addColumn('user', $column);
    }

    public function down()
    {
        $this->forge->dropTable('email');
    }
}
