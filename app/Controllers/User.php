<?php

namespace App\Controllers;

class User extends BaseController
{

    public function __construct()
    {
        $auth = new Auth();
        $auth->isSessionExist();
    }
    
    public function index()
    {
        $pageName = 'User Management';
        $pageView = [
            'pageName' => $pageName,
        ];

        $contents = view('pages/user/user_view', $pageView);
        $data = [
            ... $this->defaultDataView(),
            'pageTitle' => 'User Management | ' . getAppName(),
            'contents' => $contents,
            'vueScript' => 'assets/js/vue/smarteoq.user.js',
        ];

        return view('templates/main_view', $data);
    }
}
