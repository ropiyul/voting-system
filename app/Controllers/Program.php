<?php

namespace App\Controllers;

class Program extends BaseController
{
    protected $programModel;

    public function __construct()
    {
        $this->programModel = new \App\Models\ProgramModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Service Program',
            'programs' => $this->programModel->findAll(),
        ];

        return view('programs/index', $data);
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
            return redirect()->to('program/create')->withInput()->with('errors', $validation->getErrors());
        }

        $this->programModel->save([
            'name' => $this->request->getPost('name'),
        ]);
        return redirect()->to('program')->with('success', 'Program created successfully');
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
            return redirect()->to('program/edit/' . $id)->withInput()->with('errors', $validation->getErrors());
        }

        $this->programModel->save([
            'id' => $id,
            'name' => $this->request->getPost('name'),
        ]);
        return redirect()->to('program')->with('success', 'Program updated successfully');
    }

    public function delete($id)
    {
        $this->programModel->delete($id);
        return redirect()->to('program')->with('success', 'Program deleted successfully');
    }
}
