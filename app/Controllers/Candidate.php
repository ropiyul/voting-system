<?php

namespace App\Controllers;

use App\Models\CandidateModel;

class Candidate extends BaseController{
    protected $candidateModel;

    public function __construct(){
        $this->candidateModel = new CandidateModel();
    }

    public function index(){
        $data = [
            'title' => 'List of Candidates',
            'candidates' => $this->candidateModel->findAll(),
        ];
        return view('candidates/index', $data);
    } 
    
    public function create(){
        $data = [
            'title' => 'Add Candidate',
        ];
        return view('candidates/create', $data);
    }

    public function delete($id){
        $this->candidateModel->delete($id);
        return redirect()->to('/candidate');
    }

}
