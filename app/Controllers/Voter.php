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

    public function updatePassword($voterId)
{
    $validation = \Config\Services::validation();

    $validation->setRules([
        'password' => [
            'label' => 'Password',
            'rules' => 'required|min_length[8]',
            'errors' => [
                'required' => 'Password baru harus diisi.',
                'min_length' => 'Password minimal 8 karakter.'
            ]
        ],
        'password_confirm' => [
            'label' => 'Konfirmasi Password',
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Konfirmasi password harus diisi.',
                'matches' => 'Konfirmasi password tidak cocok.'
            ]
        ],
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

        $voter = $this->voterModel->find($voterId);

        $this->userModel->update($voter['user_id'], [
            'password_hash' => Password::hash($this->request->getPost('password')),
            'force_pass_reset' => 0,
        ]);

        return redirect()->to('voter')->with('message', 'Password berhasil diubah.');
}

    public function export_excel()
    {

        $voters = $this->voterModel->getVoter();


        // $user = $this->userModel->('candidate')->findAll();

        

        if (!$voters) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        // Load library PhpSpreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Kelas');
        // $sheet->setCellValue('E1', 'Jurusan');

        // Isi data kandidat
        $rowNumber = 2; // Dimulai dari baris kedua
        foreach ($voters as $index => $voter);
            $sheet->setCellValue('A' . $rowNumber, $index + 1);
            $sheet->setCellValue('C' . $rowNumber, $voter['fullname']);
            $sheet->setCellValue('D' . $rowNumber, $voter['grade_id']);
            // $sheet->setCellValue('E' . $rowNumber, $voter['program_id']);
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

    public function import_excel()
    {
        // Cek apakah ada file yang diupload
        if (empty($_FILES['file_excel']['tmp_name'])) {
            return redirect()->back()->with('error', 'Tidak ada file yang diupload!');
        }

        // Load library PhpSpreadsheet
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($_FILES['file_excel']['tmp_name']);
        $sheet = $spreadsheet->getActiveSheet();

        // Ambil data dari file Excel (misalnya mulai dari baris 2, karena baris pertama adalah header)
        $data = [];
        $highestRow = $sheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; $row++) {
            // Ambil data dari setiap kolom sesuai dengan header Excel
            $fullname = $sheet->getCell('C' . $row)->getValue();
            $grade_id = $sheet->getCell('D' . $row)->getValue();
            // $program_id = $sheet->getCell('E' . $row)->getValue();

            // Pastikan data valid dan tidak kosong
            if (empty($fullname) || empty($grade_id)) {
                continue; // Lewati baris ini jika data tidak lengkap
            }

            $data[] = [
                'fullname' => $fullname,
                'grade_id' => $grade_id,
                // 'program_id' => $program_id
            ];
        }

        // Simpan data ke database (contoh menggunakan model)
        if (!empty($data)) {
            foreach ($data as $voter) {
                $this->voterModel->insert($voter);
            }
            return redirect()->back()->with('success', 'Data berhasil diimpor!');
        } else {
            return redirect()->back()->with('error', 'Data tidak valid atau kosong!');
        }
    }

}
