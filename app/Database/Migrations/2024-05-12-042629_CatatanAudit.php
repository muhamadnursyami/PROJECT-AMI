<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CatatanAudit extends Migration
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
            'id_penugasan_auditor' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
                'unique' => true, 
            ],
            'catatan_audit' => [
                'type' => 'TEXT',
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
        $this->forge->addForeignKey('id_kriteria', 'kriteria_prodi', 'id', 'CASCADE', 'CASCADE', 'fk_catatanAudit_kriteriaProdi');
        $this->forge->addForeignKey('id_penugasan_auditor', 'penugasan_auditor', 'id', 'CASCADE', 'CASCADE', 'fk_catatanAudit_penugasanAuditor');
        $this->forge->createTable('catatan_audit');


    }

    public function down()
    {
        $this->forge->dropTable('catatan_audit');
    }
}
