<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $id_dd_user = $request->session()->get('id_dd_user');
        $active_modul = $request->session()->get('active_modul', 2); // Default to 2 (Registrasi) if not set

        $menus = [];
        $moduleName = 'Dashboard';

        if ($id_dd_user && $active_modul) {
            $module = DB::table('dc_modul')->where('id_dc_modul', $active_modul)->first();
            $moduleName = $module ? $module->nama_modul : 'Dashboard';

            $hakAkses = DB::table('admin_hak_user_v')
                ->select('id_dc_menu', 'nama_menu', 'no_urut_menu', 'id_dc_sub_menu', 'nama_sub_menu', 'url_sub_menu', 'no_urut_sub_menu')
                ->where('id_dd_user', $id_dd_user)
                ->where('id_dc_modul', $active_modul)
                ->distinct()
                ->orderBy('no_urut_menu')
                ->orderBy('no_urut_sub_menu')
                ->get();

            foreach ($hakAkses as $row) {
                if (! isset($menus[$row->id_dc_menu])) {
                    $menus[$row->id_dc_menu] = [
                        'id_dc_menu' => $row->id_dc_menu,
                        'nama_menu' => $row->nama_menu,
                        'sub_menus' => [],
                    ];
                }
                if ($row->id_dc_sub_menu) {
                    $subExists = false;
                    foreach ($menus[$row->id_dc_menu]['sub_menus'] as $sub) {
                        if ($sub['id_dc_sub_menu'] == $row->id_dc_sub_menu) {
                            $subExists = true;
                            break;
                        }
                    }
                    if (! $subExists) {
                        $menus[$row->id_dc_menu]['sub_menus'][] = [
                            'id_dc_sub_menu' => $row->id_dc_sub_menu,
                            'nama_sub_menu' => $row->nama_sub_menu,
                            'url_sub_menu' => $row->url_sub_menu,
                        ];
                    }
                }
            }
            $menus = array_values($menus);
        }

        $userSession = $request->session()->get('user');
        $userSafe = null;
        if ($userSession) {
            $userArray = (array) $userSession;
            unset($userArray['password']); // Hapus password demi keamanan
            $userSafe = $userArray;
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $userSafe,
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
            ],
            'dashboard' => [
                'menus' => $menus,
                'module_name' => $moduleName,
            ],
        ]);
    }
}
