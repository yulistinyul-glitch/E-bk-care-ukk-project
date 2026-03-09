<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KotakSaranController extends Controller
{
    public function index() {
        $items = \App\Models\Suggestion::orderBy('order', 'asc')->get();
        return view('kotaksaran', compact('items')); // atau nama file view Anda
    }
}