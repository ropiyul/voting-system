<?php

use App\Models\ConfigurationModel;

if (!function_exists('get_config')) {
    function get_config($key = null) 
    {
        $configModel = new ConfigurationModel();
        
        $config = $configModel->first();

        if ($key === null) {
            return $config;
        }

        return isset($config[$key]) ? $config[$key] : null;
    }
}

if (!function_exists('clear_config_cache')) {
    function clear_config_cache()
    {
        // Fungsi ini tidak diperlukan lagi karena tidak menggunakan cache
        return true;
    }
}