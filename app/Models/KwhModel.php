<?php

namespace App\Models;

use CodeIgniter\Model;

class KwhModel extends Model
{
    protected $table = 'tb_kwh';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id', 'tanggal', 'shift',
        'induk_pln_wbp_last', 'induk_pln_wbp', 'induk_pln_wbp_pemakaian',
        'induk_pln_lwbp_last', 'induk_pln_lwbp', 'induk_pln_lwbp_pemakaian',
        'kwh_wtp_am_last', 'kwh_wtp_am', 'kwh_wtp_jp', 'kwh_wtp_pemakaian_wbp', 'kwh_wtp_pemakaian_lwbp',
        'kwh_wwtp_am_last', 'kwh_wwtp_am', 'kwh_wwtp_jp', 'kwh_wwtp_pemakaian_wbp', 'kwh_wwtp_pemakaian_lwbp',
        'user'
    ];

    public function getKwh($id = false)
    {
        if ($id == false) {
            return $this->orderBy('id', 'DESC')->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}
