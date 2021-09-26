<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRaport extends Migration
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
          'id_siswa' => [
            'type' => 'INT',
            'constraint' => 11
            ],
          'id_ujian' => [
            'type' => 'INT',
            'constraint' => 11
            ],
          'nama_file' => [
            'type' => 'VARCHAR',
            'constraint' => 255
            ],
          'thn_pelajaran' => [
            'type' => 'VARCHAR',
            'constraint' => 20
            ],
          'sakit' => [
            'type' => 'INT',
            'constraint' => 3,
            'null' => true
            ],
          'izin' => [
            'type' => 'INT',
            'constraint' => 3,
            'null' => true
            ],
          'alfa' => [
            'type' => 'INT',
            'constraint' => 3,
            'null' => true
            ],
          'catatan' => [
            'type' => 'TEXT',
            'null' => true
          ],
          'created_at' => [
            'type' => 'DATETIME'
            ],
          'updated_at' => [
            'type' => 'DATETIME'
            ]
          ]);
          
        $this->forge->addKey('id', true);
        $this->forge->createTable('raport', true);
    }

    public function down()
    {
        $this->forge->dropTable('raport');
    }
}
