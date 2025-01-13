<?php

namespace App\Controllers;

use App\Models\GradeModel;
use App\Models\ProgramModel;
use App\Models\VoterModel;
use App\Models\UserModel;
use \Myth\Auth\Entities\User;
use \Myth\Auth\Authorization\GroupModel;
use \Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Config\Services;
use Myth\Auth\Password;

class Voter extends BaseController
{

    protected $voterModel;
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
        $this->voterModel = new VoterModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'List of voter',
            'voters' => $this->voterModel->getVoter(),
        ];
        return view('voters/index', $data);
    }

    public function create()
    {
        $gradeModel = new GradeModel();

        $data = [
            'title' => 'Add voter',
            'grades' =>  $gradeModel->findAll(),
        ];
        return view('voters/create', $data);
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
            'grade_id' => [
                'label' => 'grade_id',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas harus diisi.',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi.',
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
        ]);

        // Menjalankan validasi
        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembali dengan pesan error
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->db->transStart();
        $email = mt_rand(10000, 1000000) . '@gmail.com';
        $saveUser = $this->userModel->withGroup('voter')->save([
            'username' => $this->request->getVar('username'),
            'password_hash' => Password::hash($this->request->getVar('password')),
            'email' => $email,
            'active' => 1,
        ]);

        $savevoter = $this->voterModel->save([
            'user_id' => $this->userModel->getInsertID(),
            'grade_id' => $this->request->getPost('grade_id'),
            'fullname' => $this->request->getPost('fullname'),
        ]);
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return redirect()->back()->withInput()->with('errors', 'Data gagal disimpan.');
        }
        return redirect()->to('voter')->with('message', 'Data berhasil disimpan.');
    }


    public function edit($id)
    {

        $gradeModel = new GradeModel();
        $data = [
            'title' => 'Edit voter',
            'voter' => $this->voterModel->getVoter($id),
            'grades' =>  $gradeModel->findAll(),
        ];
        return view('voters/edit', $data);
    }

    public function update($voterId)
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
        ]);

        // Menjalankan validasi
        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembali dengan pesan error
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->db->transStart();
        $email = mt_rand(10000, 1000000) . '@gmail.com';
        $saveUser = $this->userModel->save([
            'id' => $this->request->getPost('user_id'),
            'username' => $this->request->getPost('username'),
            'email' => $email,
        ]);

        $savevoter = $this->voterModel->save([
            'id' => $voterId,
            'fullname' => $this->request->getPost('fullname'),
            'grade_id' => $this->request->getPost('grade_id'),
        ]);
        $this->db->transComplete();


        if ($this->db->transStatus() === false) {
            return redirect()->back()->withInput()->with('errors', 'Data gagal disimpan.');
        }
        return redirect()->to('voter')->with('message', 'Data berhasil disimpan.');
    }


    public function delete($userId)
    {
        // CASCADE
        $this->userModel->delete($userId, true);
        return redirect()->to('voter');
    }

    public function export_excel()
{

    $voter = $this->voterModel->getVoter();


    // $user = $this->userModel->('candidate')->findAll();

    

    if (!$voter) {
        return redirect()->back()->with('error', 'Data tidak ditemukan!');
    }

    // Load library PhpSpreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header kolom
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'NIS');
    $sheet->setCellValue('C1', 'Nama');
    $sheet->setCellValue('D1', 'Kelas');
    $sheet->setCellValue('E1', 'Jurusan');

    // Isi data kandidat
    $rowNumber = 2; // Dimulai dari baris kedua
    foreach ($voter as $index => $voter);
        $sheet->setCellValue('A' . $rowNumber, $index + 1);
        $sheet->setCellValue('B' . $rowNumber, $voter['nis']);
        $sheet->setCellValue('C' . $rowNumber, $voter['fullname']);
        $sheet->setCellValue('D' . $rowNumber, $voter['grade_id']);
        $sheet->setCellValue('E' . $rowNumber, $voter['program_id']);
        $rowNumber++;

    // Nama file
    $filename = 'All_Pemilih_' . date('Y-m-d_H-i-s') . '.xlsx';

    // Download file
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit;
}
}
