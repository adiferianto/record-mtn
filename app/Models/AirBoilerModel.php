<?php

namespace App\Models;

use CodeIgniter\Model;

class AirBoilerModel extends Model
{
    protected $table = 'tb_air_boiler';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id', 'tanggal', 'shift',
        'ab_1_last', 'ab_1', 'ab_1_pemakaian',
        'ab_2_last', 'ab_2', 'ab_2_pemakaian',
        'ab_3_last', 'ab_3', 'ab_3_pemakaian',
        'user'
    ];

    public function getAirBoiler($id = false)
    {
        if ($id == false) {
            return $this->orderBy('id', 'DESC')->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}
