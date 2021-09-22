<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMapel extends Migration
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
            'constraint' => 100
            ],
          'tipe' => [
            'type' => 'VARCHAR',
            'constraint' => 30
            ],
          'kkm' => [
            'type' => 'INT',
            'constraint' => 3
            ],
          'created_at' => [
            'type' => 'DATETIME'
            ],
          'updated_at' => [
            'type' => 'DATETIME'
            ]
          ]);
          
        $this->forge->addKey('id', true);
        $this->forge->createTable('mapel', true);
    }

    public function down()
    {
        $this->forge->dropTable('mapel');
    }
}
