<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use App\Models\ReportModel;

class Report extends \App\Controllers\BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->auth = new Auth;
        $this->auth->isSessionExist();
        $this->reportModel = new ReportModel;
        $this->session = session();
    }

    public function getReportList(){
        try {
            $params = ['start_date', 'end_date'];
            if(!$this->validate($this->reportValidation($params))){
                $data = [
                    'start_date' => date('Y-m-d'),
                    'end_date' => date('Y-m-d')
                ];
            } else {
                $data = $this->request->getGet();
            }

            $where = [
                'cast(created as date) >=' => $data['start_date'],
                'cast(created as date) <=' => $data['end_date']
            ];
            $result = $this->reportModel->getReportList($where);

            $response = [
                'status' => 'success',
                'data' => $result
            ];
            return $this->respond($response);
        } catch (\Exception $e) {
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
                    'required' => 'file_name is required',
                ]
            ],
            'file_path' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'file_path is required',
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