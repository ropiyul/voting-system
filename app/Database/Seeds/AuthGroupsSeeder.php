<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthGroupsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'admin',
                'description' => 'Group for admin',
            ],
            [
                'name' => 'candidate',
                'description' => 'Group for candidate',
            ],
            [
                'name' => 'voter',
                'description' => 'Group for voter',
            ],
        ];

        // Insert data ke tabel auth_groups
        $this->db->table('auth_groups')->insertBatch($data);
    }
}
