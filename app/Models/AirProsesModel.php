<?php

namespace App\Models;

use CodeIgniter\Model;

class AirProsesModel extends Model
{
    protected $table = 'tb_air_proses';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id', 'tanggal', 'shift',
        'swp_last', 'swp', 'swp_pemakaian',
        'cwgt_last', 'cwgt', 'cwgt_pemakaian',
        'user'
    ];

    public function getAirProses($id = false)
    {
        if ($id == false) {
            return $this->orderBy('id', 'DESC')->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}
