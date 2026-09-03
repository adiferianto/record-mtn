<?php

namespace App\Controllers;

use CodeIgniter\CodeIgniter;
use App\Models\AirProduksiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class AirProduksi extends BaseController
{
    protected $airProduksiModel;
    public function __construct()
    {
        $this->airProduksiModel = new AirProduksiModel();
    }
    //--------------------------------------------------------------------

    public function index()
    {
        $data = [
            'air_produksi' => $this->airProduksiModel->orderBy('id', 'DESC')->paginate(20),
            'pager' => $this->airProduksiModel->pager,
        ];

        return view('air-produksi/index', $data);
    }
    //--------------------------------------------------------------------

    public function add()
    {
        $data = [
            'validation' => \Config\Services::validation(),
        ];

        return view('air-produksi/add', $data);
    }

    public function save()
    {
        //validasi input
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
            // 'cw_4_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'cw 4 sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'cw_4' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'cw 4 sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'cw_6_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'cw 6 sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'cw_6' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'cw 6 sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sw_4_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'sw 4 sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sw_4' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'sw 4 sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sw_6_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'sw 6 sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sw_6' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'sw 6 sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
        ])) {
            return redirect()->to('/airProduksi/add')->withInput();
        }

        $this->airProduksiModel->save([
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'cw_4_last' => $this->request->getVar('cw_4_last'),
            'cw_4' => $this->request->getVar('cw_4'),
            'cw_4_pemakaian' => $this->request->getVar('cw_4_pemakaian'),
            'cw_6_last' => $this->request->getVar('cw_6_last'),
            'cw_6' => $this->request->getVar('cw_6'),
            'cw_6_pemakaian' => $this->request->getVar('cw_6_pemakaian'),
            'sw_4_last' => $this->request->getVar('sw_4_last'),
            'sw_4' => $this->request->getVar('sw_4'),
            'sw_4_pemakaian' => $this->request->getVar('sw_4_pemakaian'),
            'sw_6_last' => $this->request->getVar('sw_6_last'),
            'sw_6' => $this->request->getVar('sw_6'),
            'sw_6_pemakaian' => $this->request->getVar('sw_6_pemakaian'),
            'user' => $this->request->getVar('user')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diinput.');

        return redirect()->to('/airProduksi');
    }
    //--------------------------------------------------------------------

    public function edit($id)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'air_produksi' => $this->airProduksiModel->getAirProduksi($id)
        ];

        return view('air-produksi/edit', $data);
    }
    public function update($id)
    {
        //validasi input
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
            // 'cw_4_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'cw 4 sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'cw_4' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'cw 4 sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'cw_6_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'cw 6 sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'cw_6' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'cw 6 sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sw_4_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'sw 4 sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sw_4' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'sw 4 sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sw_6_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'sw 6 sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'sw_6' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'sw 6 sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
        ])) {
            return redirect()->to('/airProduksi/edit/' . $this->request->getVar('id'))->withInput();
        }

        $this->airProduksiModel->save([
            'id' => $id,
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'cw_4_last' => $this->request->getVar('cw_4_last'),
            'cw_4' => $this->request->getVar('cw_4'),
            'cw_4_pemakaian' => $this->request->getVar('cw_4_pemakaian'),
            'cw_6_last' => $this->request->getVar('cw_6_last'),
            'cw_6' => $this->request->getVar('cw_6'),
            'cw_6_pemakaian' => $this->request->getVar('cw_6_pemakaian'),
            'sw_4_last' => $this->request->getVar('sw_4_last'),
            'sw_4' => $this->request->getVar('sw_4'),
            'sw_4_pemakaian' => $this->request->getVar('sw_4_pemakaian'),
            'sw_6_last' => $this->request->getVar('sw_6_last'),
            'sw_6' => $this->request->getVar('sw_6'),
            'sw_6_pemakaian' => $this->request->getVar('sw_6_pemakaian'),
            'user' => $this->request->getVar('user')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/airProduksi');
    }
    //--------------------------------------------------------------------

    public function delete($id)
    {
        $this->airProduksiModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/AirProduksi');
    }
    //--------------------------------------------------------------------

    public function export()
    {
        $dataAirProduksi = $this->airProduksiModel->getAirProduksi();

        $spreadsheet = new Spreadsheet();
        //Tulis header atau nama kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:A2')->setCellValue('A1', 'Tanggal')
            ->mergeCells('B1:B2')->setCellValue('B1', 'Shift')
            ->mergeCells('C1:E1')->setCellValue('C1', 'Clean Water 4')->setCellValue('C2', 'Sebelum')->setCellValue('D2', 'Sekarang')->setCellValue('E2', 'Pemakaian')
            ->mergeCells('F1:H1')->setCellValue('F1', 'Clean Water 6')->setCellValue('F2', 'Sebelum')->setCellValue('G2', 'Sekarang')->setCellValue('H2', 'Pemakaian')
            ->mergeCells('I1:K1')->setCellValue('I1', 'Soft Water 4')->setCellValue('I2', 'Sebelum')->setCellValue('J2', 'Sekarang')->setCellValue('K2', 'Pemakaian')
            ->mergeCells('L1:N1')->setCellValue('L1', 'Soft Water 6')->setCellValue('L2', 'Sebelum')->setCellValue('M2', 'Sekarang')->setCellValue('N2', 'Pemakaian')
            ->mergeCells('O1:O2')->setCellValue('O1', 'User');

        $column = 3;
        //tulis data Air Sumur ke Cell
        foreach ($dataAirProduksi as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['tanggal'])
                ->setCellValue('B' . $column, $data['shift'])
                ->setCellValue('C' . $column, $data['cw_4_last'])
                ->setCellValue('D' . $column, $data['cw_4'])
                ->setCellValue('E' . $column, $data['cw_4_pemakaian'])
                ->setCellValue('F' . $column, $data['cw_6_last'])
                ->setCellValue('G' . $column, $data['cw_6'])
                ->setCellValue('H' . $column, $data['cw_6_pemakaian'])
                ->setCellValue('I' . $column, $data['sw_4_last'])
                ->setCellValue('J' . $column, $data['sw_4'])
                ->setCellValue('K' . $column, $data['sw_4_pemakaian'])
                ->setCellValue('L' . $column, $data['sw_6_last'])
                ->setCellValue('M' . $column, $data['sw_6'])
                ->setCellValue('N' . $column, $data['sw_6_pemakaian'])
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
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(30);

        //tulis dalam format Xlsx
        $writer = new Xls($spreadsheet);
        $fileName = 'Data Air Produksi';

        //Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xls');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
