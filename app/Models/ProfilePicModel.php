<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilePicModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id'; 
    protected $allowedFields    = ['photo'];



}
