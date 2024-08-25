<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FinalController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Wajib Pajak'
        ];
        return view('final.wajib_pajak', compact('data'));
    }

    public function getFinal()
    {
        $data = DB::table('potensi_pajak')
            ->select(
                'potensi_pajak.id',
                'potensi_pajak.nm_wp',
                'potensi_pajak.alamat_objek',
                'potensi_pajak.id_kec',
                'potensi_pajak.id_desa',
                'potensi_pajak.file_url',
                'potensi_pajak.created_at',
                'potensi_pajak.update_at',
                'potensi_pajak.validasi',
                'potensi_pajak.id_stak',
                'tbl_stakeholder.stakeholder',
                'tbl_stakeholder.created_at as stakeholder_created_at',
                'kecamatan.nm_kec',
                'desa.nm_desa',
                'tbl_jadwal.tgl',
                'tbl_jadwal.jam',
                'tbl_jadwal.catatan',
                'tbl_jadwal.file_path',
            )
            ->join('kecamatan', 'potensi_pajak.id_kec', '=', 'kecamatan.id')
            ->join('tbl_jadwal', 'potensi_pajak.id', '=', 'tbl_jadwal.id_potensi')
            ->join('desa', 'potensi_pajak.id_desa', '=', 'desa.id')
            ->join('tbl_stakeholder', 'potensi_pajak.id_stak', '=', 'tbl_stakeholder.id')
            ->join('data_survey', 'potensi_pajak.id', '=', 'data_survey.id_potensi_pajak')
            ->where('potensi_pajak.data', 1)
            ->orderBy('potensi_pajak.id', 'ASC')
            ->when(auth()->user()->role === 'stakeholder', function ($query) {
                return $query->where('potensi_pajak.id_stak', session('id_stak'));
            })
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }
}
