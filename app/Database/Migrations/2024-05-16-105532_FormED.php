<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FormED extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
                'unique' => true,
            ],
            'id_indikator' => [
                'type' => 'INT',
                'constriant' => 11,
                'unsigned' => true,  
            ],
            'standar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'kriteria' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'capaian' => [
                'type' => 'FLOAT',
                'default' => 0.00
            ],
            'program_studi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_indikator', 'indikator_ed', 'id', 'CASCADE', 'CASCADE', 'fk_formed_indikatored');
        $this->forge->createTable('form_ed');
    }

    public function down()
    {
        $this->forge->dropTable('form_ed');
    }
}
