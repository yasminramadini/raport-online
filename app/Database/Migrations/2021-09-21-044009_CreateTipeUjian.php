<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTipeUjian extends Migration
{
    public function up()
    {
        $this->forge->addField([
          'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' => true,
            'unsigned' => true
            ],
          'nama' => [
            'type' => 'VARCHAR',
            'constraint' => 50
            ],
          'created_at' => [
            'type' => 'DATETIME'
            ],
          'updated_at' => [
            'type' => 'DATETIME'
            ]
          ]);
          
        $this->forge->addKey('id', true);
        $this->forge->createTable('tipe_ujian', true);
    }

    public function down()
    {
        $this->forge->dropTable('tipe_ujian');
    }
}
