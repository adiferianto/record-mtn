<?php

namespace App\Models;

use CodeIgniter\Model;

class SteamModel extends Model
{
    protected $table = 'tb_steam';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id',
        'tanggal', 'shift',
        'steam_induk_last', 'steam_induk', 'steam_induk_pemakaian',
        'steam_con_dyeing_last', 'steam_con_dyeing', 'steam_con_dyeing_pemakaian',
        'user'
    ];

    public function getSteam($id = false)
    {
        if ($id == false) {
            return $this->orderBy('id', 'DESC')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}
