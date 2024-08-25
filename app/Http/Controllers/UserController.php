<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelola Pengguna'
        ];
        return view('user.index', compact('data'));
    }

    public function getDatatables()
    {
        $data = DB::table('users')
            ->select(
                'users.id as id',
                'users.name',
                'users.no_hp',
                'users.active',
                'tbl_stakeholder.stakeholder',
            )
            ->join('tbl_stakeholder', 'users.id_stak', '=', 'tbl_stakeholder.id')
            // ->where('table.id', $where)
            ->orderBy('users.id', 'ASC')
            //Gunakan kondisi sesuai role login
            //->when(auth()->user()->role === 'role', function ($query) {
            //return $query->where('table.role', session('role'));
            //})
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }
}
