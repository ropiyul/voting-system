<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GroupPermissionSeeder extends Seeder
{
    public function run()
    {
        $authorize = service('authorization');
        $authorize->addPermissionToGroup('manageUsers', 'admin');
        $authorize->addPermissionToGroup('manageCandidates', 'admin');
        $authorize->addPermissionToGroup('manageVotes', 'admin');
        $authorize->addPermissionToGroup('viewReports', 'admin');

        $authorize->addPermissionToGroup('vote', 'voter');
        $authorize->addPermissionToGroup('viewCandidates', 'voter');
        $authorize->addPermissionToGroup('viewVoteStatus', 'voter');
    }
}
