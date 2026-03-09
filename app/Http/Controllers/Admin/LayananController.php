<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LayananController extends Controller
{
public function index() 
{
    $semua_layanan = Service::all();
    // Memanggil file: resources/views/admin/data/layanan.blade.php
    return view('admin.data.layanan', compact('semua_layanan'));
}

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required', 
            'icon' => 'required', 
            'description' => 'required'
        ]);
        $data['slug'] = Str::slug($request->title);
        Service::create($data);
        return back()->with('success', 'Layanan berhasil ditambah!');
    }

    public function update(Request $request, $id) {
        $item = Service::findOrFail($id);
        $item->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'icon' => $request->icon,
            'description' => $request->description,
        ]);
        return back()->with('success', 'Layanan berhasil diupdate!');
    }

    public function destroy($id) {
        Service::findOrFail($id)->delete();
        return back()->with('success', 'Layanan berhasil dihapus!');
    }
}