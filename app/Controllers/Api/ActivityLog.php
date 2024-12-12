<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use App\Models\ActivityLogModel;

class ActivityLog extends \App\Controllers\BaseController
{
    use ResponseTrait;

    public function getActivityLog(){
        try {
            $this->auth = new Auth;
            $this->auth->isSessionExist();

            $params = ['start_date', 'end_date'];
            if(!$this->validate($this->formValidation($params))){
                return $this->fail($this->validator->getErrors());
            }

            $data = $this->request->getGet();
            $where = [
                'cast(datetime as date) >=' => $data['start_date'],
                'cast(datetime as date) <=' => $data['end_date']
            ];

            $activityLogModel = new ActivityLogModel();
            $result = $activityLogModel->where($where)->get()->getResultArray();

            $response = [
                'status' => 'success',
                'data' => $result
            ];
            return $this->respond($response);

        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    public function insertActivityLog($result, $activity, $detail)
    {
        $this->auth = new Auth;
        $this->auth->isSessionExist();
        $this->session = session();
        
        $activityLogModel = new ActivityLogModel();
        $data = [
            'datetime' => date('Y-m-d H:i:s'),
            'username' => ($this->session->has('username')) ? $this->session->get('username') : 'system',
            'activity' => $activity,
            'result'   => $result,
            'detail'   => $detail
        ];

        $activityLogModel->insert($data);
    }

    private function formValidation($params){
        $rules = [
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