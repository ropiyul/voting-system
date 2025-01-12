<?php

namespace App\Controllers;

use App\Models\CandidateModel;
use App\Models\GradeModel;
use App\Models\ProgramModel;
use App\Models\UserModel;
use Exception;
use \Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Password;

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

        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $filename = $this->request->getVar('image');
            if ($filename) {
                unlink(WRITEPATH . 'uploads/temp/'.$filename);
            }
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->db->transStart();
        $filename = $this->request->getVar('image');
        $tempPath = WRITEPATH . 'uploads/temp/' . $filename;
        $targetPath = 'img/' . $filename;

        if (file_exists($tempPath)) {
            rename($tempPath, FCPATH . $targetPath);
            $fileName = $filename;
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
        $file = $this->request->getFile('image');

        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/temp', $fileName);

            return $this->response
            ->setHeader('Content-Type', 'text/plain')
            ->setBody($fileName);
        }

        return $this->response->setJSON([
            'success' => false,
            'error' => 'Failed to upload file'
        ]);
    }
    public function remove_temp()
    {
        $request = $this->request->getJSON();
        $fileName = $request->filename;

        $filePath = WRITEPATH . 'uploads/temp/' . $fileName;
        if (file_exists($filePath)) {
            unlink(filename: $filePath); // Hapus file dari server
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false, 'error' => 'File not found']);
    }
    public function remove_temp1()
    {
        $json = $this->request->getJSON();
        $filename = $json->filename;
    
        $tempPath = WRITEPATH . 'uploads/temp/';
        $filePath = $tempPath . $filename;
    
        if (file_exists($filePath)) {
            unlink($filePath);
            return $this->response->setJSON(['success' => true]);
        }
    
        return $this->response->setJSON(['success' => false]);
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
            // 'image' => [
            //     'label' => 'image',
            //     'rules' => 'max_size[image,5108]|is_image[image]|mime_in[image,image/png,image/jpg,image/jpeg]',
            //     'errors' => [
            //         'max_size' => 'Ukuran {field} terlalu besar, max 5MB.',
            //         'is_image' => '{field} harus berupa gambar',
            //         'mime_in' =>  '{field} harus berformat png, jpg, atau jpeg.'
            //     ]
            // ],
        ]);

        // Menjalankan validasi
        if (!$validation->withRequest($this->request)->run()) {
            $filename = $this->request->getVar('image');
            if ($filename) {
                unlink(WRITEPATH . 'uploads/temp/'.$filename);
            }
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }


        $filename = $this->request->getVar('image');
        $oldImage = $this->request->getPost('oldImage');
        // return dd([$filename,$oldImage]);
        if ($filename != $oldImage):
            
            $this->db->transStart();
            $tempPath = WRITEPATH . 'uploads/temp/' . $filename;
            $targetPath = 'img/' . $filename;
            if (file_exists($tempPath)) {
                // Pindahkan file dari temporary ke folder final
                rename($tempPath, FCPATH . $targetPath);
                $fileName = $filename;
            }
            unlink("img/$oldImage");

            $email = mt_rand(10000, 1000000) . '@gmail.com';
            $this->userModel->save([
                'id' => $this->request->getPost('user_id'),
                'username' => $this->request->getPost('username'),
                'email' => $email,
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
            $email = mt_rand(10000, 1000000) . '@gmail.com';
            $this->db->transStart();
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
}
