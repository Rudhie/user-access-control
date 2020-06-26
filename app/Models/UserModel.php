<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['fullname', 'username', 'password', 'email', 'phone', 'profile_picture', 'role_id'];
    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;

}