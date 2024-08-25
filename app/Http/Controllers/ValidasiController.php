<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Service\UserController;
use App\Http\Controllers\Service\WaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ValidasiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Validasi Data Potensi Pajak'
        ];
        return view('validasi.index', compact('data'));
    }

    public function getDataAll()
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
            'desa.nm_desa'
        )
            ->join('kecamatan', 'potensi_pajak.id_kec', '=', 'kecamatan.id')
            ->join('desa', 'potensi_pajak.id_desa', '=', 'desa.id')
            ->join('tbl_stakeholder', 'potensi_pajak.id_stak', '=', 'tbl_stakeholder.id')
            ->where('potensi_pajak.validasi',0)
            ->orderBy('potensi_pajak.id','DESC')
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->input('validasi');

        $data = DB::table('potensi_pajak')->find($id);

        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404); // 404: Not Found
        }

        try {
            DB::table('potensi_pajak')
                ->where('id', $id)
                ->update([
                    'validasi' => $validasi,
                ]);

                $waController = new WaController();
                $getUser = new UserController();
                $user = $getUser->getUser($data->id_user);
                if($validasi==1){
                    $waController->sendMessage($user->no_hp, 'Laporan potensi pajak Anda telah kami Verifikasi'); 
                }else if($validasi==2){
                    $waController->sendMessage($user->no_hp, 'Laporan potensi pajak Anda ditolak');
                }
                

            return response()->json(['success' => true, 'message' => 'Berhasil Validasi'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal Validasi'], 500); // 500: Internal Server Error
        }
    }
}
