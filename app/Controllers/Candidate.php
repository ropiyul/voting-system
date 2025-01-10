<?php

namespace App\Controllers;

use App\Models\CandidateModel;
use App\Models\GradeModel;
use App\Models\ProgramModel;
use App\Models\UserModel;
use Exception;
use \Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Password;
use PHPUnit\Framework\Constraint\ExceptionMessageIsOrContains;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Candidate extends BaseController
{
    protected $candidateModel;
    protected $userModel;
    protected $auth;
    /**
     * @var AuthConfig
     */
    protected $config;
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->config = config('Auth');
        $this->auth   = service('authentication');
        $this->candidateModel = new CandidateModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'List of Candidates',
            'candidates' => $this->candidateModel->getCandidate(),
        ];
        return view('candidates/index', $data);
    }

    public function create()
    {
        $gradeModel = new GradeModel();
        $programModel = new ProgramModel();
       
        $data = [
            'title' => 'Add Candidate',
            'grades' =>  $gradeModel->findAll(),
            'programs' =>  $programModel->findAll(),
        ];
        return view('candidates/create', $data);
    }

    public function save()
    {


        $validation = \Config\Services::validation();

        // Menentukan aturan validasi
        $validation->setRules([
            'fullname' => [
                'label' => 'fullname',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap harus diisi.',
                ],
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'is_unique' => 'Username sudah terdaftar.'
                ]
            ],
            'email' => [
                'label' => 'email',
                'rules' => 'required|is_unique[users.email]',
                'errors' => [
                    'required' => 'email harus diisi.',
                    'is_unique' => 'email sudah terdaftar.'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi.',
                ]
            ],
            'grade_id' => [
                'label' => 'grade_id',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas harus diisi.',
                ]
            ],
            'program_id' => [
                'label' => 'program_id',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jurusan harus diisi.',
                ]
            ],
            'pass_confirm' => [
                'label' => 'pass_confirm',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Password harus diisi.',
                    'matches' => 'Password harus sama.'
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

        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembali dengan pesan error
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $dropzoneImage = $this->request->getPost('dropzone_image');
        if (!empty($dropzoneImage)) {
            $tempPath = WRITEPATH . 'uploads/temp/' . $dropzoneImage;
            $targetPath = 'img/' . $dropzoneImage;

            if (file_exists($tempPath)) {
                // Pindahkan file dari temporary ke folder final
                rename($tempPath, FCPATH . $targetPath);
                $fileName = $dropzoneImage;
            }
        } else {
            $fileName = 'default.png';
        }




        $this->db->transStart();
        $this->userModel->withGroup('candidate')->save([
            'username' => $this->request->getPost('username'),
            'password_hash' => Password::hash($this->request->getPost('password')),
            'email' => $this->request->getPost('email'),
            'active' => 1,
        ]);

        $this->candidateModel->save([
            'user_id' => $this->userModel->getInsertID(),
            'grade_id' => $this->request->getPost('grade_id'),
            'program_id' => $this->request->getPost('program_id'),
            'fullname' => $this->request->getPost('fullname'),
            'vision' => $this->request->getPost('vision'),
            'mission' => $this->request->getPost('mission'),
            'image' => $fileName,
        ]);
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return redirect()->back()->withInput()->with('errors', 'Data gagal disimpan.');
        }
        return redirect()->to('candidate')->with('message', 'Data berhasil disimpan.');
    }
    public function upload_temp()
    {
        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/temp', $fileName);

            return $this->response->setJSON([
                'success' => true,
                'filename' => $fileName
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'error' => 'Failed to upload file'
        ]);
    }
    public function remove_temp()
    {
       
        $filename = $this->request->getJSON()->filename; // Ambil nama file dari request
        $filepath = WRITEPATH . 'uploads/temp/' . $filename; // Tentukan path file di folder temp

        // Mengecek apakah file ada dan menghapusnya
        if (file_exists($filepath)) {
            unlink($filepath); // Menghapus file
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false, 'error' => 'File tidak ditemukan']);
    }
    public function upload()
    {
        // Menangani request file dari Dropzone
        $fileImage = $this->request->getFile('dropzone_image');

        // Cek apakah file ada dan valid
        if ($fileImage && $fileImage->isValid() && !$fileImage->hasMoved()) {
            // Menyimpan file gambar dengan nama acak di folder 'img'
            $fileName = $fileImage->getRandomName();
            $fileImage->move('img', $fileName); // Pindahkan file ke folder 'img'

            // Kirim respons JSON dengan nama file
            return $this->response->setJSON([
                'status' => 'success',
                'filename' => $fileName
            ]);
        } else {
            // Jika file tidak valid, kirim respons error
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'File tidak valid atau gagal diupload.'
            ]);
        }
    }


    public function edit($id)
    {
        $data = [
            'title' => 'Add Candidate',
            'candidate' => $this->candidateModel->getCandidate($id),
        ];

        return view('candidates/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        // Menentukan aturan validasi
        $validation->setRules([
            'fullname' => [
                'label' => 'fullname',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap harus diisi.',
                ],
            ],
            // 'username' => [
            //     'label' => 'Username',
            //     'rules' => "required|is_unique[users.username,users.id,{id}]",
            //     'errors' => [
            //         'required' => 'Username harus diisi.',
            //         'is_unique' => 'Username sudah terdaftar.'
            //     ]
            // ],
            // 'email' => [
            //     'label' => 'email',
            //     'rules' => "required|is_unique[users.email,users.id,{id}]",
            //     'errors' => [
            //         'required' => 'email harus diisi.',
            //         'is_unique' => 'email sudah terdaftar.'
            //     ]
            // ],
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
                'rules' => 'max_size[image,3048]|is_image[image]|mime_in[image,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran {field} terlalu besar, max 3MB.',
                    'is_image' => '{field} harus berupa gambar',
                    'mime_in' =>  '{field} harus berformat png, jpg, atau jpeg.'
                ]
            ],
        ]);

        // Menjalankan validasi
        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembali dengan pesan error
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }


        $dropzoneImage = $this->request->getPost('dropzone_image');

        if (!$dropzoneImage->getError() == 4):

            $dropzoneImage = $this->request->getPost('dropzone_image');
            if (!empty($dropzoneImage)) {
                $tempPath = WRITEPATH . 'uploads/temp/' . $dropzoneImage;
                $targetPath = 'img/' . $dropzoneImage;
    
                if (file_exists($tempPath)) {
                    // Pindahkan file dari temporary ke folder final
                    rename($tempPath, FCPATH . $targetPath);
                    $fileName = $dropzoneImage;
                }
            } else {
                $fileName = 'default.png';
            }

            $this->db->transStart();
            $this->userModel->save([
                'id' => $this->request->getPost('user_id'),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
            ]);

            $this->candidateModel->save([
                'id' => $id,
                'fullname' => $this->request->getPost('fullname'),
                'vision' => $this->request->getPost('vision'),
                'mission' => $this->request->getPost('mission'),
                'image' => $fileName,
            ]);
            $this->db->transComplete();
        else:
            $this->db->transStart();
            $this->userModel->save([
                'id' => $this->request->getPost('user_id'),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
            ]);

            $this->candidateModel->save([
                'id' => $id,
                'fullname' => $this->request->getPost('fullname'),
                'vision' => $this->request->getPost('vision'),
                'mission' => $this->request->getPost('mission'),
            ]);
            $this->db->transComplete();

        endif;

        if ($this->db->transStatus() === false) {
            return redirect()->back()->withInput()->with('errors', 'Data gagal disimpan.');
        }
        return redirect()->to('candidate')->with('message', 'Data berhasil disimpan.');
    }

    public function delete($id)
    {

        $candidate = $this->candidateModel->find($id);
        if ($candidate['image'] != 'default.png') {
            unlink('img/' . $candidate['image']);
        }
        $this->candidateModel->delete($id);
        return redirect()->to('/candidate');
    }
    
    public function export_excel()
{

    $candidates = $this->candidateModel->getCandidate();


    // $user = $this->userModel->('candidate')->findAll();

    

    if (!$candidates) {
        return redirect()->back()->with('error', 'Data tidak ditemukan!');
    }

    // Load library PhpSpreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header kolom
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Nama');
    $sheet->setCellValue('C1', 'Username');
    $sheet->setCellValue('D1', 'Visi');
    $sheet->setCellValue('E1', 'Misi');

    // Isi data kandidat
    $rowNumber = 2; // Dimulai dari baris kedua
    foreach ($candidates as $index => $candidate) {
        $sheet->setCellValue('A' . $rowNumber, $index + 1);
        $sheet->setCellValue('B' . $rowNumber, $candidate['fullname']);
        $sheet->setCellValue('C' . $rowNumber, $candidate['username']);
        $sheet->setCellValue('D' . $rowNumber, $candidate['vision']);
        $sheet->setCellValue('E' . $rowNumber, $candidate['mission']);
        $rowNumber++;
    }

    // Nama file
    $filename = 'All_Candidates_' . date('Y-m-d_H-i-s') . '.xlsx';

    // Download file
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit;
}

}
