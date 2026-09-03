<?php

namespace App\Controllers;

use CodeIgniter\CodeIgniter;
use App\Models\AirProsesModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class AirProses extends BaseController
{
    protected $airProsesModel;
    public function __construct()
    {
        $this->airProsesModel = new AirProsesModel();
    }
    //--------------------------------------------------------------------

    public function index()
    {
        $data = [
            'title' => 'Tabel Laporan Air Proses',
            'airProses' => $this->airProsesModel->orderBy('id', 'DESC')->paginate(20),
            'pager' => $this->airProsesModel->pager,
        ];

        return view('air-proses/index', $data);
    }
    //--------------------------------------------------------------------

    public function add()
    {
        $data = [
            'title' => 'Form Tambah Data Air Proses',
            'validation' => \Config\Services::validation()
        ];

        return view('air-proses/add', $data);
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
            // 'swp_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'soft water pipeline sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'swp' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'soft water pipeline sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'swp_pemakaian' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'soft water pipeline pemakaian sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'cwgt_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'clean water ground tank sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'cwgt' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'clean water ground tank sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'cwgt_pemakaian' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'clean water ground tank pemakaian sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
        ])) {
            return redirect()->to('/airProses/add')->withInput();
        }
        $this->airProsesModel->save([
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'swp_last' => $this->request->getVar('swp_last'),
            'swp' => $this->request->getVar('swp'),
            'swp_pemakaian' => $this->request->getVar('swp_pemakaian'),
            'cwgt_last' => $this->request->getVar('cwgt_last'),
            'cwgt' => $this->request->getVar('cwgt'),
            'cwgt_pemakaian' => $this->request->getVar('cwgt_pemakaian'),
            'user' => $this->request->getVar('user')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambah.');

        return redirect()->to('/airProses');
    }
    //--------------------------------------------------------------------

    public function edit($id)
    {
        $data = [
            'title' => 'Form Ubah Data Air Proses',
            'validation' => \Config\Services::validation(),
            'airProses' => $this->airProsesModel->getAirProses($id)
        ];

        return view('air-proses/edit', $data);
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
            // 'swp_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'soft water pipeline sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'swp' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'soft water pipeline sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'swp_pemakaian' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'soft water pipeline pemakaian sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'cwgt_last' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'clean water ground tank sebelum tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'cwgt' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'clean water ground tank sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
            // 'cwgt_pemakaian' => [
            //     'rules' => 'required|numeric',
            //     'errors' => [
            //         'required' => 'clean water ground tank pemakaian sekarang tidak boleh kosong',
            //         'numeric' => 'yang diinput hanya boleh angka'
            //     ]
            // ],
        ])) {
            return redirect()->to('/airProses/edit/' . $this->request->getVar('id'))->withInput();
        }
        $this->airProsesModel->save([
            'id' => $id,
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'swp_last' => $this->request->getVar('swp_last'),
            'swp' => $this->request->getVar('swp'),
            'swp_pemakaian' => $this->request->getVar('swp_pemakaian'),
            'cwgt_last' => $this->request->getVar('cwgt_last'),
            'cwgt' => $this->request->getVar('cwgt'),
            'cwgt_pemakaian' => $this->request->getVar('cwgt_pemakaian'),
            'user' => $this->request->getVar('user')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/airProses');
    }
    //--------------------------------------------------------------------

    public function delete($id)
    {
        $this->airProsesModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/airProses');
    }
    //--------------------------------------------------------------------

    public function export()
    {
        $dataSumur = $this->airProsesModel->getAirProses();

        $spreadsheet = new Spreadsheet();
        //Tulis header atau nama kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:A2')->setCellValue('A1', 'Tanggal')
            ->mergeCells('B1:B2')->setCellValue('B1', 'Shift')
            ->mergeCells('C1:E1')->setCellValue('C1', 'Soft Water Pipeline')->setCellValue('C2', 'Sebelum')->setCellValue('D2', 'Sekarang')->setCellValue('E2', 'Pemakaian')
            ->mergeCells('F1:H1')->setCellValue('F1', 'Clean Water Ground Tank')->setCellValue('F2', 'Sebelum')->setCellValue('G2', 'Sekarang')->setCellValue('H2', 'Pemakaian')
            ->setCellValue('I1', 'User');

        $column = 3;
        //tulis data Air Sumur ke Cell
        foreach ($dataSumur as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['tanggal'])
                ->setCellValue('B' . $column, $data['shift'])
                ->setCellValue('C' . $column, $data['swp_last'])
                ->setCellValue('D' . $column, $data['swp'])
                ->setCellValue('E' . $column, $data['swp_pemakaian'])
                ->setCellValue('F' . $column, $data['cwgt_last'])
                ->setCellValue('G' . $column, $data['cwgt'])
                ->setCellValue('H' . $column, $data['cwgt_pemakaian'])
                ->setCellValue('I' . $column, $data['user']);
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
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(30);

        //tulis dalam format Xlsx
        $writer = new Xls($spreadsheet);
        $fileName = 'Data Air Proses';

        //Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xls');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
