<?php
namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index(): string
    {
        // في المستقبل، سنمرر بيانات إلى الواجهة من هنا
        return view('dashboard_view');
    }
}