<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function dashboardView()
    {
        $auth = new Auth();
        $auth->isSessionExist();

        $pageName = 'Dashboard';
        $pageView = [
            'pageName' => $pageName
        ];

        $contents = view('pages/dashboard/dashboard_view', $pageView);
        $data = [
            ... $this->defaultDataView(),
            'pageTitle' => 'Dashboard | ' . getAppName(),
            'contents' => $contents,
            'vueScript' => 'assets/js/vue/app.dashboard.js',
        ];

        return view('templates/main_view', $data);
    }
}
