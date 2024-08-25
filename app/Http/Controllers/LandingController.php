<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Logika untuk mengambil data produk dari database
        $data = [
            'title'=>'PIWARAAN'
        ]; // Contoh data produk
        return view('landing', compact('data'));
    }

}
