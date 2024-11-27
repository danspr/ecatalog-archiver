<?php

namespace App\Controllers;

class Report extends BaseController
{

    public function __construct()
    {
        $auth = new Auth();
        $auth->isSessionExist();
    }
    
    public function index()
    {
        $pageName = 'Report';
        $pageView = [
            'pageName' => $pageName,
        ];
        $contents = view('pages/report/report_view', $pageView);
        $data = [
            ... $this->defaultDataView(),
            'pageTitle' => 'Report | ' . getAppName(),
            'contents' => $contents,
            'vueScript' => 'assets/js/vue/app.report.js',
        ];

        return view('templates/main_view', $data);
    }
}
