<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $authorize = service('authorization');

        // Membuat permission
        $authorize->createPermission('manageUsers', 'Mengelola pengguna dalam sistem');
        $authorize->createPermission('manageCandidates', 'Mengelola data kandidat');
        $authorize->createPermission('manageVotes', 'Mengelola dan melihat hasil pemungutan suara');
        $authorize->createPermission('viewReports', 'Melihat laporan pemungutan suara');
        $authorize->createPermission('vote', 'Memberikan suara kepada kandidat');
        $authorize->createPermission('viewCandidates', 'Melihat daftar kandidat yang tersedia');
        $authorize->createPermission('viewVoteStatus', 'Melihat status pemungutan suara yang telah dilakukan');
        $authorize->createPermission('viewMyVotes', 'Melihat suara yang diterima oleh kandidat');
        $authorize->createPermission('updateProfile', 'Memperbarui profil kandidat');
    }

}
