<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'id_permission';
    protected $allowedFields = ['id_user', 'menu_name', 'can_access'];
}
