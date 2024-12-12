<?php

namespace App\Controllers;

class Sirup extends BaseController
{

    public function __construct()
    {
        $auth = new Auth();
        $auth->isSessionExist();
    }
    
    public function index()
    {
        $pageName = 'Generate SIRUP Report';
        $pageView = [
            'pageName' => $pageName,
        ];
        $contents = view('pages/sirup/sirup_view', $pageView);
        $data = [
            ... $this->defaultDataView(),
            'pageTitle' => 'SIRUP Report | ' . getAppName(),
            'contents' => $contents,
            'vueScript' => 'assets/js/vue/app.sirup.js',
        ];

        return view('templates/main_view', $data);
    }
}
