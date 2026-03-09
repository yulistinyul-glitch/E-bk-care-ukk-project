<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SaranController extends Controller
{
    public function index()
    {
        $items = Suggestion::orderBy('section')->orderBy('order', 'asc')->get();
        return view('admin.data.kotaksaran', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'section'     => 'required|string',
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'order'       => 'nullable|integer',
            'icon'        => 'nullable|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video'       => 'nullable|mimes:mp4,mov,ogg|max:10240',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('content', 'public');
        }

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('content', 'public');
        }

        Suggestion::create($data);
        return back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $item = Suggestion::findOrFail($id);
        
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'order'       => 'nullable|integer',
            'icon'        => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video'       => 'nullable|mimes:mp4,mov,ogg|max:10240',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image) Storage::disk('public')->delete($item->image);
            $data['image'] = $request->file('image')->store('content', 'public');
        }

        if ($request->hasFile('video')) {
            if ($item->video) Storage::disk('public')->delete($item->video);
            $data['video'] = $request->file('video')->store('content', 'public');
        }

        $item->update($data);
        return back()->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = Suggestion::findOrFail($id);

        // Hapus file fisik dari storage
        if ($item->image) Storage::disk('public')->delete($item->image);
        if ($item->video) Storage::disk('public')->delete($item->video);

        $item->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }
}