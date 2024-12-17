<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use App\Models\ReportModel;
use App\Models\SirupModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Sirup extends \App\Controllers\BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->auth = new Auth;
        $this->auth->isSessionExist();
        $this->reportModel = new ReportModel;
        $this->sirupModel = new SirupModel;
        $this->activity = new ActivityLog;
        $this->session = session();
        $this->folderPath = 'uploads/sirup/';
    }

    public function exportToExcel(){
        try {
            $params = ['tahun', 'report'];
            if(!$this->validate($this->reportValidation($params))){
                return $this->fail($this->validator->getErrors());
            } 

            $data = $this->request->getPost();
            $fileName = 'sirup_' . $data['report'] . '_' . $data['tahun'] . '_' . time() . '.xlsx';
            $filePath = WRITEPATH . $this->folderPath . $fileName;

            if (!file_exists(WRITEPATH . $this->folderPath)) {
                mkdir(WRITEPATH . $this->folderPath, 0777, true);
            }
          
            $headers = $this->getReportHeaders($data['report']);
            $rowData1 = $this->sirupModel->getReportData($data['tahun'], $data['report']);
            $rowData2 = $this->sirupModel->getReportData($data['tahun'], 'rekap_updated');

            $spreadsheet = new Spreadsheet();
            $sheet1 = $spreadsheet->getActiveSheet();
            $sheet1->setTitle('Sirup Rekap (as is)');
            $sheet1->fromArray($headers, NULL, 'A1');
            $row = 2;
            foreach ($rowData1 as $entry) {
                $sheet1->fromArray(array_values($entry), NULL, 'A' . $row);
                $row++;
            }

            $sheet2 = $spreadsheet->createSheet();
            $sheet2->setTitle('Sirup Rekap (recalculated)');
            $sheet2->fromArray($headers, NULL, 'A1');
            $sheet2->fromArray($headers, NULL, 'A1');
            $row = 2;
            foreach ($rowData2 as $entry) {
                $sheet2->fromArray(array_values($entry), NULL, 'A' . $row);
                $row++;
            }

            $writer = new Xlsx($spreadsheet);
            $writer->save($filePath);

            $reportData = [
                'file_name' => $fileName,
                'file_path' => $this->folderPath.$fileName,
                'report_type' => 'sirup'
            ];
            $id = $this->reportModel->insert($reportData);

            $this->activity->insertActivityLog('success', 'Generate Sirup Report', 'Sirup Report generated successfully.');
            $response = [
                'status' => 'success',
                'data' => [
                    'id' => $id,
                    'file_name' => $fileName,
                    'report_type' => 'sirup',
                    'download_url' => base_url('api/report/'.$id.'/download')
                ]
            ];
            return $this->respond($response);
        } catch (\Exception $e) {
            $this->activity->insertActivityLog('error', 'Generate Report', 'Sirup Report generated failed: '.$e->getMessage());
            return $this->failServerError($e->getMessage());
        }
    }

    private function getReportHeaders($report){
        if($report == 'rekap'){
            return [
                'Kode Satker', 'Nama Satker', 'Penyedia Paket', 'Penyedia Pagu', 'Swakelola Paket', 'Swakelola Pagu', 
                'Penyedia Dalam Swakelola Paket', 'Penyedia Dalam Swakelola Pagu', 'Total Paket', 'Total Pagu'
            ];
        } else if($report == 'penyedia'){
            return [
                'Kode Satker', 'Nama Satker', 'Paket ID', 'Nama Paket', 'Pagu', 'Metode Pemilihan', 'Sumber Dana', 
                'Produk Dalam Negeri', 'Usaha Kecil Koperasi', 'MAK', 'Jenis Pengadaan'
            ];
        } else if($report == 'swakelola'){
            return [
                'Kode Satker', 'Nama Satker', 'Paket ID', 'Nama Paket', 'Kegiatan','Pagu', 'Tipe Swakelola', 'MAK'
            ];
        } else if($report == 'penyedia_dalam_swakelola'){
            return [
                'Kode Satker', 'Nama Satker', 'Paket ID', 'Nama Paket', 'Pagu', 'Metode Pemilihan', 'Sumber Dana', 'MAK'
            ];
        } 
    }

    private function reportValidation($params){
        $rules = [
            'id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id is required',
                ]
            ],
            'file_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'File Name is required',
                ]
            ],
            'file_path' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'File Path is required',
                ]
            ],
            'tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun is required',
                ]
            ],
            'report' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Report is required',
                ]
            ],
        ];
        if(!empty($params)){
            $getRule = [];
            foreach($params as $value){
                $getRule[$value] = $rules[$value];
            }
            return $getRule;
        }
        return $rules;
    }

}