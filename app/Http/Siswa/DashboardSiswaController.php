<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;

class DashboardSiswaController extends Controller
{
    public function dashboard()
    {
        return view('siswa.home');
    }
}
