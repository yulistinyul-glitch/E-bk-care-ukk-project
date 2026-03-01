<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    public function index()
    {
        $aboutData = About::first();
        return view('tentang', compact('aboutData'));
    }
}