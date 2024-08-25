<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   

    public function showLoginForm()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('auth.login', $data);
    }
    public function login(Request $request)
    {
        // Validasi input dari form login
        $credentials = $request->validate([
            'no_hp' => ['required',],
            'password' => ['required'],
        ]);

        // Coba autentikasi pengguna
        if (Auth::attempt($credentials)) {
            // Regenerasi sesi untuk mencegah serangan session fixation
            $request->session()->regenerate();
            // Ambil pengguna yang sedang login
            $user = Auth::user();

            // Simpan data pengguna ke session
            $request->session()->put([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'id_stak' => $user->id_stak,
                'no_hp' => $user->no_hp,
            ]);
            // Arahkan pengguna sesuai dengan role
            return $this->redirectBasedOnRole();
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'no_hp' => 'Email atau password salah.',
        ])->onlyInput('no_hp');
    }

    protected function redirectBasedOnRole()
    {

        if (auth()->user()->role === 'admin') {
            return redirect('admin/dashboard');
        } elseif (auth()->user()->role === 'operator') {
            return redirect('admin/dashboard');
        } elseif (auth()->user()->role === 'stakeholder') {
            return redirect('stakeholder/dashboard'); // Gunakan nama rute yang sesuai
        }



        // Default redirect jika role tidak terdeteksi
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
