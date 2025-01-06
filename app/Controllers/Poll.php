<?php

namespace App\Controllers;

use App\Models\CandidateModel;

class Poll extends BaseController{
    protected $candidateModel;
     public function __construct() {
       $this->candidateModel = new CandidateModel();
    }

    public function index(){
        $data = [
            'candidates' => $this->candidateModel->findAll()
        ];
        return view('poll/index', $data);
    }

    public function submit(){
        $request = \Config\Services::request();
        $data = [
            'name' => $request->getPost('name'),
            'email' => $request->getPost('email'),
            'poll' => $request->getPost('poll')
        ];
        return view('poll/index', $data);
    }
}