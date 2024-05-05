<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => '40',
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',

            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'auditor', 'auditi', 'pimpinan'],
            ]
        ]);

        // Primary Key nya adalah Id
        $this->forge->addKey('id', true);
        // Nama tabelnya adalah users
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
