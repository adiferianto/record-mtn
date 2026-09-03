<?php

namespace App\Models;

use CodeIgniter\Model;

class WwtpProsesModel extends Model
{
    protected $table = 'tb_wwtp_proses';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id', 'tanggal', 'shift',
        'wwtp_in_1_last', 'wwtp_in_1', 'wwtp_in_1_pemakaian',
        'wwtp_in_2_last', 'wwtp_in_2', 'wwtp_in_2_pemakaian',
        'wwtp_out_last', 'wwtp_out', 'wwtp_out_pemakaian',
        'wwtp_out2_last', 'wwtp_out2', 'wwtp_out2_pemakaian',
        'ap_last', 'ap', 'ap_pemakaian',
        'ld_last', 'ld', 'ld_pemakaian',
        'user'
    ];
    //--------------------------------------------------------------------

    public function getWwtp($id = false)
    {
        if ($id == false) {
            return $this->orderBy('id', 'DESC')->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}
