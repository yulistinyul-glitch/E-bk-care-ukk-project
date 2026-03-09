<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index() {
        $galleries = Gallery::latest()->get();
        return view('admin.data.galeri', compact('galleries'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'title' => $request->title,
            'image' => $path
        ]);

        return back()->with('success', 'Data berhasil ditambah!');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $gallery = Gallery::findOrFail($id);
        $data = ['title' => $request->title];

        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery->update($data);
        return back()->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id) {
        $gallery = Gallery::findOrFail($id);
        
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }
        
        $gallery->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }
}