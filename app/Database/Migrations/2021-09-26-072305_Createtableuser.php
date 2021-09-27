<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createtableuser extends Migration
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
          'username' => [
            'type' => 'VARCHAR',
            'constraint' => 10
            ],
          'password' => [
            'type' => 'TEXT'
            ],
          'role' => [
            'type' => 'INT',
            'constraint' => 1
            ]
          ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('user', true);
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
