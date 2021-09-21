<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
          'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' =>true,
            'unsigned' => true
            ],
          'nama' => [
            'type' => 'VARCHAR',
            'constraint' => 20
            ],
          'id_kelas' => [
            'type' => 'INT',
            'constraint' => 2
            ],
          'nis' => [
            'type' => 'VARCHAR',
            'constraint' => 20
            ],
          'created_at' => [
            'type' => 'DATETIME'
            ],
          'updated_at' => [
            'type' => 'DATETIME'
            ]
          ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('siswa', true);
    }

    public function down()
    {
        $this->forge->dropTable('siswa');
    }
}
