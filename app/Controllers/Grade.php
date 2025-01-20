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

public function import_excel()
    {
        $rules = [
            'file_exel' => [
                'label' => 'File Exel',
                'rules' => 'uploaded[file_exel]|max_size[file_exel,10240]|mime_in[file_exel,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                'errors' => [
                    'uploaded' => 'Harus upload {field} *',
                    'max_size' => 'File maksimal 10MB *',
                    'mime_in' => 'Harus berupa file Excel (xls atau xlsx) *',
                ],
            ],
        ];
    
        if (!$this->validate($rules)) {
            session()->setFlashdata('warning', 'Periksa kembali, terdapat beberapa kesalahan yang perlu diperbaiki.');
            session()->setFlashdata('modal_id', 'importExelModal');
    
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $file = $this->request->getFile('file_exel');
        $extension = $file->getClientExtension();
        try {
            if ($extension == 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
    
            $spreadsheet = $reader->load($file);
            $candidates = $spreadsheet->getActiveSheet()->toArray();
    
            foreach ($candidates as $key => $value) {
                if ($key == 0) {
                    continue; // skip header row
                }
    
                // Validate data before saving to database
                $data = [
                    'name'    => $value[0] ?? '',
                ];
    
                if ($data['Nama'])  {
                    $this->candidate->save($data);
                } else {
                    // Handle case where data is incomplete
                    session()->setFlashdata('error', 'Data tidak lengkap pada baris ' . ($key + 1));
                    return redirect()->back()->withInput();
                }
            }
    
            session()->setFlashdata('pesan', 'Kandidat berhasil ditambahkan!');
            return redirect()->to('/grade');
        } catch (\Exception $e) {
            session()->setFlashdata('warning', 'Terjadi kesalahan saat memproses file: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

}
