<?php

namespace App\Http\Controllers\Stakeholder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        // Logika untuk mengambil data produk dari database
        $user = DB::table('users')
            ->join('tbl_stakeholder', 'users.id_stak', '=', 'tbl_stakeholder.id')
            ->where('tbl_stakeholder.id',session('id_stak'))
            ->first();
        $data = [
          
            'title' => 'Dashboard Stakeholder'
        ]; // Contoh data produkgih
        return view('stakeholder.dashboard', compact('data','user'));
    }
}
