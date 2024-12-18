<?php

namespace App\Controllers;

use App\Models\VoterModel;
use App\Models\UserModel;
use \Myth\Auth\Entities\User;
use \Myth\Auth\Authorization\GroupModel;
use \Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Config\Services;

class Voter extends BaseController
{

    protected $voterModel;
    protected $userModel;
    protected $auth;
    /**
     * @var AuthConfig
     */
    protected $config;

    public function __construct()
    {
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
        $data = [
            'title' => 'Add voter',
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
            'pass_confirm' => [
                'label' => 'pass_confirm',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Password harus diisi.',
                    'matches' => 'Password harus sama.'
                ]
            ],
            'nis' => [
                'label' => 'NIS',
                'rules' => 'required|is_unique[voters.nis]',
                'errors' => [
                    'required' => 'NIS harus diisi.',
                    'is_unique' => 'NIS sudah terdaftar.'
                ]
            ],
        ]);

        // Menjalankan validasi
        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembali dengan pesan error
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        try {
            $saveUser = $this->attemptRegister([
                'username' => $this->request->getVar('username'),
                'password' => $this->request->getVar('password'),
                'pass_confirm' => $this->request->getVar('pass_confirm'),

                'email' => $this->request->getVar('email'),
            ]);

            $savevoter = $this->voterModel->save([
                'nis' => $this->request->getPost('nis'),
                'user_id' => $saveUser,
                'fullname' => $this->request->getPost('fullname'),

            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', 'Data gagal disimpan.');
        }
        return redirect()->to('voter')->with('message', 'Data berhasil disimpan.');
    }


    public function edit($id){
        $data = [
            'title' => 'Edit voter',
            'voter' => $this->voterModel->getVoter($id),
        ];
        return view('voters/edit', $data);
    }

    public function update($voterId, $userId){
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
                'rules' => "required|is_unique[users.username,id,$userId]",
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'is_unique' => 'Username sudah terdaftar.'
                ]
            ],
            'email' => [
                'label' => 'email',
                'rules' => "required|is_unique[users.email,id,$userId]",
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
            'pass_confirm' => [
                'label' => 'pass_confirm',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Password harus diisi.',
                    'matches' => 'Password harus sama.'
                ]
            ],
            'nis' => [
                'label' => 'NIS',
                'rules' => "required|is_unique[voters.nis,id,$voterId]",
                'errors' => [
                    'required' => 'NIS harus diisi.',
                    'is_unique' => 'NIS sudah terdaftar.'
                ]
            ],
        ]);

        // Menjalankan validasi
        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembali dengan pesan error
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        try {
            $data = [
                'username' => $this->request->getVar('username'),
                'password' => $this->request->getVar('password'),
                'pass_confirm' => $this->request->getVar('pass_confirm'),
                'email' => $this->request->getVar('email'),
            ];
            $saveUser = $this->attemptRegister($data,$userId);

            $savevoter = $this->voterModel->save([
                'id' => $voterId,
                'nis' => $this->request->getPost('nis'),
                'fullname' => $this->request->getPost('fullname'),

            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', 'Data gagal disimpan.');
        }
        return redirect()->to('voter')->with('message', 'Data berhasil disimpan.');
    }


    public function attemptRegister(array $data,int $userId = null)
    {
        // Check if registration is allowed
        if (! $this->config->allowRegistration) {
            return redirect()->back()->withInput()->with('error', lang('Auth.registerDisabled'));
        }

        $users = model(UserModel::class);


        // Validate passwords since they can only be validated properly here
        $rules = [
            'password'     => 'required|strong_password',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules, $data)) { // Sesuaikan untuk validasi menggunakan $data
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Filter allowed fields and create user
        $allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
        $filteredData       = array_intersect_key($data, array_flip($allowedPostFields)); // Ambil data yang diizinkan
        $user               = new User($filteredData);

        // Activation logic
        $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();

        // Ensure default group gets assigned if set
        if (! empty($this->config->defaultUserGroup)) {
            $users = $users->withGroup($this->config->defaultUserGroup);
        }
        if($userId){
            $save = $users->update($userId, $user);
        } else{
            $save = $users->save($user);
        }

        if (!$save) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        if ($this->config->requireActivation !== null) {
            $activator = service('activator');
            $sent      = $activator->send($user);

            if (! $sent) {
                return redirect()->back()->withInput()->with('error', $activator->error() ?? lang('Auth.unknownError'));
            }

            return $this->userModel->getInsertID();
        }

        return $users->getInsertID();
    }

    public function delete($userId){
        // CASCADE
        $this->userModel->delete($userId, true);
        return redirect()->to('voter');
    }
}
