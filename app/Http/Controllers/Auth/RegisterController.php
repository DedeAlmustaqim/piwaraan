<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\WaController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    //

    public function index()
    {
        $stak = DB::table('tbl_stakeholder')
            ->orderBy('stakeholder', 'ASC')
            ->get();
        $data = [
            'title' => 'Daftar',
            'stak' => $stak
        ];
        return view('auth.register', $data);
    }

    public function register(Request $request)
    {
        $waController = new WaController();

        // Mendapatkan data dari form
        $name = $request->input('name');
        $id_stak = $request->input('id_stak');
        $no_hp = $request->input('no_hp');
        $password = $request->input('password');

        // Aturan validasi
        $validationRules = [
            'name' => 'required|max:50',
            'id_stak' => 'required|max:100',
            'no_hp' => 'required|min:11|max:12',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'checkbox_privasi' => 'required'
        ];

        $validationMessages = [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 50 karakter.',
            'id_stak.required' => 'Lembaga wajib diisi.',
            'id_stak.max' => 'Lembaga tidak boleh lebih dari 100 karakter.',
            'no_hp.required' => 'Nomor telepon wajib diisi.',
            'no_hp.min' => 'Nomor telepon minimal 11 karakter.',
            'no_hp.max' => 'Nomor telepon maksimal 12 karakter.',
            'no_hp.numeric' => 'Nomor telepon hanya boleh berisi angka.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus terdiri dari 6 karakter.',
            'confirm_password.required' => 'Konfirmasi password wajib diisi.',
            'confirm_password.same' => 'Konfirmasi password harus sama dengan password.',
            'checkbox_privasi.required' => 'Anda harus menyetujui kebijakan privasi kami.'
        ];

        // Melakukan validasi
        $validator = Validator::make($request->all(), $validationRules, $validationMessages);

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
        // Cek apakah nomor HP sudah ada di database
        $existingNoHp = User::where('no_hp', $no_hp)->first();
        if ($existingNoHp) {
            return response()->json([
                'success' => false,
                'errors' => [
                    [
                        'field' => 'no_hp',
                        'message' => 'No Hp sudah digunakan. Silakan masukkan No Hp yang lain.'
                    ]
                ]
            ]);
        }

        // Generate kode OTP dan hash password
        $randomNumber = random_int(100000, 999999);
        $hashedPassword = Hash::make($password);

        // Menyimpan data pengguna
        $user = new User([
            'name' => $name,
            'id_stak' => $id_stak,
            'no_hp' => $no_hp,
            'active_code' => $randomNumber,
            'password' => $hashedPassword,
        ]);

        if ($user->save()) {
            $msg = '  Terima Kasih sudah mendaftar Piwaraan\n2 Silahkan Masukkan kode OTP untuk melanjutkan Pendaftaran\n2\n2Masukkan Kode OTP ' . $randomNumber . ', \n2\n2';
            $encodedNoHp = base64_encode($no_hp);
            $waController->sendMessage($no_hp, $msg);

            return response()->json([
                'success' => true,
                'no_hp' => $encodedNoHp
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data.'
            ]);
        }
    }

    public function verifikasi($noHp)
    {        // Decode the URL-encoded email
        $noHp = base64_decode($noHp);

        // Retrieve user by email if necessary, for example:
        // $model = new UserModel();
        // $user = $model->where('email', $email)->first();

        $data = [
            'title' => 'Verifikasi Kode OTP',
            'noHp' => $noHp
            // You can pass the user data if you retrieved it
        ];

        return view('auth.verifikasi', $data);
    }

    public function otp(Request $request)
    {
        // Cari user berdasarkan nomor HP
        $no_hp = $request->input('no_hp_otp');
        $user = User::where('no_hp', $request->input('no_hp_otp'))->first();

        if ($user) {
            // Periksa apakah kode OTP sesuai
            if ($request->input('kode_otp') == $user->active_code) {
                // Update status user menjadi aktif
                $user->active = 1;
                if ($user->save()) {
                    // Berhasil verifikasi, redirect ke halaman login atau dashboard
                    return redirect()->route('login')->with('success', 'Berhasil Verifikasi');
                } else {
                    // Gagal mengupdate data
                    return redirect()->back()->with('error', 'Gagal update');
                }
            } else {
                // Kode OTP salah
                return redirect()->back()->with('error', 'Kode OTP salah');
            }
        } else {
            // User tidak ditemukan
            return redirect()->back()->with('error', 'Nomor HP tidak ditemukan' . $user);
        }
        dd($no_hp);
        // dd($user);
    }
}
