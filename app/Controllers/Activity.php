<?php

namespace App\Controllers;

class Activity extends BaseController
{

    public function __construct()
    {
        $auth = new Auth();
        $auth->isSessionExist();
    }
    
    public function index()
    {
        $pageName = 'Activity Log';
        $pageView = [
            'pageName' => $pageName,
        ];

        $contents = view('pages/activity/activity_view', $pageView);
        $data = [
            ... $this->defaultDataView(),
            'pageTitle' => 'Activity Log | ' . getAppName(),
            'contents' => $contents,
            'vueScript' => 'assets/js/vue/app.activity.js',
        ];

        return view('templates/main_view', $data);
    }
}
