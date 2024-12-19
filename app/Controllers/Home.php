<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('dashboard/index');
    }
    public function dashboard(): string
    {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('dashboard/index',$data);
    }
}
