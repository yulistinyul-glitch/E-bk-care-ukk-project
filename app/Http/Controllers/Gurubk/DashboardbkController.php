<?php

namespace App\Http\Controllers\Gurubk;

use App\Http\Controllers\Controller;

class DashboardbkController extends Controller
{
    public function dashboard()
    {
        return view('gurubk.dashboard');
    }
}
