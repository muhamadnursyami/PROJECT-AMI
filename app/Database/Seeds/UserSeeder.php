<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // buat admin
        // password admin (passwordnya 123)
        $this->db->table('users')->insert([
            'uuid' => service('uuid')->uuid4()->toString(),
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => password_hash('123', PASSWORD_BCRYPT),
            'role' => 'admin'
        ]);

        // buat auditi
        // passwordnya 123
        $this->db->table('users')->insert([
            'uuid' => service('uuid')->uuid4()->toString(),
            'name' => 'auditi',
            'email' => 'auditi@gmail.com',
            'password' => password_hash('123', PASSWORD_BCRYPT),
            'role' => 'auditi',
            'prodi' => "Teknik Informatika"
        ]);
        

        // buat auditor
        // passwordnya 123
        $this->db->table('users')->insert([
            'uuid' => service('uuid')->uuid4()->toString(),
            'name' => 'auditor',
            'email' => 'auditor@gmail.com',
            'password' => password_hash('123', PASSWORD_BCRYPT),
            'role' => 'auditor'
        ]);

        // buat prodinya auditor
        // {belum dibuat}

        // buat pimpinan
        // passwordnya 123
        $this->db->table('users')->insert([
            'uuid' => service('uuid')->uuid4()->toString(),
            'name' => 'pimpinan',
            'email' => 'pimpinan@gmail.com',
            'password' => password_hash('123', PASSWORD_BCRYPT),
            'role' => 'pimpinan'
        ]);
        
    }
}
