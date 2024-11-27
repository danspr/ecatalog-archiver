<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','full_name', 'username', 'password', 'role', 'status'];

    public function getSessionUserInfo($id){
        return $this->select('id, full_name, username, role')->where(['id' => $id])->first();
    }

    public function getUserLogin($username){
        $userFilter = $this->getActiveUserFilter();
        $userFilter['username'] = $username;
        return $this->select('id, full_name, username, password')->where($userFilter)->first();
    }

    private function getActiveUserFilter(){
        $filter = [
            'status' => 1,
        ];
        return $filter;
    }

    public function getUserList(){
        return $this->select('id, full_name, username, role, status')->findAll();
    }

    public function getUserDetail($id){
        return $this->select('id, full_name, username, password, role, status')->where(['id' => $id])->first();
    }

    public function getUserByUsername($username){
        return $this->select('id, full_name, username, password')->where(['username' => $username])->first();
    }

    public function checkUsernameExist($username, $id){
        $userFilter['username'] = $username;
        $userFilter['id !='] = $id;
        return $this->select('id, full_name, username, password')->where($userFilter)->first();
    }

    public function insertUser($data){
        return $this->insert($data);
    }

    public function updateUser($data, $where){
        return $this->update($where, $data);
    }

    public function deleteUser($where){
        return $this->delete($where);
    }

}