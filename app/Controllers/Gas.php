<?php

namespace App\Controllers;

use CodeIgniter\CodeIgniter;
use App\Models\GasModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Gas extends BaseController
{
    protected $gasModel;
    public function __construct()
    {
        $this->gasModel = new GasModel();
    }
    //--------------------------------------------------------------------

    public function index()
    {
        $data = [
            'title' => 'Tabel Laporan Gas & Boiler',
            'gas' => $this->gasModel->orderBy('id', 'DESC')->paginate(20),
            'pager' => $this->gasModel->pager,
        ];

        return view('gas/index', $data);
    }
    //--------------------------------------------------------------------

    public function add()
    {
        $data = [
            'title' => 'Form Tambah Data Gas & Boiler',
            'validation' => \Config\Services::validation()
        ];

        return view('gas/add', $data);
    }
    //--------------------------------------------------------------------

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
            // 'gas_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'gas meter sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'gas' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'gas meter sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'boiler_1_2_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'boiler 1 & 2 meter sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'boiler_1_2' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'boiler 1 & 2 meter sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'boiler_3_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'boiler 3 meter sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'boiler_3' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'boiler 3 meter sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
        ])) {
            return redirect()->to('/gas/add')->withInput();
        }

        $this->gasModel->save([
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'gas_last' => $this->request->getVar('gas_last'),
            'gas' => $this->request->getVar('gas'),
            'gas_pemakaian' => $this->request->getVar('gas_pemakaian'),
            'boiler_1_2_last' => $this->request->getVar('boiler_1_2_last'),
            'boiler_1_2' => $this->request->getVar('boiler_1_2'),
            'boiler_1_2_pemakaian' => $this->request->getVar('boiler_1_2_pemakaian'),
            'boiler_3_last' => $this->request->getVar('boiler_3_last'),
            'boiler_3' => $this->request->getVar('boiler_3'),
            'boiler_3_pemakaian' => $this->request->getVar('boiler_3_pemakaian'),
            'total_pemakaian_boiler_1_2_3' => $this->request->getVar('total_pemakaian_boiler_1_2_3'),
            'user' => $this->request->getVar('user'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambah.');

        return redirect()->to('/gas');
    }
    //--------------------------------------------------------------------

    public function edit($id)
    {
        $data = [
            'title' => 'Form Ubah Data Gas & Boiler',
            'validation' => \Config\Services::validation(),
            'gas' => $this->gasModel->getGas($id)
        ];

        return view('gas/edit', $data);
    }
    //--------------------------------------------------------------------

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
            // 'gas_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'gas meter sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'gas' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'gas meter sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'boiler_1_2_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'boiler 1 & 2 meter sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'boiler_1_2' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'boiler 1 & 2 meter sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'boiler_3_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'boiler 3 meter sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'boiler_3' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'boiler 3 meter sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
        ])) {
            return redirect()->to('/gas/edit/' . $this->gasModel->getGas('id'))->withInput();
        }

        $this->gasModel->save([
            'id' => $id,
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'gas_last' => $this->request->getVar('gas_last'),
            'gas' => $this->request->getVar('gas'),
            'gas_pemakaian' => $this->request->getVar('gas_pemakaian'),
            'boiler_1_2_last' => $this->request->getVar('boiler_1_2_last'),
            'boiler_1_2' => $this->request->getVar('boiler_1_2'),
            'boiler_1_2_pemakaian' => $this->request->getVar('boiler_1_2_pemakaian'),
            'boiler_3_last' => $this->request->getVar('boiler_3_last'),
            'boiler_3' => $this->request->getVar('boiler_3'),
            'boiler_3_pemakaian' => $this->request->getVar('boiler_3_pemakaian'),
            'total_pemakaian_boiler_1_2_3' => $this->request->getVar('total_pemakaian_boiler_1_2_3'),
            'user' => $this->request->getVar('user'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/gas');
    }
    //--------------------------------------------------------------------

    public function delete($id)
    {
        $this->gasModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/gas');
    }

    //--------------------------------------------------------------------

    public function export()
    {
        $dataGas = $this->gasModel->getGas();

        $spreadsheet = new Spreadsheet();
        //Tulis header atau nama kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:A2')->setCellValue('A1', 'Tanggal')
            ->mergeCells('B1:B2')->setCellValue('B1', 'Shift')
            ->mergeCells('C1:E1')->setCellValue('C1', 'Sludge Dryer')->setCellValue('C2', 'Sebelum')->setCellValue('D2', 'Sekarang')->setCellValue('E2', 'Pemakaian')
            ->mergeCells('F1:H1')->setCellValue('F1', 'Boiler 1 & 2')->setCellValue('F2', 'Sebelum')->setCellValue('G2', 'Sekarang')->setCellValue('H2', 'Pemakaian')
            ->mergeCells('I1:K1')->setCellValue('I1', 'Boiler 3')->setCellValue('I2', 'Sebelum')->setCellValue('J2', 'Sekarang')->setCellValue('K2', 'Pemakaian')
            ->mergeCells('L1:L2')->setCellValue('L1', 'Total Pemakaian Boiler 1, 2, 3')
            ->mergeCells('M1:M2')->setCellValue('M1', 'User');

        $column = 3;
        //tulis data Air Sumur ke Cell
        foreach ($dataGas as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['tanggal'])
                ->setCellValue('B' . $column, $data['shift'])
                ->setCellValue('C' . $column, $data['gas_last'])
                ->setCellValue('D' . $column, $data['gas'])
                ->setCellValue('E' . $column, $data['gas_pemakaian'])
                ->setCellValue('F' . $column, $data['boiler_1_2_last'])
                ->setCellValue('G' . $column, $data['boiler_1_2'])
                ->setCellValue('H' . $column, $data['boiler_1_2_pemakaian'])
                ->setCellValue('I' . $column, $data['boiler_3_last'])
                ->setCellValue('J' . $column, $data['boiler_3'])
                ->setCellValue('K' . $column, $data['boiler_3_pemakaian'])
                ->setCellValue('L' . $column, $data['total_pemakaian_boiler_1_2_3'])
                ->setCellValue('M' . $column, $data['user']);
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
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(30);

        //tulis dalam format Xlsx
        $writer = new Xls($spreadsheet);
        $fileName = 'Data Gas & Boiler';

        //Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xls');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
