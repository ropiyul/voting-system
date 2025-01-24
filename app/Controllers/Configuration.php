<?php

namespace App\Controllers;

class Configuration extends BaseController
{
    protected $configModel;
    
    public function __construct()
    {
        $this->configModel = new \App\Models\ConfigurationModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Konfigurasi',
            'config' => $this->configModel->getConfig()
        ];

        return view('configuration/index', $data);
    }

    public function update()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email',
            'phone' => 'required',
            'logo' => 'is_image[logo]|max_size[logo,2048]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $result = $this->configModel->updateConfig($this->request->getPost(), $this->request->getFile('logo'));
            
            if ($result) {
                return redirect()->back()->with('message', 'Konfigurasi berhasil diperbarui');
            }
            
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui konfigurasi');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}