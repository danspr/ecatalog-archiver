<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use App\Models\ReportModel;
use App\Models\TransactionModel;
use App\Models\SirupModel;
use App\Models\ActivityLogModel;

class Dashboard extends \App\Controllers\BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->auth = new Auth;
        $this->auth->isSessionExist();
        $this->reportModel = new ReportModel;
        $this->transactionModel = new TransactionModel;
        $this->activityModel = new ActivityLogModel;
        $this->sirupModel = new SirupModel;
        $this->session = session();
    }

    public function getTotalRecords(){
        try {
            $result = [
                'total_transaction' => $this->transactionModel->like('satuan_kerja', 'TNI AD', 'both')->countAllResults(),
                'total_penyedia' => $this->sirupModel->getSirupPenyediaCount(date('Y')),
                'total_swakelola' => $this->sirupModel->getSirupSwakelolaCount(date('Y')),
            ];
            $response = [
                'status' => 'success',
                'data' => $result
            ];
            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getOverview($period = 'last_week')
    {
        $result = $this->transactionModel->getDashboardOverview($period);
        $response = [
            'status' => 'success',
            'data' => $result
        ];
        return $this->respond($response);
    }

    public function getRecentActivity(){
        try {
            $result = $this->activityModel->getRecentActivity();
            $response = [
                'status' => 'success',
                'data' => $result
            ];
            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }
}