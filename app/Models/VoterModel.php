<?php

namespace App\Models;

use CodeIgniter\Model;

class VoterModel extends Model
{
    protected $table = 'voters';
    protected $allowedFields = ['nis', 'fullname', 'user_id'];

    public function getVoter($id = null)
    {
        if ($id) {
            return $this->select('voters.*, users.username, users.email, users.active')
                ->join('users', 'voters.user_id = users.id')
                ->where('voters.id', $id)
                ->first();
        } else {
            return $this->select('voters.*, users.username, users.email, users.active')
                ->join('users', 'voters.user_id = users.id')
                ->findAll();
        }
    }
}
