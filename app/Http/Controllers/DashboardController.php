<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Logika untuk mengambil data produk dari database
        $data = [
            'title'=>''
        ]; // Contoh data produk
        return view('dashboard.index', compact('data'));
    }
}
