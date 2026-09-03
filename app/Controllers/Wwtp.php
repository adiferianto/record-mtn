<?php

namespace App\Controllers;

use CodeIgniter\CodeIgniter;
use App\Models\WwtpProsesModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Wwtp extends BaseController
{
    protected $wwtpProsesModel;
    public function __construct()
    {
        $this->wwtpProsesModel = new WwtpProsesModel();
    }
    //--------------------------------------------------------------------------

    public function index()
    {
        $data = [
            'wwtp' => $this->wwtpProsesModel->orderBy('id', 'DESC')->paginate(20),
            'pager' => $this->wwtpProsesModel->pager,
        ];

        return view('wwtp-proses/index', $data);
    }
    //--------------------------------------------------------------------------

    public function add()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('wwtp-proses/add', $data);
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
            // 'wwtp_in_1_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'wwtp_in_1' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'wwtp_in_2_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'wwtp_in_2' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'wwtp_out_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'wwtp_out' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'wwtp_out2_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'wwtp_out2' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'ap_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'adjust pool tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'ap' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'adjust pool tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'ld_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'limbah domestik tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'ld' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'limbah domestik tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
        ])) {
            return redirect()->to('/wwtp/add')->withInput();
        }

        $this->wwtpProsesModel->save([
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'wwtp_in_1_last' => $this->request->getVar('wwtp_in_1_last'),
            'wwtp_in_1' => $this->request->getVar('wwtp_in_1'),
            'wwtp_in_1_pemakaian' => $this->request->getVar('wwtp_in_1_pemakaian'),
            'wwtp_in_2_last' => $this->request->getVar('wwtp_in_2_last'),
            'wwtp_in_2' => $this->request->getVar('wwtp_in_2'),
            'wwtp_in_2_pemakaian' => $this->request->getVar('wwtp_in_2_pemakaian'),
            'wwtp_out_last' => $this->request->getVar('wwtp_out_last'),
            'wwtp_out' => $this->request->getVar('wwtp_out'),
            'wwtp_out_pemakaian' => $this->request->getVar('wwtp_out_pemakaian'),
            'wwtp_out2_last' => $this->request->getVar('wwtp_out2_last'),
            'wwtp_out2' => $this->request->getVar('wwtp_out2'),
            'wwtp_out2_pemakaian' => $this->request->getVar('wwtp_out2_pemakaian'),
            'ap_last' => $this->request->getVar('ap_last'),
            'ap' => $this->request->getVar('ap'),
            'ap_pemakaian' => $this->request->getVar('ap_pemakaian'),
            'ld_last' => $this->request->getVar('ld_last'),
            'ld' => $this->request->getVar('ld'),
            'ld_pemakaian' => $this->request->getVar('ld_pemakaian'),
            'user' => $this->request->getVar('user'),
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambah.');

        return redirect()->to('/wwtp');
    }
    //--------------------------------------------------------------------------

    public function edit($id)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'wwtp' => $this->wwtpProsesModel->getWwtp($id)
        ];

        return view('wwtp-proses/edit', $data);
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
            // 'wwtp_in_1_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'wwtp_in_1' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'wwtp_in_2_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'wwtp_in_2' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'wwtp_out_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'wwtp_out' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'wwtp_out2_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'wwtp_out2' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'ap_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'adjust pool tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'ap' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'adjust pool tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'ld_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'limbah domestik tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'ld' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'limbah domestik tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
        ])) {
            return redirect()->to('/wwtp/add' . $this->wwtpProsesModel->getWwtp('id'))->withInput();
        }

        $this->wwtpProsesModel->save([
            'id' => $id,
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'wwtp_in_1_last' => $this->request->getVar('wwtp_in_1_last'),
            'wwtp_in_1' => $this->request->getVar('wwtp_in_1'),
            'wwtp_in_1_pemakaian' => $this->request->getVar('wwtp_in_1_pemakaian'),
            'wwtp_in_2_last' => $this->request->getVar('wwtp_in_2_last'),
            'wwtp_in_2' => $this->request->getVar('wwtp_in_2'),
            'wwtp_in_2_pemakaian' => $this->request->getVar('wwtp_in_2_pemakaian'),
            'wwtp_out_last' => $this->request->getVar('wwtp_out_last'),
            'wwtp_out' => $this->request->getVar('wwtp_out'),
            'wwtp_out_pemakaian' => $this->request->getVar('wwtp_out_pemakaian'),
            'wwtp_out2_last' => $this->request->getVar('wwtp_out2_last'),
            'wwtp_out2' => $this->request->getVar('wwtp_out2'),
            'wwtp_out2_pemakaian' => $this->request->getVar('wwtp_out2_pemakaian'),
            'ap_last' => $this->request->getVar('ap_last'),
            'ap' => $this->request->getVar('ap'),
            'ap_pemakaian' => $this->request->getVar('ap_pemakaian'),
            'ld_last' => $this->request->getVar('ld_last'),
            'ld' => $this->request->getVar('ld'),
            'ld_pemakaian' => $this->request->getVar('ld_pemakaian'),
            'user' => $this->request->getVar('user'),
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/wwtp');
    }
    //--------------------------------------------------------------------------

    public function delete($id)
    {
        $this->wwtpProsesModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/wwtp');
    }
    //--------------------------------------------------------------------

    public function export()
    {
        $dataWtp = $this->wwtpProsesModel->getWwtp();

        $spreadsheet = new Spreadsheet();
        //Tulis header atau nama kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:A2')->setCellValue('A1', 'Tanggal')
            ->mergeCells('B1:B2')->setCellValue('B1', 'Shift')
            ->mergeCells('C1:E1')->setCellValue('C1', 'WWTP In 1')->setCellValue('C2', 'Sebelum')->setCellValue('D2', 'Sekarang')->setCellValue('E2', 'Pemakaian')
            ->mergeCells('F1:H1')->setCellValue('F1', 'WWTP In 2')->setCellValue('F2', 'Sebelum')->setCellValue('G2', 'Sekarang')->setCellValue('H2', 'Pemakaian')
            ->mergeCells('I1:K1')->setCellValue('I1', 'WWTP Out')->setCellValue('I2', 'Sebelum')->setCellValue('J2', 'Sekarang')->setCellValue('K2', 'Pemakaian')
            ->mergeCells('L1:N1')->setCellValue('L1', 'WWTP Out2')->setCellValue('L2', 'Sebelum')->setCellValue('M2', 'Sekarang')->setCellValue('N2', 'Pemakaian')
            ->mergeCells('O1:Q1')->setCellValue('O1', 'Adjust Pool')->setCellValue('O2', 'Sebelum')->setCellValue('P2', 'Sekarang')->setCellValue('Q2', 'Pemakaian')
            ->mergeCells('R1:T1')->setCellValue('R1', 'Limbah Domestik')->setCellValue('R2', 'Sebelum')->setCellValue('S2', 'Sekarang')->setCellValue('T2', 'Pemakaian')
            ->mergeCells('U1:U2')->setCellValue('U1', 'User');

        $column = 3;
        //tulis data Air Sumur ke Cell
        foreach ($dataWtp as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['tanggal'])
                ->setCellValue('B' . $column, $data['shift'])
                ->setCellValue('C' . $column, $data['wwtp_in_1_last'])
                ->setCellValue('D' . $column, $data['wwtp_in_1'])
                ->setCellValue('E' . $column, $data['wwtp_in_1_pemakaian'])
                ->setCellValue('F' . $column, $data['wwtp_in_2_last'])
                ->setCellValue('G' . $column, $data['wwtp_in_2'])
                ->setCellValue('H' . $column, $data['wwtp_in_2_pemakaian'])
                ->setCellValue('I' . $column, $data['wwtp_out_last'])
                ->setCellValue('J' . $column, $data['wwtp_out'])
                ->setCellValue('K' . $column, $data['wwtp_out_pemakaian'])
                ->setCellValue('L' . $column, $data['wwtp_out2_last'])
                ->setCellValue('M' . $column, $data['wwtp_out2'])
                ->setCellValue('N' . $column, $data['wwtp_out2_pemakaian'])
                ->setCellValue('O' . $column, $data['ap_last'])
                ->setCellValue('P' . $column, $data['ap'])
                ->setCellValue('Q' . $column, $data['ap_pemakaian'])
                ->setCellValue('R' . $column, $data['ld_last'])
                ->setCellValue('S' . $column, $data['ld'])
                ->setCellValue('T' . $column, $data['ld_pemakaian'])
                ->setCellValue('U' . $column, $data['user']);
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
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(30);

        //tulis dalam format Xlsx
        $writer = new Xls($spreadsheet);
        $fileName = 'Data WWTP Proses';

        //Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xls');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
