<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FormEd extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
                'unique' => true,
            ],
            'id_jadwal_periode_ed' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'deskripsi' => [
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
        $this->forge->addForeignKey('id_jadwal_periode_ed', 'jadwal_periode_ed', 'id', 'CASCADE', 'CASCADE', 'fk_formED_jadwalPeriodeED');
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE', 'fk_formED_usersAuditor');
        $this->forge->createTable('form_ed');


    }

    public function down()
    {
        $this->forge->dropTable('form_ed');
    }
}
