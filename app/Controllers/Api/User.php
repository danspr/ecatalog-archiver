<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class User extends \App\Controllers\BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->auth = new Auth;
        $this->auth->isSessionExist();
        $this->userModel = new UserModel;
        $this->session = session();
    }

    public function getUserList(){
        try {
            $eoqList = $this->userModel->getUserList();
            $response = [
                'status' => 'success',
                'current_user_id' => $this->session->get('user_id'),
                'data' => $eoqList
            ];
            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getUserDetail(){
        try {
            $params = ['id'];
            if(!$this->validate($this->userValidation($params))){
                return $this->fail($this->validator->getErrors());
            }

            $data = $this->request->getGet();
            $userDetail = $this->userModel->getUserDetail($data['id']);
            if(!$userDetail){
                return $this->failNotFound('User not found');
            }
            $response = [
                'status' => 'success',
                'data' => $userDetail
            ];
            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function insertUser(){
        try {
            $params = ['full_name', 'username', 'password', 'role', 'status'];
            if(!$this->validate($this->userValidation($params))){
                return $this->fail($this->validator->getErrors());
            }

            $data = $this->request->getPost();
            $insertData = [
                'full_name' => $data['full_name'],
                'username' => $data['username'],
                'password' => $this->auth->getPasswordHash($data['password']),
                'role' => $data['role'],
                'status' => (isset($data['status'])) ? $data['status'] : 1,
            ];

            $checkUser = $this->userModel->getUserByUsername($data['username']);
            if($checkUser){
                return $this->failNotFound('Username already exist');
            }

            $this->userModel->insertUser($insertData);
            $response = [
                'status' => 'success',
                'message' => 'User added successfully'
            ];
            return $this->respond($response);

        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function updateUser(){
        try {
            $params = ['id', 'full_name', 'username', 'role', 'status'];
            if(!$this->validate($this->userValidation($params))){
                return $this->fail($this->validator->getErrors());
            }            

            $data = $this->request->getPost();
            $updateData = [
                'full_name' => $data['full_name'],
                'username' => $data['username'],
                'role' => $data['role'],
                'status' => (isset($data['status'])) ? $data['status'] : 1,
            ];

            $checkUser = $this->userModel->checkUsernameExist($data['username'], $data['id']);
            if($checkUser){
                return $this->failNotFound('Username already exist');
            }

            $this->userModel->updateUser($updateData, ['id' => $data['id']]);
            if($this->session->get('user_id') == $data['id']){
                $this->session->set('full_name', $data['full_name']);
                $this->session->set('username', $data['username']);
                $this->session->set('role', $data['role']);
            }

            $response = [
                'status' => 'success',
                'message' => 'User updated successfully'
            ];
            return $this->respond($response);

        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function deleteUser(){
        try {
            $params = ['id'];
            if(!$this->validate($this->userValidation($params))){
                return $this->fail($this->validator->getErrors());
            }

            $data = $this->request->getPost();
            $this->userModel->deleteUser(['id' => $data['id']]);
            $response = [
                'status' => 'success',
                'message' => 'User deleted successfully'
            ];
            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function changePassword(){
        try {
            $params = ['id', 'password'];
            if(!$this->validate($this->userValidation($params))){
                return $this->fail($this->validator->getErrors());
            }

            $data = $this->request->getPost();
            $this->userModel->updateUser(['password' => $this->auth->getPasswordHash($data['password'])], ['id' => $data['id']]);
            $response = [
                'status' => 'success',
                'message' => 'Password changed successfully'
            ];
            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getCurrentUser(){
        try {
            $currentUser = [
                'id' => $this->session->get('user_id'),
                'full_name' => $this->session->get('full_name'),
                'username' => $this->session->get('username'),
                'role' => $this->session->get('role')
            ];
            $response = [
                'status' => 'success',
                'data' => $currentUser
            ];
            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    private function userValidation($params){
        $rules = [
            'id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id is required',
                ]
            ],
            'full_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Full name is required',
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username is required',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password is required',
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role is required',
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status is required',
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