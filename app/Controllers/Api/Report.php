<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use App\Models\ReportModel;
use App\Models\TransactionModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends \App\Controllers\BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->auth = new Auth;
        $this->auth->isSessionExist();
        $this->reportModel = new ReportModel;
        $this->transactionModel = new TransactionModel;
        $this->activity = new ActivityLog;
        $this->session = session();
        $this->folderPath = 'uploads/epurchasing/';
    }

    public function getReportList(){
        try {
            $reportType = $this->request->getGet('type');
            $result = $this->reportModel->getReportList(['report_type' => $reportType]);
            $response = [
                'status' => 'success',
                'data' => $result
            ];
            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getNomorPaket(){
        try {
            $nomorPaket = '';
            if($this->request->getGet('nomor_paket')){
                $nomorPaket = $this->request->getGet('nomor_paket');
            }

            $result = $this->transactionModel->getNamaPaket($nomorPaket);
            $response = [
                'status' => 'success',
                'data' => $result
            ];
            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function downloadFile($id){
        try {
            $report = $this->reportModel->getReportById($id);
            if(!$report){
                return $this->failNotFound('File not found');
            }

            $filePath = WRITEPATH . $report['file_path'];
            if (!file_exists($filePath)) {
                return $this->failNotFound($filePath);
            }

            $this->activity->insertActivityLog('success', 'Download Report', 'User download report successfully.');
            return $this->response->download($filePath, null)->setFileName($report['file_name']);
        } catch (\Exception $e) {
            $this->activity->insertActivityLog('error', 'Download Report', 'User download report failed: ' . $e->getMessage());
            return $this->failServerError($e->getMessage());
        }
    }

    public function exportToExcel(){
        try {
            $params = ['nomor_paket'];
            if(!$this->validate($this->reportValidation($params))){
                return $this->fail($this->validator->getErrors());
            } 

            $data = $this->request->getPost();
            $fileName = 'epurchasing_transaction_' . $data['nomor_paket'] . '_' . time() . '.xlsx';
            $filePath = WRITEPATH . $this->folderPath . $fileName;

            if (!file_exists(WRITEPATH . $this->folderPath)) {
                mkdir(WRITEPATH . $this->folderPath, 0777, true);
            }

            $transactionData = $this->transactionModel->getTransaction($data['nomor_paket']);
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $headers = [
                'Pengelola', 'Instansi Pembeli', 'Satuan Kerja', 'Jenis Katalog',
                'Etalase', 'Tanggal Paket', 'Nomor Paket', 'Nama Paket', 'RUP ID',
                'Nama Manufaktur', 'Kategori LV1', 'Kategori LV2', 'Nama Produk',
                'Jenis Produk', 'Nama Penyedia', 'Status UMKM', 'Nama Pelaksana Pekerjaan',
                'Status Paket', 'Kuantitas Produk', 'Harga Satuan Produk',
                'Harga Ongkos Kirim', 'Total Harga Produk', 'TKDN', 'BMP', 'TKDN BMP'
            ];
            $sheet->fromArray($headers, NULL, 'A1');

            $row = 2;
            foreach ($transactionData as $entry) {
                $sheet->fromArray(array_values($entry), NULL, 'A' . $row);
                $row++;
            }

            $writer = new Xlsx($spreadsheet);
            $writer->save($filePath);

            $reportData = [
                'file_name' => $fileName,
                'file_path' => $this->folderPath.$fileName,
            ];
            $id = $this->reportModel->insert($reportData);

            $this->activity->insertActivityLog('success', 'Generate Report', 'Report generated successfully.');
            $response = [
                'status' => 'success',
                'data' => [
                    'id' => $id,
                    'file_name' => $fileName,
                    'report_type' => 'epurchasing',
                    'download_url' => base_url('api/report/'.$id.'/download')
                ]
            ];
            return $this->respond($response);
        } catch (\Exception $e) {
            $this->activity->insertActivityLog('error', 'Generate Report', 'Report generated failed: '.$e->getMessage());
            return $this->failServerError($e->getMessage());
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
            'start_date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Start Date is required',
                ]
            ],
            'end_date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'End Date is required',
                ]
            ],
            'nomor_paket' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Paket is required',
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