<?php

namespace App\Models;
use CodeIgniter\Model;

class CandidateModel extends Model{
    protected $table = 'candidates';
    protected $allowedFields = ['fullname', 'user_id', 'vision', 'mission', 'image'];


    public function getCandidate($id = null)
    {
        if ($id) {
            return $this->select('candidates.*, users.username, users.email, users.active')
                ->join('users', 'candidates.user_id = users.id')
                ->where('candidates.id', $id)
                ->first();
        } else {
            return $this->select('candidates.*, users.username, users.email, users.active')
                ->join('users', 'candidates.user_id = users.id')
                ->findAll();
        }
    }
}

