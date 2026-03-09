<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    public function edit()
    {
        $data = About::first() ?? new About();
        return view('admin.data.tentang', compact('data'));
    }

    public function update(Request $request)
    {
        $data = About::firstOrNew(['id' => 1]);
        $data->fill($request->except(['foto_visi', 'foto_misi']));


        if ($request->hasFile('foto_visi')) {
            $path = $request->file('foto_visi')->store('tentang', 'public');
            $data->foto_visi = $path;
        }

        if ($request->hasFile('foto_misi')) {
            $path = $request->file('foto_misi')->store('tentang', 'public');
            $data->foto_misi = $path;
        }

        $data->save();
        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }
}