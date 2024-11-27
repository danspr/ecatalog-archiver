<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class Auth extends \App\Controllers\BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->session = session();
        $this->userModel = new UserModel;
    }

    public function isSessionExist(){
        if(!$this->session->has('user_id')){
            $this->session->destroy();
            return $this->failUnauthorized('Session expired. Please log in again.');
            exit;
        }
    }

    public function signin(){
        try {
            if(!$this->validate($this->signinValidation())){
                return $this->fail($this->validator->getErrors());
            }

            $data = $this->request->getPost();
            $user = $this->userModel->getUserLogin($data['username']);
            if(!$user){
                return $this->fail(getString('error.login_failed'));
            }
            if(!password_verify($data['password'], $user['password'])){
                return $this->fail(getString('error.login_failed'));
            }
            $this->createSession($user['id']);
            
            $response = [
                'status' => 'success',
                'message' => getString('success.login')
            ];
            return $this->respond($response);

        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function signout(){
        $this->session->destroy();
        $response = [
            'status' => 'success',
            'message' => getString('success.logout')
        ];
        return $this->respond($response);
    }

    public function getPassword(){
        $data = $this->request->getPost();
        $response = [
            'status' => 'success',
            'password' => $this->getPasswordHash($data['password'])
        ];
        return $this->respond($response);
    }

    private function createSession($userId){
        $user = $this->userModel->getSessionUserInfo($userId);
        $sessionData = [
            'user_id' => $user['id'],
            'full_name' => $user['full_name'],
            'username' => $user['username'],
            'role' => $user['role'],
            'logged_in' => true
        ];
        $this->session->set($sessionData);
    }

    public function getPasswordHash($plainPassword){
        $option = [
            'cost' => 12
        ];
        return password_hash($plainPassword, PASSWORD_BCRYPT, $option);
    }

    private function signinValidation(){
        $rules = [
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
            ]
        ];
        return $rules;
    }
    

}