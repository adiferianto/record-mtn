<?php
namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $bulanIndo = [
        '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr',
        '05' => 'Mei', '06' => 'Jun', '07' => 'Jul', '08' => 'Agu',
        '09' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des',
    ];

    public function index()
    {
        $db = \Config\Database::connect();

        $modules = [
            'sumur' => [
                'table' => 'tb_air',
                'expr'  => 'GREATEST(sumur_1_pemakaian,0) + GREATEST(sumur_2_pemakaian,0) + GREATEST(sumur_3_pemakaian,0) + GREATEST(sumur_4_pemakaian,0)',
                'label' => 'Air Sumur',
                'unit'  => 'm³',
            ],
            'proses' => [
                'table' => 'tb_air_proses',
                'expr'  => 'GREATEST(swp_pemakaian,0) + GREATEST(cwgt_pemakaian,0)',
                'label' => 'Air Proses',
                'unit'  => 'm³',
            ],
            'produksi' => [
                'table' => 'tb_air_produksi',
                'expr'  => 'GREATEST(cw_4_pemakaian,0) + GREATEST(cw_6_pemakaian,0) + GREATEST(sw_4_pemakaian,0) + GREATEST(sw_6_pemakaian,0)',
                'label' => 'Air Produksi',
                'unit'  => 'm³',
            ],
            'boiler' => [
                'table' => 'tb_air_boiler',
                'expr'  => 'GREATEST(ab_1_pemakaian,0) + GREATEST(ab_2_pemakaian,0) + GREATEST(ab_3_pemakaian,0)',
                'label' => 'Air Boiler',
                'unit'  => 'm³',
            ],
            'wwtp' => [
                'table' => 'tb_wwtp_proses',
                'expr'  => 'GREATEST(wwtp_in_1_pemakaian,0) + GREATEST(wwtp_in_2_pemakaian,0) + GREATEST(wwtp_out_pemakaian,0) + GREATEST(wwtp_out2_pemakaian,0) + GREATEST(ap_pemakaian,0) + GREATEST(ld_pemakaian,0)',
                'label' => 'WWTP Proses',
                'unit'  => 'm³',
            ],
            'sludge' => [
                'table' => 'tb_gas_boiler',
                'expr'  => 'GREATEST(gas_pemakaian,0) + GREATEST(boiler_1_2_pemakaian,0) + GREATEST(boiler_3_pemakaian,0)',
                'label' => 'Sludge Dryer dan Boiler',
                'unit'  => 'm³',
            ],
            'steam' => [
                'table' => 'tb_steam',
                'expr'  => 'GREATEST(steam_induk_pemakaian,0) + GREATEST(steam_con_dyeing_pemakaian,0)',
                'label' => 'Steam',
                'unit'  => 'm³',
            ],
            'kwh' => [
                'table' => 'tb_kwh',
                'expr'  => 'GREATEST(induk_pln_wbp_pemakaian,0) + GREATEST(induk_pln_lwbp_pemakaian,0)',
                'label' => 'KWH Listrik',
                'unit'  => 'kWh',
            ],
        ];

        $charts = [];

        foreach ($modules as $key => $mod) {
            $selectedYear = $this->request->getGet('tahun_' . $key) ?? date('Y');

            $tahunRows = $db->query("SELECT DISTINCT YEAR(tanggal) as tahun FROM {$mod['table']} ORDER BY tahun DESC")->getResultArray();
            $daftarTahun = array_filter(array_map(fn($r) => (int) $r['tahun'], $tahunRows));
            if (empty($daftarTahun)) {
                $daftarTahun = [(int) date('Y')];
            }

            $rows = $db->query("
                SELECT DATE_FORMAT(tanggal, '%m') as bulan, SUM({$mod['expr']}) as total
                FROM {$mod['table']}
                WHERE YEAR(tanggal) = ?
                GROUP BY bulan
            ", [$selectedYear])->getResultArray();

            $dataPerBulan = [];
            foreach ($rows as $r) {
                $dataPerBulan[$r['bulan']] = (float) $r['total'];
            }

            $labels = [];
            $values = [];
            for ($m = 1; $m <= 12; $m++) {
                $mm = str_pad($m, 2, '0', STR_PAD_LEFT);
                $labels[] = $this->bulanIndo[$mm];
                $values[] = round($dataPerBulan[$mm] ?? 0, 2);
            }

            $bulanTertinggi = null;
            $totalTertinggi = 0;
            if (!empty($dataPerBulan)) {
                $mmTertinggi = array_search(max($dataPerBulan), $dataPerBulan);
                $totalTertinggi = max($dataPerBulan);
                $bulanTertinggi = $this->bulanIndo[$mmTertinggi] . ' ' . $selectedYear;
            }

            $charts[$key] = [
                'label'          => $mod['label'],
                'unit'           => $mod['unit'],
                'labels'         => $labels,
                'values'         => $values,
                'daftarTahun'    => $daftarTahun,
                'selectedYear'   => (int) $selectedYear,
                'bulanTertinggi' => $bulanTertinggi,
                'totalTertinggi' => round($totalTertinggi, 2),
            ];
        }

        return view('dashboard', ['charts' => $charts]);
    }
    //--------------------------------------------------------------------
}
