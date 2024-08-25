<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Service\UserController;
use App\Http\Controllers\Service\WaController;
use Barryvdh\DomPDF\Facade\Pdf;
use Faker\Extension\Helper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class SurveyController extends Controller
{
    public function jadwal()
    {
        $data = [
            'title' => 'Jadwal Survey'
        ];
        return view('survey.jadwal', compact('data'));
    }

    public function terjadwal()
    {
        $data = [
            'title' => 'Survey Terjadwal'
        ];
        return view('survey.terjadwal', compact('data'));
    }

    public function data_survey()
    {
        $data = [
            'title' => 'Data Survey'
        ];
        return view('survey.data_survey', compact('data'));
    }

    public function getjadwal()
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
            ->where('potensi_pajak.jadwal', 0)
            ->orderBy('potensi_pajak.id', 'DESC')
            ->when(auth()->user()->role === 'stakeholder', function ($query) {
                return $query->where('potensi_pajak.id_stak', session('id_stak'));
            })
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getTerjadwal()
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
            ->where('potensi_pajak.validasi', 1)
            ->where('potensi_pajak.jadwal', 1)
            ->orderBy('potensi_pajak.id', 'DESC')
            ->when(auth()->user()->role === 'stakeholder', function ($query) {
                return $query->where('potensi_pajak.id_stak', session('id_stak'));
            })
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getDataSurvey()
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
            ->where('potensi_pajak.validasi', 1)
            ->where('potensi_pajak.data', 0)
            ->orderBy('potensi_pajak.id', 'DESC')
            ->when(auth()->user()->role === 'stakeholder', function ($query) {
                return $query->where('potensi_pajak.id_stak', session('id_stak'));
            })
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }

    public function penetapanJadwal(Request $request)
    {
        $potensi = DB::table('potensi_pajak')->where('id', $request->input('id_potensi_jadwal'))->first();

        // $waController = new WaController();
        // $getUser = new UserController();
        // $user = $getUser->getUser($potensi->id_user);
        // $msg = $user->no_hp. 'Kami telah menjadwalkan Survey Lapangan berdasarkan laporan Potensi Pajak Anda\n2
        // Berikut jadwal yang telah kami tetapkan\n2' . $request->input('date_jadwal') . $request->input('time_jadwal') . '\n2Login ke akun Anda untuk informasi lebih lengkap';
        // dd($msg);
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_potensi_jadwal' => 'required|integer',
            'date_jadwal' => 'required|date',
            'time_jadwal' => 'required|date_format:H:i',
            'catatan_jadwal' => 'required|max:1000',
            'lampiran_jadwal' => 'nullable|file|max:2048|mimes:jpg,jpeg,png,pdf',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        // Proses file lampiran jika diunggah
        $imgPath = null;
        if ($request->hasFile('lampiran_jadwal')) {
            $file = $request->file('lampiran_jadwal');
            $filePath = 'storage/jadwal/';
            $fileName = time() . '.' . $file->getClientOriginalExtension(); // Nama file dengan timestamp

            // Simpan file
            $file->move($filePath, $fileName);
            $fileUrl = URL::to('/' . $filePath . $fileName);
        }

        // Data yang akan disimpan atau diperbarui
        $data = [
            'id_potensi' => $request->input('id_potensi_jadwal'),
            'tgl' => $request->input('date_jadwal'),
            'jam' => $request->input('time_jadwal'),
            'catatan' => $request->input('catatan_jadwal'),
            'file_path' => $fileUrl ?? null,
        ];

        // Periksa apakah id_potensi_jadwal sudah ada dalam tbl_jadwal
        $existing = DB::table('tbl_jadwal')->where('id_potensi', $request->input('id_potensi_jadwal'))->first();

        if ($existing) {
            // Jika sudah ada, lakukan update
            $result = DB::table('tbl_jadwal')
                ->where('id_potensi', $request->input('id_potensi_jadwal'))
                ->update($data);
        } else {
            // Jika belum ada, lakukan insert
            $result = DB::table('tbl_jadwal')->insert($data);
        }
        $potensi = DB::table('potensi_pajak')->where('id', $request->input('id_potensi_jadwal'))->first();

        $waController = new WaController();
        $getUser = new UserController();
        $user = $getUser->getUser($potensi->id_user);
        $msg = 'Kami telah menjadwalkan Survey Lapangan berdasarkan laporan Potensi Pajak Anda\n2Berikut jadwal yang telah kami tetapkan\n2' . $request->input('date_jadwal') .' '. $request->input('time_jadwal') . '\n2Login ke akun Anda untuk informasi lebih lengkap';
        $waController->sendMessage($user->no_hp, $msg);
        if ($result) {
            // Update field 'jadwal' menjadi 1 pada tabel 'potensi_pajak'
            DB::table('potensi_pajak')
                ->where('id', $request->input('id_potensi_jadwal'))
                ->update(['jadwal' => 1]);

            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data.',
            ]);
        }
    }

    public function finishSurvey(Request $request, $id)
    {


        $product = DB::table('potensi_pajak')->find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404); // 404: Not Found
        }

        try {
            DB::table('potensi_pajak')
                ->where('id', $id)
                ->update([
                    'jadwal' => 2,
                ]);

            return response()->json(['success' => true, 'message' => 'Berhasil Validasi'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal Validasi'], 500); // 500: Internal Server Error
        }
    }

    public function lembar_survey($id)
    {
        // Data yang akan dikirimkan ke view
        $potensi = DB::table('potensi_pajak')
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
            ->where('potensi_pajak.id', $id)

            ->first();
        $data = [
            'title' => 'Lembar Survey',
            'content' => 'Ini adalah contoh isi PDF yang dibuat menggunakan DOMPDF di Laravel.',
            'potensi' => $potensi
        ];

        // Memuat view dan mengirimkan data ke view tersebut
        $pdf = Pdf::loadView('survey.lembar_survey', $data); // Atau 'portrait';
        return $pdf->stream('lembar_survey.pdf');
        // Mendownload file PDF
        // return $pdf->download('laporan.pdf');
    }

    public function store(Request $request): JsonResponse
    {
        // Update validasi untuk mendukung field tambahan dan file gambar/PDF
        $validator = Validator::make($request->all(), [
            'id_potensi_survey' => 'required|integer', // integer
            'nm_pemegang_izin' => 'required|string|max:255', // varchar
            'jenis_iup' => 'required|string|max:255', // varchar
            'tahapan' => 'required|string|max:255', // varchar
            'luas' => 'required|numeric', // decimal
            'komoditas' => 'required|string|max:255', // varchar
            'no_izin' => 'required|string|max:255', // varchar
            'tgl_terbit' => 'required|date', // date
            'tgl_berakhir' => 'required|date', // date
            'latitude' => 'required|string|max:255', // numeric for latitude
            'longitude' => 'required|string|max:255', // numeric for longitude
            'dok_survey' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:4096',
        ], [
            'id_potensi_survey.required' => 'Kolom ID Potensi Pajak harus diisi.',
            'id_potensi_survey.integer' => 'Kolom ID Potensi Pajak harus berupa angka.',
            'nm_pemegang_izin.required' => 'Kolom Nama Pemegang Izin harus diisi.',
            'nm_pemegang_izin.string' => 'Kolom Nama Pemegang Izin harus berupa teks.',
            'nm_pemegang_izin.max' => 'Kolom Nama Pemegang Izin tidak boleh lebih dari :max karakter.',
            'jenis_iup.required' => 'Kolom Jenis IUP harus diisi.',
            'jenis_iup.string' => 'Kolom Jenis IUP harus berupa teks.',
            'jenis_iup.max' => 'Kolom Jenis IUP tidak boleh lebih dari :max karakter.',
            'tahapan.required' => 'Kolom Tahapan harus diisi.',
            'tahapan.string' => 'Kolom Tahapan harus berupa teks.',
            'tahapan.max' => 'Kolom Tahapan tidak boleh lebih dari :max karakter.',
            'luas.required' => 'Kolom Luas harus diisi.',
            'luas.numeric' => 'Kolom Luas harus berupa angka.',
            'komoditas.required' => 'Kolom Komoditas harus diisi.',
            'komoditas.string' => 'Kolom Komoditas harus berupa teks.',
            'no_izin.required' => 'Kolom Nomor Izin harus diisi.',
            'no_izin.string' => 'Kolom Nomor Izin harus berupa teks.',
            'no_izin.max' => 'Kolom Nomor Izin tidak boleh lebih dari :max karakter.',
            'tgl_terbit.required' => 'Kolom Tanggal Terbit harus diisi.',
            'tgl_terbit.date' => 'Kolom Tanggal Terbit harus berupa tanggal.',
            'tgl_berakhir.required' => 'Kolom Tanggal Berakhir harus diisi.',
            'tgl_berakhir.date' => 'Kolom Tanggal Berakhir harus berupa tanggal.',
            'latitude.required' => 'Kolom Latitude harus diisi.',
            'latitude.numeric' => 'Kolom Latitude harus berupa angka.',
            'longitude.required' => 'Kolom Longitude harus diisi.',
            'longitude.numeric' => 'Kolom Longitude harus berupa angka.',
            'dok_survey.required' => 'Kolom Dokumen Survey harus diisi.',
            'dok_survey.file' => 'Kolom Dokumen Survey harus berupa file.',
            'dok_survey.mimes' => 'Dokumen Survey harus dalam format: jpeg, png, jpg, gif, pdf.',
            'dok_survey.max' => 'Ukuran Dokumen Survey tidak boleh lebih dari :max kilobita.',
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
        $id_potensi_pajak = $request->input('id_potensi_survey');
        $nm_pemegang_izin = $request->input('nm_pemegang_izin');
        $jenis_iup = $request->input('jenis_iup');
        $tahapan = $request->input('tahapan');
        $luas = $request->input('luas');
        $komoditas = $request->input('komoditas');
        $no_izin = $request->input('no_izin');
        $tgl_terbit = $request->input('tgl_terbit');
        $tgl_berakhir = $request->input('tgl_berakhir');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $file = $request->file('dok_survey');
        $filePath = 'storage/dok_survey/';
        $fileName = time() . '.' . $file->getClientOriginalExtension(); // Nama file dengan timestamp

        // Simpan file
        $file->move($filePath, $fileName);
        $fileUrl = URL::to('/' . $filePath . $fileName);

        try {
            DB::table('data_survey')->insert([
                'id_potensi_pajak' => $id_potensi_pajak,
                'nm_pemegang_izin' => $nm_pemegang_izin,
                'jenis_iup' => $jenis_iup,
                'tahapan' => $tahapan,
                'luas' => $luas,
                'komoditas' => $komoditas,
                'no_izin' => $no_izin,
                'tgl_terbit' => $tgl_terbit,
                'tgl_berakhir' => $tgl_berakhir,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'file_url' => $fileUrl, // Menyimpan URL lengkap dari file
            ]);

            DB::table('potensi_pajak')
                ->where('id', $id_potensi_pajak)
                ->update([
                    'data' => 1,
                ]);


            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan'],); // 201: Created
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan data']); // 500: Internal Server Error
        }
    }
}
