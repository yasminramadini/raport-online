<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNilai extends Migration
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
          'id_raport' => [
            'type' => 'INT',
            'constraint' => 11
            ],
          'id_mapel' => [
            'type' => 'INT',
            'constraint' => 11
            ],
          'nilai' => [
            'type' => 'INT',
            'constraint' => 3
            ]
          ]);
          
        $this->forge->addKey('id', true);
        $this->forge->createTable('nilai', true);
    }

    public function down()
    {
        $this->forge->dropTable('nilai');
    }
}
