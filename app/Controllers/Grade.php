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
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name' => [
                'label' => 'name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Name must be filled',
                ],
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('grade/create')->withInput()->with('errors', $validation->getErrors());
        }

        $this->gradeModel->save([
            'name' => $this->request->getPost('name'),
        ]);
        return redirect()->to('grade')->with('success', 'Grade created successfully');
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name' => [
                'label' => 'name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Name must be filled',
                ],
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('grade/edit/' . $id)->withInput()->with('errors', $validation->getErrors());
        }

        $this->gradeModel->save([
            'id' => $id,
            'name' => $this->request->getPost('name'),
        ]);
        return redirect()->to('grade')->with('success', 'Grade updated successfully');
    }

    public function delete($id)
    {
        $this->gradeModel->delete($id);
        return redirect()->to('grade')->with('success', 'Grade deleted successfully');
    }
}
