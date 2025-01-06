<?php

namespace App\Models;

use CodeIgniter\Model;

class VoteModel extends Model
{
    protected $table = 'votes';
    protected $allowedFields = ['candidate_id', 'voter_id', 'voted_at'];
}