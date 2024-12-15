<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'report';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','file_name', 'file_path', 'report_type', 'created'];

    public function getReportList($where = []){
        return $this->select('id, file_name, file_path, created')->where($where)->orderBy('created', 'DESC')->findAll();
    }

    public function getReportById($id){
        return $this->select('id, file_name, file_path, created')->where('id', $id)->first();
    }

    public function insertReport($data){
        return $this->insert($data);
    }
}