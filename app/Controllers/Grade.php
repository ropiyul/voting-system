<?php

namespace App\Controllers;

class Grade extends BaseController
{
    protected $gradeModel;

    public function __construct()
    {
        $this->gradeModel = new \App\Models\GradeModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Service Grade',
            'grades' => $this->gradeModel->findAll(),
        ];

        return view('grades/index', $data);
    }

    public function save()
{
    $data = [
        'name' => $this->request->getPost('name')
    ];
    
    $this->gradeModel->insert($data);
    $insertedId = $this->gradeModel->insertID();
    
    $response = [
        'success' => true,
        'data' => [
            'id' => $insertedId,
            'name' => $data['name']
        ]
    ];
    
    return $this->response->setJSON($response);
}

public function update($id = null)
{
    $data = [
        'name' => $this->request->getPost('name')
    ];
    
    $this->gradeModel->update($id, $data);
    
    $response = [
        'success' => true,
        'data' => [
            'id' => $id,
            'name' => $data['name']
        ]
    ];
    
    return $this->response->setJSON($response);
}

public function delete($id)
{
    $this->gradeModel->delete($id);
    
    $response = [
        'success' => true,
        'message' => 'Data berhasil dihapus'
    ];
    
    return $this->response->setJSON($response);
}
}
