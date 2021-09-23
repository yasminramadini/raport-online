<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSekolah extends Migration
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
          'alamat' => [
            'type' => 'TEXT'
            ],
          'logo' => [
            'type' => 'TEXT'
            ],
          'created_at' => [
            'type' => 'DATETIME'
            ],
          'updated_at' => [
            'type' => 'DATETIME'
            ]
          ]);
          
        $this->forge->addKey('id', true);
        $this->forge->createTable('sekolah', true);
    }

    public function down()
    {
        $this->forge->dropTable('sekolah');
    }
}
