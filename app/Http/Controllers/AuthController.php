<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        $config = null;
        try {
            $config = DB::table('dd_konfigurasi')->first();
        } catch (\Exception $e) {
            // Keep config null if table does not exist or query fails
        }
        return inertia('Auth/Login', [
            'config' => $config
        ]);
    }

    public function login(Request $request)
    {
        $username = $request->input('txt_name');
        $password = $request->input('txt_pass');

        // Mengikuti pola lama: MD5 dengan Case Sensitive (Collate)
        $user = DB::table('dd_user')
            ->whereRaw("username COLLATE Latin1_General_CS_AS = ?", [$username])
            ->whereRaw("password COLLATE Latin1_General_CS_AS = ?", [md5($password)])
            ->where('status', 0)
            ->first();

        if ($user) {
            // Set session
            Session::put('user', $user);
            Session::put('id_dd_user', $user->id_dd_user);

            // Log login
            $idLogUser = DB::table('log_user_login')->insertGetId([
                'id_dd_user' => $user->id_dd_user,
                'session_id' => Session::getId(),
                'login_time' => now(),
                'ip_address' => $request->ip(),
                'ko_wil' => $user->ko_wil
            ], 'id_log_user');

            Session::put('id_log_user', $idLogUser);

            // Cek jumlah modul untuk redirect
            $modulnya = DB::table('admin_hak_user_v')
                ->where('id_dd_user', $user->id_dd_user)
                ->distinct()
                ->pluck('id_dc_modul');

            if (count($modulnya) == 1) {
                return redirect()->route('dashboard', ['modul' => $modulnya[0]]);
            }

            return redirect()->route('modul.index');
        }

        return back()->withErrors(['message' => 'Login Gagal!']);
    }

    public function logout(Request $request)
    {
        // Update logoff_time di sini (seperti di Security class lama)
        if (Session::has('id_log_user')) {
            DB::table('log_user_login')
                ->where('id_log_user', Session::get('id_log_user'))
                ->update(['logoff_time' => now()]);
        } else {
            DB::table('log_user_login')
                ->where('session_id', Session::getId())
                ->whereNull('logoff_time')
                ->update(['logoff_time' => now()]);
        }

        Session::flush();
        return redirect('/login');
    }
}
