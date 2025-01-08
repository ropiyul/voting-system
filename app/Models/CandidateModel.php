<?php

namespace App\Models;
use CodeIgniter\Model;

class CandidateModel extends Model{
    protected $table = 'candidates';
    protected $allowedFields = ['fullname', 'user_id','grade_id','program_id', 'vision', 'mission', 'image'];


    public function getCandidate($id = null)
    {
        if ($id) {
            return $this->select('candidates.*, users.username, users.email, users.active, , grades.name as grade, programs.name as program')
                ->join('users', 'candidates.user_id = users.id')
                ->join('grades', 'candidates.grade_id = grades.id')
                ->join('programs', 'candidates.program_id = programs.id')
                ->where('candidates.id', $id)
                ->first();
        } else {
            return $this->select('candidates.*, users.username, users.email, users.active, , grades.name as grade, programs.name as program')
                ->join('users', 'candidates.user_id = users.id')
                ->join('grades', 'candidates.grade_id = grades.id')
                ->join('programs', 'candidates.program_id = programs.id')
                ->findAll();
        }
    }
}

