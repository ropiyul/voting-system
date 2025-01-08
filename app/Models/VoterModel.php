<?php

namespace App\Models;

use CodeIgniter\Model;

class VoterModel extends Model
{
    protected $table = 'voters';
    protected $allowedFields = ['nis', 'fullname', 'grade_id', 'program_id', 'user_id'];

    public function getVoter($id = null)
    {
        if ($id) {
            return $this->select('voters.*, users.username, users.email, users.active, grades.name as grade, programs.name as program' )
                ->join('users', 'voters.user_id = users.id')
                ->join('grades', 'voters.grade_id = grades.id')
                ->join('programs', 'voters.program_id = programs.id')
                ->where('voters.id', $id)
                ->first();
        } else {
            return $this->select('voters.*, users.username, users.email, users.active, grades.name as grade, programs.name as program')
                ->join('users', 'voters.user_id = users.id')
                ->join('grades', 'voters.grade_id = grades.id')
                ->join('programs', 'voters.program_id = programs.id')
                ->findAll();
        }
    }
}
