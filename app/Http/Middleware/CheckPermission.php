<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckPermission
{
    public function handle(Request $request, Closure $next)
    {
        $userId = Session::get('id_dd_user');

        if (! $userId) {
            return redirect('/login');
        }

        // Get module from query parameter or route parameter
        $modulId = $request->route('modul') ?? $request->query('modul');

        if ($modulId) {
            // Cek izin modul via view admin_hak_user_v
            $hasAccess = DB::table('admin_hak_user_v')
                ->where('id_dd_user', $userId)
                ->where('id_dc_modul', $modulId)
                ->exists();

            if (! $hasAccess) {
                abort(403, 'Unauthorized access.');
            }
        }

        return $next($request);
    }
}
