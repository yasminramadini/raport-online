<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnKepsekTableSekolah extends Migration
{
    public function up()
    {
        $column = [
          'kepsek' => [
            'type' => 'VARCHAR',
            'constraint' => '50',
            'null' => true,
            'after' => 'nama'
            ]
          ];
        
        $this->forge->addColumn('sekolah',$column);
    }

    public function down()
    {
        $this->forge->dropColumn('sekolah', 'kepsek');
    }
}
