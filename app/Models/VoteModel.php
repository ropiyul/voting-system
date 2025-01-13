<?php

namespace App\Models;

use CodeIgniter\Model;

class VoteModel extends Model
{
    protected $table = 'votes';
    protected $allowedFields = ['candidate_id', 'voter_id', 'voted_at'];

    public function getVoteCountByCandidate($gradeId = 'all')
    {
        try {
            $builder = $this->db->table('votes')
                ->select('candidates.id, candidates.fullname as name, COUNT(votes.id) as vote_count')
                ->join('candidates', 'candidates.id = votes.candidate_id')
                ->join('voters', 'voters.id = votes.voter_id');

            if ($gradeId !== 'all') {
                $builder->where('voters.grade_id', $gradeId);
            }

            $result = $builder->groupBy('candidates.id')
                ->orderBy('vote_count', 'DESC')
                ->get()
                ->getResultArray();

            // Debug
            log_message('debug', 'Candidate stats query result: ' . json_encode($result));

            return $result;
        } catch (\Exception $e) {
            log_message('error', 'Error in getVoteCountByCandidate: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getVotingStatistics()
    {
        // Hitung total user
        $totalUsers = $this->db->table('voters')->countAllResults();

        // Hitung yang sudah vote
        $votedCount = $this->countAllResults();

        // Hitung yang belum vote
        $notVotedCount = $totalUsers - $votedCount;

        return [
            'total_users' => $totalUsers,
            'voted' => $votedCount,
            'not_voted' => $notVotedCount,
            'voted_percentage' => ($totalUsers > 0) ? round(($votedCount / $totalUsers) * 100, 2) : 0,
            'not_voted_percentage' => ($totalUsers > 0) ? round(($notVotedCount / $totalUsers) * 100, 2) : 0
        ];
    }

    public function getVotingStatisticsByGrade($gradeId = 'all')
    {
        try {
            // Jika memilih grade spesifik
            if ($gradeId !== 'all') {
                // Hitung total siswa untuk grade tertentu
                $totalStudents = $this->db->table('voters')
                    ->where('grade_id', $gradeId)
                    ->countAllResults();

                // Hitung yang sudah vote untuk grade tertentu
                $votedCount = $this->db->table('votes')
                    ->join('voters', 'voters.id = votes.voter_id')
                    ->where('voters.grade_id', $gradeId)
                    ->countAllResults();

                // Hitung yang belum vote
                $notVotedCount = $totalStudents - $votedCount;
            } else {
                // Hitung total siswa
                $totalStudents = $this->db->table('voters')->countAllResults();

                // Hitung yang sudah vote
                $votedCount = $this->db->table('votes')->countAllResults();

                // Hitung yang belum vote
                $notVotedCount = $totalStudents - $votedCount;
            }

            return [
                'total_users' => $totalStudents,
                'voted' => $votedCount,
                'not_voted' => $notVotedCount
            ];
        } catch (\Exception $e) {
            log_message('error', 'woilahh ' . $e->getMessage());
            throw $e;
        }
    }

    public function getVotedUsers()
    {
        return $this->select('users.*, votes.voted_at')
            ->join('users', 'users.id = votes.voter_id')
            ->get()
            ->getResultArray();
    }

    // Mendapatkan user yang belum vote
    public function getNotVotedUsers()
    {
        return $this->db->table('users')
            ->whereNotIn('id', function ($builder) {
                $builder->select('voter_id')->from('votes');
            })
            ->get()
            ->getResultArray();
    }

    // Cek apakah user sudah vote
    public function hasVoted($userId)
    {
        return $this->where('voter_id', $userId)->countAllResults() > 0;
    }
}
