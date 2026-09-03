<?php

namespace App\Controllers;

use App\Models\AirBoilerModel;
use CodeIgniter\CodeIgniter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class AirBoiler extends BaseController
{
    protected $airBoilerModel;
    public function __construct()
    {
        $this->airBoilerModel = new AirBoilerModel();
    }
    //--------------------------------------------------------------------

    public function index()
    {
        $data = [
            'air_boiler' => $this->airBoilerModel->orderBy('id', 'DESC')->paginate(20),
            'pager' => $this->airBoilerModel->pager,
        ];

        return view('air-boiler/index', $data);
    }
    //--------------------------------------------------------------------

    public function add()
    {
        $data = [
            'validation' => \Config\Services::validation(),
        ];

        return view('air-boiler/add', $data);
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
        ])) {
            return redirect()->to('/airBoiler/add')->withInput();
        }

        $this->airBoilerModel->save([
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'ab_1_last' => $this->request->getVar('ab_1_last'),
            'ab_1' => $this->request->getVar('ab_1'),
            'ab_1_pemakaian' => $this->request->getVar('ab_1_pemakaian'),
            'ab_2_last' => $this->request->getVar('ab_2_last'),
            'ab_2' => $this->request->getVar('ab_2'),
            'ab_2_pemakaian' => $this->request->getVar('ab_2_pemakaian'),
            'ab_3_last' => $this->request->getVar('ab_3_last'),
            'ab_3' => $this->request->getVar('ab_3'),
            'ab_3_pemakaian' => $this->request->getVar('ab_3_pemakaian'),
            'user' => $this->request->getVar('user'),
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diinput.');

        return redirect()->to('/airBoiler');
    }
    //--------------------------------------------------------------------

    public function edit($id)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'air_boiler' => $this->airBoilerModel->getAirBoiler($id)
        ];

        return view('air-boiler/edit', $data);
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
        ])) {
            return redirect()->to('/airBoiler/edit/' . $this->request->getVar('id'))->withInput();
        }
        $this->airBoilerModel->save([
            'id' => $id,
            'tanggal' => $this->request->getVar('tanggal'),
            'shift' => $this->request->getVar('shift'),
            'ab_1_last' => $this->request->getVar('ab_1_last'),
            'ab_1' => $this->request->getVar('ab_1'),
            'ab_1_pemakaian' => $this->request->getVar('ab_1_pemakaian'),
            'ab_2_last' => $this->request->getVar('ab_2_last'),
            'ab_2' => $this->request->getVar('ab_2'),
            'ab_2_pemakaian' => $this->request->getVar('ab_2_pemakaian'),
            'ab_3_last' => $this->request->getVar('ab_3_last'),
            'ab_3' => $this->request->getVar('ab_3'),
            'ab_3_pemakaian' => $this->request->getVar('ab_3_pemakaian'),
            'user' => $this->request->getVar('user'),
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/airBoiler');
    }
    //--------------------------------------------------------------------

    public function delete($id)
    {
        $this->airBoilerModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/AirBoiler');
    }
    //--------------------------------------------------------------------

    public function export()
    {
        $dataAirBoiler = $this->airBoilerModel->getAirBoiler();

        $spreadsheet = new Spreadsheet();
        //Tulis header atau nama kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:A2')->setCellValue('A1', 'Tanggal')
            ->mergeCells('B1:B2')->setCellValue('B1', 'Shift')
            ->mergeCells('C1:E1')->setCellValue('C1', 'Air Boiler 1')->setCellValue('C2', 'Sebelum')->setCellValue('D2', 'Sekarang')->setCellValue('E2', 'Pemakaian')
            ->mergeCells('F1:H1')->setCellValue('F1', 'Air Boiler 2')->setCellValue('F2', 'Sebelum')->setCellValue('G2', 'Sekarang')->setCellValue('H2', 'Pemakaian')
            ->mergeCells('I1:K1')->setCellValue('I1', 'Air Boiler 3')->setCellValue('I2', 'Sebelum')->setCellValue('J2', 'Sekarang')->setCellValue('K2', 'Pemakaian')
            ->mergeCells('L1:L2')->setCellValue('L1', 'User');

        $column = 3;
        //tulis data Air Sumur ke Cell
        foreach ($dataAirBoiler as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['tanggal'])
                ->setCellValue('B' . $column, $data['shift'])
                ->setCellValue('C' . $column, $data['ab_1_last'])
                ->setCellValue('D' . $column, $data['ab_1'])
                ->setCellValue('E' . $column, $data['ab_1_pemakaian'])
                ->setCellValue('F' . $column, $data['ab_2_last'])
                ->setCellValue('G' . $column, $data['ab_2'])
                ->setCellValue('H' . $column, $data['ab_2_pemakaian'])
                ->setCellValue('I' . $column, $data['ab_3_last'])
                ->setCellValue('J' . $column, $data['ab_3'])
                ->setCellValue('K' . $column, $data['ab_3_pemakaian'])
                ->setCellValue('L' . $column, $data['user']);
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


        //tulis dalam format Xlsx
        $writer = new Xls($spreadsheet);
        $fileName = 'Data Air Boiler';

        //Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xls');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
