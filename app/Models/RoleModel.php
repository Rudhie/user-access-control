<?php namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'role_id';
    protected $allowedFields = ['role_name', 'status'];
    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;

}