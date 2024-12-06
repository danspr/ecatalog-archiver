<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table      = 'activity_log';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'datetime', 'username', 'activity', 'result', 'detail'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created';
    protected $updatedField  = 'modified';

    public function getRecentActivity(){
        return $this->select('id, datetime, username, activity, result, detail')
            ->orderBy('created', 'DESC')
            ->limit(10)
            ->get()
            ->getResultArray();
    }
}