<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfigurationModel extends Model
{
    protected $table = 'configurations';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'logo',
        'address',
        'email',
        'phone',
        'website'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getConfig()
    {
        return $this->first();
    }

    public function updateConfig($data, $logo = null)
    {
        $config = $this->first();
        
        // Handle logo upload
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            $newName = $logo->getRandomName();
            
            // Delete old logo if exists
            if ($config['logo'] && $config['logo'] != 'default-logo.png') {
                $this->deleteLogo($config['logo']);
            }
            
            // Move new logo
            $logo->move(FCPATH . 'img/config', $newName);
            $data['logo'] = $newName;
        }

        if ($config) {
            return $this->update($config['id'], $data);
        }
        
        return $this->insert($data);
    }

    private function deleteLogo($filename)
    {
        $path = FCPATH . 'img/config/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
    }
}