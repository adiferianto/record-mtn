<?php

namespace App\Models;

use CodeIgniter\Model;

class AirProduksiModel extends Model
{
    protected $table = 'tb_air_produksi';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id', 'tanggal', 'shift',
        'cw_4_last', 'cw_4', 'cw_4_pemakaian',
        'cw_6_last', 'cw_6', 'cw_6_pemakaian',
        'sw_4_last', 'sw_4', 'sw_4_pemakaian',
        'sw_6_last', 'sw_6', 'sw_6_pemakaian',
        'user'
    ];

    public function getAirProduksi($id = false)
    {
        if ($id == false) {
            return $this->orderBy('id', 'DESC')->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}
