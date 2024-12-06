<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use App\Models\ActivityLogModel;

class ActivityLog extends \App\Controllers\BaseController
{
    use ResponseTrait;

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
}