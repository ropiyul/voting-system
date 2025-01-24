
<?php

use App\Models\ConfigurationModel;

if (!function_exists('get_config')) {
    function get_config($key = null) 
    {
        // Coba ambil dari cache dulu
        $config = false;
        // cache('app_config');
        
        if (!$config) {
            $configModel = new ConfigurationModel();
            $config = $configModel->first();
            
            // Simpan ke cache selama 1 jam
            cache()->save('app_config', $config, 3600);
        }

        if ($key === null) {
            return $config;
        }

        // Return specific key atau null jika tidak ada
        return isset($config[$key]) ? $config[$key] : null;
    }
}

if (!function_exists('clear_config_cache')) {
    function clear_config_cache()
    {
        return cache()->delete('app_config');
    }
}