<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Tambahkan baris ini (sesuaikan jika path model Anda berbeda):
use App\Models\Gallery; 

class GalleryController extends Controller
{
    public function index() {
        $galleries = Gallery::latest()->get(); 
        return view('galeri', compact('galleries'));
    }
}