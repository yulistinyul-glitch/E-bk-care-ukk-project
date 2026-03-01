<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateSuratController extends Controller
{
    public function index()
    {
        $templates = TemplateSurat::oldest()->paginate(10);
        return view('admin.template_surats.index', compact('templates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_template'  => 'required|string|max:100',
            'jenis_template' => 'required|in:SP,UMUM', 
            'file'           => 'required|mimes:doc,docx,pdf|max:2048',
        ]);

        $last = TemplateSurat::withTrashed()->orderBy('id_template', 'desc')->first();
        $newNumber = $last ? ((int) substr($last->id_template, 2)) + 1 : 1;
        $id_template = 'TP' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $id_template . '_' . time() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('public/template_surats', $filename);

            TemplateSurat::create([
                'id_template'   => $id_template,
                'nama_template' => $request->nama_template,
                'jenis_template'=> $request->jenis_template, 
                'file'          => $filename,
            ]);
        }

        return redirect()->route('admin.template_surats.index')
            ->with('success', 'Template berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $template = TemplateSurat::findOrFail($id);
        
        $request->validate([
            'nama_template'  => 'required|string|max:100',
            'jenis_template' => 'required|in:SP,UMUM',
            'file'           => 'nullable|mimes:doc,docx,pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            if ($template->file && Storage::exists('public/template_surats/' . $template->file)) {
                Storage::delete('public/template_surats/' . $template->file);
            }
            
            $file = $request->file('file');
            $filename = $template->id_template . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/template_surats', $filename);
            $template->file = $filename;
        }

        $template->nama_template = $request->nama_template;
        $template->jenis_template = $request->jenis_template;
        $template->save();

        return redirect()->route('admin.template_surats.index')
            ->with('success', 'Template berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $template = TemplateSurat::where('id_template', $id)->firstOrFail();
        $template->delete();

        return redirect()->route('admin.template_surats.history')
            ->with('success', 'Data berhasil dipindahkan ke history');
    }

    public function history()
    {
        $templates = TemplateSurat::onlyTrashed()->oldest()->paginate(10);
        return view('admin.template_surats.history', compact('templates'));
    }

    public function restore($id)
    {
        $template = TemplateSurat::onlyTrashed()->where('id_template', $id)->firstOrFail();
        $template->restore();

        return redirect()->route('admin.template_surats.index')
            ->with('success', 'Template berhasil dikembalikan ke daftar aktif.');
    }

    public function forceDelete($id)
    {
        $template = TemplateSurat::onlyTrashed()->where('id_template', $id)->firstOrFail();
 
        if ($template->file && Storage::exists('public/template_surats/' . $template->file)) {
            Storage::delete('public/template_surats/' . $template->file);
        }

        $template->forceDelete();

        return redirect()->route('admin.template_surats.history')
            ->with('success', 'Template telah dihapus permanen dari database.');
    }
}