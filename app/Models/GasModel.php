<?php

namespace App\Models;

use CodeIgniter\Model;

class GasModel extends Model
{
    protected $table = 'tb_gas_boiler';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id',
        'tanggal', 'shift',
        'gas_last', 'gas', 'gas_pemakaian',
        'boiler_1_2_last', 'boiler_1_2', 'boiler_1_2_pemakaian',
        'boiler_3_last', 'boiler_3', 'boiler_3_pemakaian',
        'total_pemakaian_boiler_1_2_3', 'user'
    ];

    public function getGas($id = false)
    {
        if ($id == false) {
            return $this->orderBy('id', 'DESC')->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}
