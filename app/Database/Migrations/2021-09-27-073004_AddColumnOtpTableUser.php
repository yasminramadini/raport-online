<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnOtpTableUser extends Migration
{
    public function up()
    {
        $column = [
          'otp' => [
            'type' => 'INT',
            'constraint' => 6,
            'unsigned' => true,
            'null' => true,
            'default' => 0
            ]
          ];
          
        $this->forge->addColumn('user', $column);
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
