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
                'description' => 'Group for admin in the voting system',
            ],
            [
                'name' => 'candidate',
                'description' => 'Group for candidate in the voting system',
            ],
            [
                'name' => 'voter',
                'description' => 'Group for voter in the voting system',
            ],
            

        ];

        // Insert data ke tabel auth_groups
        $this->db->table('auth_groups')->insertBatch($data);
    }
}
