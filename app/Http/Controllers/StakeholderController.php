<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class StakeholderController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelola Stakeholder'
        ];
        return view('stakeholder.index', compact('data'));
    }

    public function getDatatables()
    {
        $data = DB::table('tbl_stakeholder')
            ->select(
                'tbl_stakeholder.id',
                'tbl_stakeholder.stakeholder',
                'tbl_stakeholder.created_at',
            )
            //->join('table_2', 'table.id_kec', '=', 'table_2.id')
            // ->where('table.id', $where)
            ->orderBy('tbl_stakeholder.id', 'ASC')
            //Gunakan kondisi sesuai role login
            //->when(auth()->user()->role === 'role', function ($query) {
            //return $query->where('table.role', session('role'));
            //})
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'stak' => 'required',
            ],
            [
                'stak.required' => 'Kolom Stakeholder wajib diisi.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }


        $stak = $request->input('stak');

        //Custome Array
        //if (array_key_exists('input_name', $validatedData)) {
        // $validatedData['input_name'] =  .... ;
        //}
        try {
            DB::table('tbl_stakeholder')->insert(
                [
                    'stakeholder' => $stak
                ]
            );
            return response()->json(['success' => true, 'message' => 'Success']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed' . $e]);
        }
    }

    public function destroy($id)
    {
        $product = DB::table('tbl_stakeholder')->find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404); // 404: Not Found
        }

        try {
            DB::table('tbl_stakeholder')->where('id', $id)->delete();

            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus produk'], 500); // 500: Internal Server Error
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'stakholder_edit' => 'required|string',
        ]);
    
        $stak = $request->input('stakholder_edit');
    
        $data = DB::table('tbl_stakeholder')->find($id);
    
        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
        }
    
        try {
            DB::table('tbl_stakeholder')
                ->where('id', $id)
                ->update([
                    'stakeholder' => $stak,
                ]);
    
            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui data: ' . $e->getMessage()]);
        }
    }
    
}
