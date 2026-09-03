<?php

namespace App\Controllers;

use CodeIgniter\CodeIgniter;
use App\Models\KwhModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Kwh extends BaseController
{
    protected $kwhModel;
    public function __construct()
    {
        $this->kwhModel = new KwhModel();
    }
    //--------------------------------------------------------------------

    public function index()
    {
        $data = [
            'title' => 'Tabel Laporan KWH / Listrik',
            'kwh' => $this->kwhModel->orderBy('id', 'DESC')->paginate(20),
            'pager' => $this->kwhModel->pager,
        ];

        return view('kwh/index', $data);
    }
    //--------------------------------------------------------------------

    public function add()
    {
        $data = [
            'title' => 'Form Tambah Data KWH / Listrik',
            'validation' => \Config\Services::validation()
        ];

        return view('kwh/add', $data);
    }

    public function save()
    {
        //Validasi input
        if (!$this->validate([
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'shift' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            // 'induk_pln_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'induk_pln' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'kwh_wtp_am_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'angka meter sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'kwh_wtp_am' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'angka meter setelah boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'kwh_wwtp_am_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'angka meter sebelum boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'kwh_wwtp_am' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'angka meter setelah tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
        ])) {
            return redirect()->to('/kwh/add')->withInput();
        }

        $this->kwhModel->save([
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'induk_pln_wbp_last' => $this->request->getVar('induk_pln_wbp_last'),
            'induk_pln_wbp' => $this->request->getVar('induk_pln_wbp'),
            'induk_pln_wbp_pemakaian' => $this->request->getVar('induk_pln_wbp_pemakaian'),
            'induk_pln_lwbp_last' => $this->request->getVar('induk_pln_lwbp_last'),
            'induk_pln_lwbp' => $this->request->getVar('induk_pln_lwbp'),
            'induk_pln_lwbp_pemakaian' => $this->request->getVar('induk_pln_lwbp_pemakaian'),
            'kwh_wtp_am_last' => $this->request->getVar('kwh_wtp_am_last'),
            'kwh_wtp_am' => $this->request->getVar('kwh_wtp_am'),
            'kwh_wtp_jp' => $this->request->getVar('kwh_wtp_jp'),
            'kwh_wtp_pemakaian_wbp' => $this->request->getVar('kwh_wtp_pemakaian_wbp'),
            'kwh_wtp_pemakaian_lwbp' => $this->request->getVar('kwh_wtp_pemakaian_lwbp'),
            'kwh_wwtp_am_last' => $this->request->getVar('kwh_wwtp_am_last'),
            'kwh_wwtp_am' => $this->request->getVar('kwh_wwtp_am'),
            'kwh_wwtp_jp' => $this->request->getVar('kwh_wwtp_jp'),
            'kwh_wwtp_pemakaian_wbp' => $this->request->getVar('kwh_wwtp_pemakaian_wbp'),
            'kwh_wwtp_pemakaian_lwbp' => $this->request->getVar('kwh_wwtp_pemakaian_lwbp'),
            'user' => $this->request->getVar('user'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambah.');

        return redirect()->to('/kwh');
    }
    //--------------------------------------------------------------------

    public function edit($id)
    {
        $data = [
            'title' => 'Form Ubah Data KWH / Listrik',
            'validation' => \Config\Services::validation(),
            'kwh' => $this->kwhModel->getKwh($id)
        ];

        return view('kwh/edit', $data);
    }

    public function update($id)
    {
        //Validasi input
        if (!$this->validate([
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'shift' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            // 'induk_pln_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'induk_pln' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'kwh_wtp_am_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'kwh_wtp_am' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'kwh_wwtp_am_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'kwh_wwtp_am' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
        ])) {
            return redirect()->to('kwh/edit/' . $this->kwhModel->getKwh('id'))->withInput();
        }

        $this->kwhModel->save([
            'id' => $id,
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'induk_pln_wbp_last' => $this->request->getVar('induk_pln_wbp_last'),
            'induk_pln_wbp' => $this->request->getVar('induk_pln_wbp'),
            'induk_pln_wbp_pemakaian' => $this->request->getVar('induk_pln_wbp_pemakaian'),
            'induk_pln_lwbp_last' => $this->request->getVar('induk_pln_lwbp_last'),
            'induk_pln_lwbp' => $this->request->getVar('induk_pln_lwbp'),
            'induk_pln_lwbp_pemakaian' => $this->request->getVar('induk_pln_lwbp_pemakaian'),
            'kwh_wtp_am_last' => $this->request->getVar('kwh_wtp_am_last'),
            'kwh_wtp_am' => $this->request->getVar('kwh_wtp_am'),
            'kwh_wtp_jp' => $this->request->getVar('kwh_wtp_jp'),
            'kwh_wtp_pemakaian_wbp' => $this->request->getVar('kwh_wtp_pemakaian_wbp'),
            'kwh_wtp_pemakaian_lwbp' => $this->request->getVar('kwh_wtp_pemakaian_lwbp'),
            'kwh_wwtp_am_last' => $this->request->getVar('kwh_wwtp_am_last'),
            'kwh_wwtp_am' => $this->request->getVar('kwh_wwtp_am'),
            'kwh_wwtp_jp' => $this->request->getVar('kwh_wwtp_jp'),
            'kwh_wwtp_pemakaian_wbp' => $this->request->getVar('kwh_wwtp_pemakaian_wbp'),
            'kwh_wwtp_pemakaian_lwbp' => $this->request->getVar('kwh_wwtp_pemakaian_lwbp'),
            'user' => $this->request->getVar('user'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/kwh');
    }
    //--------------------------------------------------------------------

    public function delete($id)
    {
        $this->kwhModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/kwh');
    }
    //--------------------------------------------------------------------

    public function export()
    {
        $dataKwh = $this->kwhModel->getKwh();

        $spreadsheet = new Spreadsheet();
        //Tulis header atau nama kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:A2')->setCellValue('A1', 'Tanggal')
            ->mergeCells('B1:B2')->setCellValue('B1', 'Shift')
            ->mergeCells('C1:E1')->setCellValue('C1', 'Induk PLN WBP')->setCellValue('C2', 'Sebelum')->setCellValue('D2', 'Sekarang')->setCellValue('E2', 'Pemakaian')
            ->mergeCells('F1:H1')->setCellValue('F1', 'Induk PLN LWBP')->setCellValue('F2', 'Sebelum')->setCellValue('G2', 'Sekarang')->setCellValue('H2', 'Pemakaian')
            ->mergeCells('I1:M1')->setCellValue('I1', 'KWH WTP')->setCellValue('I2', 'Angka Meter Sebelum')->setCellValue('J2', 'Angka Meter Sekarang')->setCellValue('K2', 'Jumlah Pemakaian')->setCellValue('L2', 'Pemakaian WBP')->setCellValue('M2', 'Pemakaian LWBP')
            ->mergeCells('N1:R1')->setCellValue('N1', 'KWH WWTP')->setCellValue('N2', 'Angka Meter Sebelum')->setCellValue('O2', 'Angka Meter Sekarang')->setCellValue('P2', 'Jumlah Pemakaian')->setCellValue('Q2', 'Pemakaian WBP')->setCellValue('R2', 'Pemakaian LWBP')
            ->mergeCells('S1:S2')->setCellValue('S1', 'User');

        $column = 3;
        //tulis data Air Sumur ke Cell
        foreach ($dataKwh as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['tanggal'])
                ->setCellValue('B' . $column, $data['shift'])
                ->setCellValue('C' . $column, $data['induk_pln_wbp_last'])
                ->setCellValue('D' . $column, $data['induk_pln_wbp'])
                ->setCellValue('E' . $column, $data['induk_pln_wbp_pemakaian'])
                ->setCellValue('F' . $column, $data['induk_pln_lwbp_last'])
                ->setCellValue('G' . $column, $data['induk_pln_lwbp'])
                ->setCellValue('H' . $column, $data['induk_pln_lwbp_pemakaian'])
                ->setCellValue('I' . $column, $data['kwh_wtp_am_last'])
                ->setCellValue('J' . $column, $data['kwh_wtp_am'])
                ->setCellValue('K' . $column, $data['kwh_wtp_jp'])
                ->setCellValue('L' . $column, $data['kwh_wtp_pemakaian_wbp'])
                ->setCellValue('M' . $column, $data['kwh_wtp_pemakaian_lwbp'])
                ->setCellValue('N' . $column, $data['kwh_wwtp_am_last'])
                ->setCellValue('O' . $column, $data['kwh_wwtp_am'])
                ->setCellValue('P' . $column, $data['kwh_wwtp_jp'])
                ->setCellValue('Q' . $column, $data['kwh_wwtp_pemakaian_wbp'])
                ->setCellValue('R' . $column, $data['kwh_wwtp_pemakaian_lwbp'])
                ->setCellValue('S' . $column, $data['user']);
            $column++;
        }

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(30);

        //tulis dalam format Xlsx
        $writer = new Xls($spreadsheet);
        $fileName = 'Data Listrik & KWH Meter';

        //Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xls');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
