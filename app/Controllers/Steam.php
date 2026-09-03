<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SteamModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Steam extends BaseController
{
    protected $steamModel;
    public function __construct()
    {
        $this->steamModel = new SteamModel();
    }
    //--------------------------------------------------------------------

    public function index()
    {
        $data['steam'] = $this->steamModel->orderBy('id', 'DESC')->paginate(20);
        $data['pager'] = $this->steamModel->pager;
        return view('steam/index', $data);
    }

    //--------------------------------------------------------------------
    public function add()
    {
        $data = [
            'validation' => \Config\Services::validation(),
        ];

        // return view('air/tambah', $data);
        return view('steam/add', $data);
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
        ])) {
            return redirect()->to('/steam/add')->withInput();
        }
        $this->steamModel->save([
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'steam_induk_last' => $this->request->getVar('steam_induk_last'),
            'steam_induk' => $this->request->getVar('steam_induk'),
            'steam_induk_pemakaian' => $this->request->getVar('steam_induk_pemakaian'),
            'steam_con_dyeing_last' => $this->request->getVar('steam_con_dyeing_last'),
            'steam_con_dyeing' => $this->request->getVar('steam_con_dyeing'),
            'steam_con_dyeing_pemakaian' => $this->request->getVar('steam_con_dyeing_pemakaian'),
            'user' => $this->request->getVar('user'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambah.');

        return redirect()->to('/steam');
    }
    //--------------------------------------------------------------------

    public function edit($id)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'steam' => $this->steamModel->getSteam($id)
        ];

        return view('steam/edit', $data);
    }

    public function  update($id)
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
        ])) {
            return redirect()->to('/steam/edit/' . $this->request->getVar('id'))->withInput();
        }
        $this->steamModel->save([
            'id' => $id,
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'steam_induk_last' => $this->request->getVar('steam_induk_last'),
            'steam_induk' => $this->request->getVar('steam_induk'),
            'steam_induk_pemakaian' => $this->request->getVar('steam_induk_pemakaian'),
            'steam_con_dyeing_last' => $this->request->getVar('steam_con_dyeing_last'),
            'steam_con_dyeing' => $this->request->getVar('steam_con_dyeing'),
            'steam_con_dyeing_pemakaian' => $this->request->getVar('steam_con_dyeing_pemakaian'),
            'user' => $this->request->getVar('user'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diupdate.');

        return redirect()->to('/steam');
    }

    public function delete($id)
    {
        $this->steamModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/steam');
    }
    //--------------------------------------------------------------------

    public function export()
    {
        $dataSteam = $this->steamModel->getSteam();

        $spreadsheet = new Spreadsheet();
        //Tulis header atau nama kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:A2')->setCellValue('A1', 'Tanggal')
            ->mergeCells('B1:B2')->setCellValue('B1', 'Shift')
            ->mergeCells('C1:E1')->setCellValue('C1', 'Steam Induk')->setCellValue('C2', 'Sebelum')->setCellValue('D2', 'Sekarang')->setCellValue('E2', 'Pemakaian')
            ->mergeCells('F1:H1')->setCellValue('F1', 'Steam Continous Dyeing')->setCellValue('F2', 'Sebelum')->setCellValue('G2', 'Sekarang')->setCellValue('H2', 'Pemakaian')
            ->mergeCells('I1:I2')->setCellValue('I1', 'User');

        $column = 3;
        //tulis data Air Sumur ke Cell
        foreach ($dataSteam as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['tanggal'])
                ->setCellValue('B' . $column, $data['shift'])
                ->setCellValue('C' . $column, $data['steam_induk_last'])
                ->setCellValue('D' . $column, $data['steam_induk'])
                ->setCellValue('E' . $column, $data['steam_induk_pemakaian'])
                ->setCellValue('F' . $column, $data['steam_con_dyeing_last'])
                ->setCellValue('G' . $column, $data['steam_con_dyeing'])
                ->setCellValue('H' . $column, $data['steam_con_dyeing_pemakaian'])
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
        $fileName = 'Data Steam';

        //Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xls');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
