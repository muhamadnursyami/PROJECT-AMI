<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KriteriaProdi extends Migration
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
            'id_kriteria' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_prodi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
                'unique' => true,
            ],
            'score' => [
                'type' => 'FLOAT',
                'default' => 0.00
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'aktif' => [
                'type' => 'BOOLEAN',
                'default' => -1,
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
        $this->forge->addForeignKey('id_kriteria', 'kriteria', 'id', 'CASCADE', 'CASCADE', 'fk_kriteriaProdi_kriteria');
        $this->forge->addForeignKey('id_prodi', 'prodi', 'id', 'CASCADE', 'CASCADE', 'fk_kriteriaProdi_prodi');
        $this->forge->createTable('kriteria_prodi');

    }

    public function down()
    {
        $this->forge->dropTable('kriteria_prodi');
    }
}
