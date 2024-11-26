<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }

    public function loginView(): string
    {
        $data = [
            'pageTitle' => 'Sign In | ' . getAppName(),
            'vueScript' => 'assets/js/vue/smarteoq.login.js',
        ];
        return view('pages/auth/login_view', $data);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }

    public function isSessionExist()
    {
        if(!$this->session->has('user_id')){ 
            $URI = base_url('/login');
            header('Location: '.$URI);
            exit();
        }
    }

}
