<?php

namespace App\Models;

use CodeIgniter\Model;

class CandidateModel extends Model
{
    protected $table = 'candidates';
    protected $allowedFields = ['fullname', 'user_id', 'grade_id', 'program_id', 'vision', 'mission', 'image'];


    public function getCandidate($id = null)
    {
        if ($id) {
            return $this->select('candidates.*, users.username, users.email, users.active, , grades.name as grade,')
                ->join('users', 'candidates.user_id = users.id')
                ->join('grades', 'candidates.grade_id = grades.id')
                ->where('candidates.id', $id)
                ->first();
        } else {
            return $this->select('candidates.*, users.username, users.email, users.active, , grades.name as grade,')
                ->join('users', 'candidates.user_id = users.id')
                ->join('grades', 'candidates.grade_id = grades.id')
                ->findAll();
        }
    }

    public function getCandidatesByGrade($gradeId = 'all')
    {
        $builder = $this->select('candidates.*, users.username, users.email, grades.name as grade, 
                              (SELECT COUNT(*) FROM votes WHERE votes.candidate_id = candidates.id) as vote_count')
            ->join('users', 'candidates.user_id = users.id')
            ->join('grades', 'candidates.grade_id = grades.id');

        if ($gradeId !== 'all') {
            $builder->where('candidates.grade_id', $gradeId);
        }

        $builder->orderBy('vote_count', 'DESC');

        return $builder->findAll();
    }
}
