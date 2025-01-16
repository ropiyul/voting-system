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

        $data = [
            'title' => 'Add Candidate',
            'grades' =>  $gradeModel->findAll(),
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
            'image' => [
                'label' => 'image',
                'rules' => 'max_size[image,5108]|is_image[image]|mime_in[image,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran {field} terlalu besar, max 5MB.',
                    'is_image' => '{field} harus berupa gambar',
                    'mime_in' =>  '{field} harus berformat png, jpg, atau jpeg.'
                ]
            ],
        ]);
        $tes = $this->request->getFile('image');
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->db->transStart();
        $image = $this->request->getFile('image');
        if ($image->isValid()) {
            $filename = $image->getRandomName();
            $image->move('img/', $filename);
        }


        $email = mt_rand(10000, 1000000) . '@gmail.com';
        $this->userModel->withGroup('candidate')->save([
            'username' => $this->request->getPost('username'),
            'password_hash' => Password::hash($this->request->getPost('password')),
            'email' => $email,
            'active' => 1,
        ]);

        $this->candidateModel->save([
            'user_id' => $this->userModel->getInsertID(),
            'grade_id' => $this->request->getPost('grade_id'),
            'fullname' => $this->request->getPost('fullname'),
            'vision' => $this->request->getPost('vision'),
            'mission' => $this->request->getPost('mission'),
            'image' => $filename,
        ]);
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return redirect()->back()->withInput()->with('errors', 'Data gagal disimpan.');
        }
        return redirect()->to('candidate')->with('message', 'Data berhasil disimpan.');
    }



    public function edit($id)
    {


        $gradeModel = new GradeModel();
        $data = [
            'title' => 'Add Candidate',
            'candidate' => $this->candidateModel->getCandidate($id),
            'grades' =>  $gradeModel->findAll(),
        ];

        return view('candidates/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();


        $data = [
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
        ];
        if (!$this->request->getPost('image') && $this->request->getFile('image')):
            $data['image'] = [
                    'label' => 'image',
                    'rules' => 'uploaded[image]|max_size[image,5108]|is_image[image]|mime_in[image,image/png,image/jpg,image/jpeg]',
                    'errors' => [
                        'uploaded' => '{field} harus diisi.',
                        'max_size' => 'Ukuran {field} terlalu besar, max 5MB.',
                        'is_image' => '{field} harus berupa gambar',
                        'mime_in' =>  '{field} harus berformat png, jpg, atau jpeg.'
                    ]
            ];
        endif;
        // Menentukan aturan validasi
        $validation->setRules($data);


        // Menjalankan validasi
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }



        $oldImage = $this->request->getPost('oldImage');
        $image = $this->request->getFile('image');
        if ($image && $image->isValid()):
            $this->db->transStart();
            if (!$image->hasMoved()) {
                $filename = $image->getRandomName();
                $image->move('img/', $filename);
            }        

            if (!empty($oldImage) && file_exists('img/' . $oldImage)) {
                unlink('img/' . $oldImage);
            }
        

            $email = mt_rand(10000, 1000000) . '@gmail.com';
            $this->userModel->save([
                'id' => $this->request->getPost('user_id'),
                'username' => $this->request->getPost('username'),
                'email' => $email,
            ]);

            $this->candidateModel->save([
                'id' => $id,
                'grade_id' => $this->request->getPost('grade_id'),
                'fullname' => $this->request->getPost('fullname'),
                'vision' => $this->request->getPost('vision'),
                'mission' => $this->request->getPost('mission'),
                'image' => $filename,
            ]);
            $this->db->transComplete();
        else:
            $this->db->transStart();
            $this->userModel->save([
                'id' => $this->request->getPost('user_id'),
                'username' => $this->request->getPost('username'),
            ]);

            $this->candidateModel->save([
                'id' => $id,
                'grade_id' => $this->request->getPost('grade_id'),
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
