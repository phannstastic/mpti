<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Gallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan 6 menu dan 6 galeri terbaru.
     */
    public function index()
    {
        // Ambil 6 menu terbaru
        $menuItems = MenuItem::latest()->take(6)->get();
        // Ambil 6 foto galeri terbaru
        $galleryItems = Gallery::latest()->take(6)->get();

        return view('restoran', compact('menuItems', 'galleryItems'));
    }

    /**
     * Menampilkan halaman dengan SEMUA menu.
     */
    public function showMenuPage()
    {
        $menuItems = MenuItem::latest()->paginate(9); // Paginate jika menu sangat banyak
        return view('menu', compact('menuItems'));
    }

    /**
     * Menampilkan halaman dengan SEMUA foto galeri.
     */
    public function showGalleryPage()
    {
        $galleryItems = Gallery::latest()->paginate(9); // Paginate jika galeri sangat banyak
        return view('galeri', compact('galleryItems'));
    }
}
