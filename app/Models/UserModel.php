<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'admin';  // Your table name
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'membership_duration', 'start_date', 'expiration_date'];

    public function getUsers()
    {
        return $this->findAll();
    }
    
}

