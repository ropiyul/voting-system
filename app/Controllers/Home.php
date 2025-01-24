<?php

namespace App\Controllers;

use App\Models\CandidateModel;
use App\Models\GradeModel;
use App\Models\VoteModel;

class Home extends BaseController
{

    protected $db;
    protected $voteModel;

    public function __construct()
    {
        $this->voteModel = new VoteModel();
        $this->db = \Config\Database::connect();
    }
    public function index(): string
    {
        $data = [
            'title' => 'Home',
        ];
        return view('dashboard/index', $data);
    }
    public function dashboard()
    {
        $gradeModel = new GradeModel();
        $voteModel = new VoteModel();
        $candidateModel = new CandidateModel();

        // Pastikan statistik memiliki semua key yang diperlukan
        $statistics = $voteModel->getVotingStatisticsByGrade();
        $allCount =$voteModel->getVoteCountByCandidate();
        $allCandidates = $candidateModel->getCandidatesByGrade();
        session()->set('selected_grade', 'all');
        $data = [
            'title' => 'Dashboard',
            'grades' => $gradeModel->findAll(),
            'candidates' => $allCandidates,
            'allCount' => $allCount,
            'statistics' => $voteModel->getVotingStatistics(),
            'statisticByGrade' => [
                'total_users' => $statistics['total_users'] ?? 0,
                'voted' => $statistics['voted'] ?? 0,
                'not_voted' => $statistics['not_voted'] ?? 0,
            ]
        ];

        return view('dashboard/index', $data);
    }

    public function getStatisticsByGrade($gradeId = null)
    {
        try {
            $statistics = $this->voteModel->getVotingStatisticsByGrade($gradeId);
            $candidateStats = $this->voteModel->getVoteCountByCandidate($gradeId);

            return $this->response->setJSON([
                'success' => true,
                'statistics' => $statistics,
                'candidates' => $candidateStats
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    public function getDataCandidatesByGrade($gradeId = null)
    {
        $candidateModel = new CandidateModel();
        try {
            $allCandidates = $candidateModel->getCandidatesByGrade();

            return $this->response->setJSON([
                'success' => true,
                'candidates' => $allCandidates
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}


    // public function getStatisticsByGrade($gradeId = null)
    // {
    //     $voteModel = new VoteModel();
    //     try {
    //         $statistics = $voteModel->getVotingStatisticsByGrade($gradeId);
            
    //         return $this->response->setJSON($statistics);
    //     } catch (\Exception $e) {
    //         return $this->response->setJSON([
    //             'error' => true,
    //             'message' => 'Terjadi kesalahan: ' . $e->getMessage()
    //         ])->setStatusCode(500);
    //     }
    // }