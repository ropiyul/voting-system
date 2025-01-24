<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CandidateModel;
use App\Models\VoteModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use Exception;

class ApiVoting extends ResourceController
{
    use ResponseTrait;

    protected $candidateModel;
    protected $voteModel;
    protected $userModel;
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->candidateModel = new CandidateModel();
        $this->voteModel = new VoteModel();
        $this->userModel = new UserModel();
    }


    public function getCandidates()
    {
        try {
            $candidates = $this->candidateModel->select('id, fullname, vision, mission, image')
                ->findAll();
            if (!$candidates) {
                return $this->respond([
                    'status' => false,
                    'message' => 'No candidates available',
                    'data' => []
                ], 404);
            }

            // Transform image URLs to full paths
            foreach ($candidates as &$candidate) {
                $candidate['image'] = base_url('img/' . $candidate['image']);
            }

            return $this->respond([
                'status' => true,
                'message' => 'Candidates retrieved successfully',
                'data' => $candidates
            ], 200);
        } catch (Exception $e) {
            return $this->respond([
                'status' => false,
                'message' => 'Failed to retrieve candidates',
                'data' => null
            ], 500);
        }
    }

    public function submitVote()
    {
        try {
            // Validate request
            $rules = [
                'user_id' => 'required|numeric',
                'candidate_id' => 'required|numeric'
            ];

            if (!$this->validate($rules)) {
                return $this->respond([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $this->validator->getErrors()
                ], 400);
            }

            $userId = $this->request->getPost('user_id');
            $candidateId = $this->request->getPost('candidate_id');

            // user ada
            $user = $this->userModel->find($userId);
            if (!$user) {
                return $this->respond([
                    'status' => false,
                    'message' => 'User not found',
                    'data' => null
                ], 404);
            }

            // apakah ada kandidatat
            $candidate = $this->candidateModel->find($candidateId);
            if (!$candidate) {
                return $this->respond([
                    'status' => false,
                    'message' => 'Candidate not found',
                    'data' => null
                ], 404);
            }

            // ccek kandidat sudah login atau belum
            $existingVote = $this->voteModel->where('user_id', $userId)->first();
            if ($existingVote) {
                return $this->respond([
                    'status' => false,
                    'message' => 'User has already voted',
                    'data' => null
                ], 400);
            }

            $this->db->transStart();

            $this->voteModel->insert([
                'user_id' => $userId,
                'candidate_id' => $candidateId,
                'voted_at' => date('Y-m-d H:i:s')
            ]);

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                return $this->respond([
                    'status' => false,
                    'message' => 'Failed to submit vote',
                    'data' => null
                ], 500);
            }

            return $this->respond([
                'status' => true,
                'message' => 'Vote submitted successfully',
                'data' => [
                    'user_id' => $userId,
                    'candidate_id' => $candidateId,
                    'voted_at' => date('Y-m-d H:i:s')
                ]
            ], 201);
        } catch (Exception $e) {
            return $this->respond([
                'status' => false,
                'message' => 'Failed to submit vote: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function checkVoteStatus($userId)
    {
        try {
            $vote = $this->voteModel->where('user_id', $userId)->first();

            return $this->respond([
                'status' => true,
                'message' => 'Vote status retrieved successfully',
                'data' => [
                    'has_voted' => $vote !== null,
                    'vote_details' => $vote
                ]
            ], 200);
        } catch (Exception $e) {
            return $this->respond([
                'status' => false,
                'message' => 'Failed to check vote status',
                'data' => null
            ], 500);
        }
    }
}
