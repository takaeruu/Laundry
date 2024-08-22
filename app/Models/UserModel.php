<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user'; // Sesuaikan dengan nama tabel user Anda
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username', 'email']; // Tambahkan kolom yang dibutuhkan
    public function getActivitiesByUser($id_user)
    {
        return $this->db->table('user_activity')
            ->where('id_user', $id_user)
            ->get()
            ->getResult();

      }
    }