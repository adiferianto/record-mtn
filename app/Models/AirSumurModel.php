<?php

namespace App\Models;

use CodeIgniter\Model;

class AirSumurModel extends Model
{
    protected $table = 'tb_air';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id',
        'tanggal', 'shift',
        'sumur_1_last', 'sumur_1', 'sumur_1_pemakaian',
        'sumur_2_last', 'sumur_2', 'sumur_2_pemakaian',
        'sumur_3_last', 'sumur_3', 'sumur_3_pemakaian',
        'sumur_4_last', 'sumur_4', 'sumur_4_pemakaian',
		'recycle_last', 'recycle', 'recycle_total',
        'user'
    ];

    public function getAirSumur($id = false)
    {
        if ($id == false) {
            return $this->orderBy('id', 'DESC')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}
