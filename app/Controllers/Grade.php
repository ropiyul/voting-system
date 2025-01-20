<?php

namespace App\Controllers;

class Grade extends BaseController
{
    protected $gradeModel;
    protected $db;

    public function __construct()
    {
        $this->gradeModel = new \App\Models\GradeModel();
        $this->db = \Config\Database::connect();
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
        'file_excel' => [ 
            'label' => 'File Excel', 
            'rules' => 'uploaded[file_excel]|max_size[file_excel,10240]|mime_in[file_excel,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
            'errors' => [
                'uploaded' => 'Harus upload {field} *',
                'max_size' => 'File maksimal 10MB *',
                'mime_in' => 'Harus berupa file Excel (xls atau xlsx) *',
            ],
        ],
    ];

    if (!$this->validate($rules)) {
        session()->setFlashdata('warning', 'Periksa kembali, terdapat beberapa kesalahan yang perlu diperbaiki.');
        session()->setFlashdata('modal_id', 'importExcelModal'); 

        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $file = $this->request->getFile('file_excel'); 
    $extension = $file->getClientExtension();

    try {
        // Create reader based on file extension
        $reader = match ($extension) {
            'xls' => new \PhpOffice\PhpSpreadsheet\Reader\Xls(),
            'xlsx' => new \PhpOffice\PhpSpreadsheet\Reader\Xlsx(),
            default => throw new \Exception('Unsupported file format'),
        };

        $spreadsheet = $reader->load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $grades = $worksheet->toArray();
        
        // Start database transaction
        $this->db->transStart();
        
        $successCount = 0;
        $errors = [];

        foreach ($grades as $key => $value) {
            if ($key == 0) {
                continue; // skip header row
            }

            // Validate and sanitize data
            $data = [
                'name' => trim($value[0] ?? ''),
            ];

            if (empty($data['name'])) {
                $errors[] = "Baris " . ($key + 1) . ": Nama tidak boleh kosong";
                continue;
            }

            try {
                $this->gradeModel->save($data);
                $successCount++;
            } catch (\Exception $e) {
                $errors[] = "Baris " . ($key + 1) . ": " . $e->getMessage();
            }
        }

        if (empty($errors)) {
            $this->db->transCommit();
            session()->setFlashdata('message', "Berhasil mengimpor $successCount data kelas!");
            return redirect()->to('/grade');
        } else {
            $this->db->transRollback();
            session()->setFlashdata('errors', $errors);
            session()->setFlashdata('warning', 'Terdapat kesalahan dalam proses import.');
            return redirect()->back()->withInput();
        }

    } catch (\Exception $e) {
        if (isset($this->db) && $this->db->transStatus() === false) {
            $this->db->transRollback();
        }
        session()->setFlashdata('warning', 'Terjadi kesalahan saat memproses file: ' . $e->getMessage());
        return redirect()->back()->withInput();
    }
}

}
