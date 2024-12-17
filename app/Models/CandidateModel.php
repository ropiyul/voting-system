<?php

namespace App\Models;
use CodeIgniter\Model;

class CandidateModel extends Model{
    protected $table = 'candidates';
    protected $allowedFields = ['name', 'vision', 'mission', 'image'];
}

