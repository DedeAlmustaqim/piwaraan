<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Service\UserController;
use App\Http\Controllers\Service\WaController;
use App\Models\PotensiPajakModel;
use Illuminate\Support\Facades\Validator; // Pastikan Validator diimpor
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables; // Pastikan ini benar


class PendataanController extends Controller
{
    public function index()
    {
        // Logika untuk mengambil data produk dari database
        $data = [
            'title' => 'Pendataan Potensi Pajak'
        ]; // Contoh data produk
        return view('pendataan.index', compact('data'));
    }

    public function valid()
    {
        // Logika untuk mengambil data produk dari database
        $data = [
            'title' => 'Pendataan Potensi Pajak Telah Validasi'
        ]; // Contoh data produk
        return view('pendataan.valid', compact('data'));
    }

    public function reject()
    {
        // Logika untuk mengambil data produk dari database
        $data = [
            'title' => 'Pendataan Potensi Pajak dibatalkan'
        ]; // Contoh data produk
        return view('pendataan.reject', compact('data'));
    }

    public function getDataAll()
    {
        $data = DB::table('potensi_pajak')
            ->join('kecamatan', 'potensi_pajak.id_kec', '=', 'kecamatan.id')
            ->join('desa', 'potensi_pajak.id_desa', '=', 'desa.id')
            ->join('tbl_stakeholder', 'potensi_pajak.id_stak', '=', 'tbl_stakeholder.id')
            ->select('*')

            ->orderBy('potensi_pajak.id', 'DESC')
            ->when(auth()->user()->role === 'stakeholder', function ($query) {
                return $query->where('potensi_pajak.id_stak', session('id_stak'));
            })
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getDataValid()
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
            ->where('potensi_pajak.validasi', 1)
            ->orderBy('potensi_pajak.id', 'DESC')
            ->when(auth()->user()->role === 'stakeholder', function ($query) {
                return $query->where('potensi_pajak.id_stak', session('id_stak'));
            })
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getDataReject()
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
            ->where('potensi_pajak.validasi', 2)
            ->orderBy('potensi_pajak.id', 'DESC')
            ->when(auth()->user()->role === 'stakeholder', function ($query) {
                return $query->where('potensi_pajak.id_stak', session('id_stak'));
            })
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request): JsonResponse
    {
        // Update validasi untuk mendukung field tambahan dan file gambar/PDF
        $validator = Validator::make($request->all(), [
            'id_stak' => 'required|integer',
            'nm_wp' => 'required|string|max:255',
            'alamat_objek' => 'required|string|max:255',
            'id_kec' => 'required|integer',
            'id_desa' => 'required|integer',
            'file_dukung' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:2048', // Tambahkan 'pdf' di sini
        ], [
            'id_stak.required' => 'Kolom ID STAK harus diisi.',
            'id_stak.integer' => 'Kolom ID STAK harus berupa angka.',
            'nm_wp.required' => 'Kolom Nama Wajib Pajak harus diisi.',
            'nm_wp.string' => 'Kolom Nama Wajib Pajak harus berupa teks.',
            'nm_wp.max' => 'Kolom Nama Wajib Pajak tidak boleh lebih dari :max karakter.',
            'alamat_objek.required' => 'Kolom Alamat Objek harus diisi.',
            'alamat_objek.string' => 'Kolom Alamat Objek harus berupa teks.',
            'alamat_objek.max' => 'Kolom Alamat Objek tidak boleh lebih dari :max karakter.',
            'id_kec.required' => 'Kolom ID Kecamatan harus diisi.',
            'id_kec.integer' => 'Kolom ID Kecamatan harus berupa angka.',
            'id_desa.required' => 'Kolom ID Desa harus diisi.',
            'id_desa.integer' => 'Kolom ID Desa harus berupa angka.',
            'file_dukung.required' => 'Kolom File Dukung harus diisi.',
            'file_dukung.file' => 'Kolom File Dukung harus berupa file.',
            'file_dukung.mimes' => 'File Dukung harus dalam format: jpeg, png, jpg, gif, pdf.',
            'file_dukung.max' => 'Ukuran File Dukung tidak boleh lebih dari :max kilobita.',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->messages() as $field => $message) {
                $errors[] = [
                    'field' => $field,
                    'message' => $message[0]
                ];
            }
            return response()->json([
                'success' => false,
                'errors' => $errors
            ],); // 422: Unprocessable Entity
        }

        // Dapatkan input dari request
        $id_user = $request->input('id_user_potensi');
        $id_stak = $request->input('id_stak');
        $nm_wp = $request->input('nm_wp');
        $alamat_objek = $request->input('alamat_objek');
        $id_kec = $request->input('id_kec');
        $id_desa = $request->input('id_desa');
        $file = $request->file('file_dukung'); // Ganti 'image' dengan 'file'
        $filePath = 'storage/bukti_dukung/';
        $fileName = time() . '.' . $file->getClientOriginalExtension(); // Nama file dengan timestamp

        // Simpan file
        $file->move($filePath, $fileName);
        $fileUrl = URL::to('/' . $filePath . $fileName);

        try {
            DB::table('potensi_pajak')->insert([
                'id_stak' => $id_stak,
                'nm_wp' => $nm_wp,
                'alamat_objek' => $alamat_objek,
                'id_kec' => $id_kec,
                'id_desa' => $id_desa,
                'id_user' => $id_user,
                'file_url' => $fileUrl, // Menyimpan URL lengkap dari file
            ]);

            $waController = new WaController();
            $getUser = new UserController();
            $user = $getUser->getUser($id_user);
            $waController->sendMessage($user->no_hp, 'Terima kasih telah melaporkan potensi pajak ' . $nm_wp . ' kepada kami');

            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']); // 201: Created
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan data']); // 500: Internal Server Error
        }
    }
}
