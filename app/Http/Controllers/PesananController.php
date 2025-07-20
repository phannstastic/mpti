<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::latest()->get()->groupBy('category');

        // Pastikan nama di dalam compact() sudah benar 'menuItems'
        return view('pesanan', compact('menuItems'));
    }
}
