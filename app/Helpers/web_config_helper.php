<?php

use App\Models\CandidateModel;
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


if (!function_exists('get_image')) {
    function get_image($key = null) 
    {
      $candidateModel = new CandidateModel();

      $candidate = $candidateModel->where('user_id',user_id())->first();
       return $candidate['image'];
    }
}