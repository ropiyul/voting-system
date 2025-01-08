<?php

namespace App\Models;

use CodeIgniter\Model;

class Periodmodel extends Model
{
    protected $table = 'periods';
    protected $allowedFields = ['name', 'start_date', 'end_date'];
}