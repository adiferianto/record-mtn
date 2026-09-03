<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AirSumurModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class AirSumur extends BaseController
{
    protected $airSumurModel;
    public function __construct()
    {
        $this->airSumurModel = new AirSumurModel();
    }
    //--------------------------------------------------------------------

    public function index()
    {
        $data['air_sumur'] = $this->airSumurModel->orderBy('id', 'DESC')->paginate(20);
        $data['pager'] = $this->airSumurModel->pager;
        return view('air-sumur/index', $data);
    }

    //--------------------------------------------------------------------
    public function add()
    {
        $data = [
            'validation' => \Config\Services::validation(),
        ];

        // return view('air/tambah', $data);
        return view('air-sumur/add', $data);
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
            // 'sumur_1_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'sumur 1 sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sumur_1' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'sumur 1 sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sumur_2_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sumur_2' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sumur_3_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sumur_3' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sumur_4_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sumur_4' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
        ])) {
            return redirect()->to('/airSumur/add')->withInput();
        }

        $this->airSumurModel->save([
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'sumur_1_last' => $this->request->getVar('sumur_1_last'),
            'sumur_1' => $this->request->getVar('sumur_1'),
            'sumur_1_pemakaian' => $this->request->getVar('sumur_1_pemakaian'),
            'sumur_2_last' => $this->request->getVar('sumur_2_last'),
            'sumur_2' => $this->request->getVar('sumur_2'),
            'sumur_2_pemakaian' => $this->request->getVar('sumur_2_pemakaian'),
            'sumur_3_last' => $this->request->getVar('sumur_3_last'),
            'sumur_3' => $this->request->getVar('sumur_3'),
            'sumur_3_pemakaian' => $this->request->getVar('sumur_3_pemakaian'),
            'sumur_4_last' => $this->request->getVar('sumur_4_last'),
            'sumur_4' => $this->request->getVar('sumur_4'),
            'sumur_4_pemakaian' => $this->request->getVar('sumur_4_pemakaian'),
			//Add Recycle
			'recycle_last' => $this->request->getVar('recycle_last'),
            'recycle' => $this->request->getVar('recycle'),
            'recycle_total' => $this->request->getVar('recycle_total'),
            'user' => $this->request->getVar('user'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambah.');

        return redirect()->to('/airSumur');
    }
    //--------------------------------------------------------------------

    public function edit($id)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'air_sumur' => $this->airSumurModel->getairSumur($id)
        ];

        return view('air-sumur/edit', $data);
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
            // 'sumur_1_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'sumur 1 sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sumur_1' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'sumur 1 sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sumur_2_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sumur_2' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sumur_3_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sumur_3' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sumur_4_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sumur_4' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
        ])) {
            return redirect()->to('/airSumur/edit/' . $this->request->getVar('id'))->withInput();
        }

        $this->airSumurModel->save([
            'id' => $id,
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'sumur_1_last' => $this->request->getVar('sumur_1_last'),
            'sumur_1' => $this->request->getVar('sumur_1'),
            'sumur_1_pemakaian' => $this->request->getVar('sumur_1_pemakaian'),
            'sumur_2_last' => $this->request->getVar('sumur_2_last'),
            'sumur_2' => $this->request->getVar('sumur_2'),
            'sumur_2_pemakaian' => $this->request->getVar('sumur_2_pemakaian'),
            'sumur_3_last' => $this->request->getVar('sumur_3_last'),
            'sumur_3' => $this->request->getVar('sumur_3'),
            'sumur_3_pemakaian' => $this->request->getVar('sumur_3_pemakaian'),
            'sumur_4_last' => $this->request->getVar('sumur_4_last'),
            'sumur_4' => $this->request->getVar('sumur_4'),
            'sumur_4_pemakaian' => $this->request->getVar('sumur_4_pemakaian'),
			//Add recycle
			'recycle_last' => $this->request->getVar('recycle_last'),
            'recycle' => $this->request->getVar('recycle'),
            'recycle_total' => $this->request->getVar('recycle_total'),
            'user' => $this->request->getVar('user')

        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/airSumur');
    }
    //--------------------------------------------------------------------

    public function delete($id)
    {
        $this->airSumurModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/airSumur');
    }
    //--------------------------------------------------------------------

    public function export()
    {
        $dataSumur = $this->airSumurModel->getAirSumur();

        $spreadsheet = new Spreadsheet();
        //Tulis header atau nama kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:A2')->setCellValue('A1', 'Tanggal')
            ->mergeCells('B1:B2')->setCellValue('B1', 'Shift')
            ->mergeCells('C1:E1')->setCellValue('C1', 'Sumur 1')->setCellValue('C2', 'Sebelum')->setCellValue('D2', 'Sekarang')->setCellValue('E2', 'Pemakaian')
            ->mergeCells('F1:H1')->setCellValue('F1', 'Sumur 2')->setCellValue('F2', 'Sebelum')->setCellValue('G2', 'Sekarang')->setCellValue('H2', 'Pemakaian')
            ->mergeCells('I1:K1')->setCellValue('I1', 'Sumur 3')->setCellValue('I2', 'Sebelum')->setCellValue('J2', 'Sekarang')->setCellValue('K2', 'Pemakaian')
            ->mergeCells('L1:N1')->setCellValue('L1', 'Sumur 4')->setCellValue('L2', 'Sebelum')->setCellValue('M2', 'Sekarang')->setCellValue('N2', 'Pemakaian')
			//Add recycle
			->mergeCells('P1:R1')->setCellValue('P1', 'Recycle')->setCellValue('P2', 'Sebelum')->setCellValue('Q2', 'Sekarang')->setCellValue('R2', 'Pemakaian')
            ->mergeCells('O1:O2')->setCellValue('O1', 'User');

        $column = 3;
        //tulis data Air Sumur ke Cell
        foreach ($dataSumur as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['tanggal'])
                ->setCellValue('B' . $column, $data['shift'])
                ->setCellValue('C' . $column, $data['sumur_1_last'])
                ->setCellValue('D' . $column, $data['sumur_1'])
                ->setCellValue('E' . $column, $data['sumur_1_pemakaian'])
                ->setCellValue('F' . $column, $data['sumur_2_last'])
                ->setCellValue('G' . $column, $data['sumur_2'])
                ->setCellValue('H' . $column, $data['sumur_2_pemakaian'])
                ->setCellValue('I' . $column, $data['sumur_3_last'])
                ->setCellValue('J' . $column, $data['sumur_3'])
                ->setCellValue('K' . $column, $data['sumur_3_pemakaian'])
                ->setCellValue('L' . $column, $data['sumur_4_last'])
                ->setCellValue('M' . $column, $data['sumur_4'])
                ->setCellValue('N' . $column, $data['sumur_4_pemakaian'])
				//Add Recycle
				->setCellValue('P' . $column, $data['recycle_last'])
				->setCellValue('Q' . $column, $data['recycle'])
				->setCellValue('R' . $column, $data['recycle_total'])
                ->setCellValue('O' . $column, $data['user']);
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
		$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(30);

        //tulis dalam format Xlsx
        $writer = new Xls($spreadsheet);
        $fileName = 'Data Air Sumur';

        //Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xls');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
