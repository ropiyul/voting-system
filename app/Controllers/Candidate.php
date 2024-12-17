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

    public function save(){

        $validation = \Config\Services::validation();

        $validation->setRules([
            'name' => [
                'label' => 'name',
                'rules' => 'required|is_unique[candidates.name]',
                'errors' => [
                    'required' => 'Nama harus di isi',
                    'is_unique' => 'Nama Sudah terdaftar'
                ]
            ],
            'vision' => [
                'label' => 'vision',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Visi harus di isi',
                ]
            ],
            'mission' => [
                'label' => 'mission',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Misi harus di isi',
                ]
            ],
            'image' => [
                'label' => 'image',
                'rules' => 'max_size[image,2048]|is_image[image]|mime_in[image,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran {field} terlalu besar, max 2MB.',
                    'is_image' => '{field} harus berupa gambar',
                    'mime_in' =>  '{field} harus berformat png, jpg, atau jpeg.'
                ]
            ]
        ]);

        if (!$validation->run($this->request->getPost())) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            return redirect()->to('/candidate/create')->withInput()->with('errors', $validation->getErrors());
        }

        $fileImage = $this->request->getFile('image');
        if ($fileImage->getError() == 4) {
            $fileName = 'default.png';
        } else {
            $fileName = $fileImage->getRandomName();
            $fileImage->move('img', $fileName);
        }
        
        $this->candidateModel->save([
            'name' => $this->request->getPost('name'),
            'vision' => $this->request->getPost('vision'),
            'mission' => $this->request->getPost('mission'),
            'image' => $fileName,
        ]);
        
        return redirect()->to('candidate');
    }

    public function edit($id){
        $data = [
            'title' => 'Add Candidate',
            'candidate' => $this->candidateModel->where('id', $id)->first(),
        ];
        return view('candidates/edit', $data);
    }

    public function update($id){

    }

    public function delete($id){
        $this->candidateModel->delete($id);
        return redirect()->to('/candidate');
    }

}
