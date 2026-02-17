<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TemplateSuratController extends Controller
{
    public function index()
    {
        $templates = TemplateSurat::oldest()->paginate(10);
        return view('admin.template_surats.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.template_surats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_template' => 'required|string|max:100',
            'file'          => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $last = TemplateSurat::latest('id_template')->first();
        $lastNumber = $last ? (int) substr($last->id_template, 2) : 0;
        $id_template = 'TP' . str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);

        $file = $request->file('file');
        $filename = $id_template . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/template_surats', $filename);

        TemplateSurat::create([
            'id_template'   => $id_template,
            'id_admin'      => auth('admin')->user()->id_admin , 
            'nama_template' => $request->nama_template,
            'file'          => $filename,
        ]);

        return redirect()->route('admin.template_surats.index')
                         ->with('success', 'Template surat berhasil disimpan.');
    }

    public function edit($id)
    {
        $template = TemplateSurat::findOrFail($id);
        return view('admin.template_surats.edit', compact('template'));
    }

    public function update(Request $request, $id)
    {
        $template = TemplateSurat::findOrFail($id);

        $request->validate([
            'nama_template' => 'required|string|max:100',
            'file'          => 'nullable|mimes:pdf,doc,docx|max:2048',
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
        $template->save();

        return redirect()->route('admin.template_surats.index')
                         ->with('success', 'Template surat berhasil diperbarui.');
    }

    public function download($id)
    {
        $template = TemplateSurat::findOrFail($id);
        $filePath = storage_path("app/public/template_surats/{$template->file}");

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath);
    }

    public function destroy($id)
    {
        $template = TemplateSurat::findOrFail($id);

        if ($template->file && Storage::exists('public/template_surats/' . $template->file)) {
            Storage::delete('public/template_surats/' . $template->file);
        }

        $template->delete();

        return redirect()->route('admin.template_surats.index')
                         ->with('success', 'Template surat berhasil dihapus.');
    }
}
