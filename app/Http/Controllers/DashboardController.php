<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        // Redirect to last accessed module or module selection
        $modul = session('current_modul');
        if ($modul) {
            return redirect()->route('dashboard', ['modul' => $modul]);
        }
        return redirect()->route('modul.index');
    }

    public function show($modul)
    {
        $id_dd_user = Session::get('id_dd_user');
        Log::info('DashboardController show: id_dd_user=' . $id_dd_user . ' modul=' . $modul);

        // Fetch Module Info
        $module = DB::table('dc_modul')->where('id_dc_modul', $modul)->first();
        $moduleName = $module ? $module->nama_modul : 'Dashboard';

        // Fetch User Privileges for this Module from admin_hak_user_v
        $hakAkses = DB::table('admin_hak_user_v')
            ->join('dc_sub_menu', 'admin_hak_user_v.id_dc_sub_menu', '=', 'dc_sub_menu.id_dc_sub_menu')
            ->select(
                'admin_hak_user_v.id_dc_menu',
                'admin_hak_user_v.nama_menu',
                'admin_hak_user_v.no_urut_menu',
                'admin_hak_user_v.id_dc_sub_menu',
                'admin_hak_user_v.nama_sub_menu',
                'admin_hak_user_v.url_sub_menu',
                'dc_sub_menu.url_sub_menu_baru',
                'admin_hak_user_v.no_urut_sub_menu'
            )
            ->where('id_dd_user', $id_dd_user)
            ->where('id_dc_modul', $modul)
            ->distinct()
            ->orderBy('no_urut_menu')
            ->orderBy('no_urut_sub_menu')
            ->get();

        $menus = [];

        foreach ($hakAkses as $row) {
            // Check if menu already exists in array
            if (!isset($menus[$row->id_dc_menu])) {
                $menus[$row->id_dc_menu] = [
                    'id_dc_menu' => $row->id_dc_menu,
                    'nama_menu' => $row->nama_menu,
                    'sub_menus' => []
                ];
            }

            // Append sub menu if exists
            if ($row->id_dc_sub_menu) {
                // Ensure sub menu is not duplicated
                $subExists = false;
                foreach ($menus[$row->id_dc_menu]['sub_menus'] as $sub) {
                    if ($sub['id_dc_sub_menu'] == $row->id_dc_sub_menu) {
                        $subExists = true;
                        break;
                    }
                }

                if (!$subExists) {
                    $menus[$row->id_dc_menu]['sub_menus'][] = [
                        'id_dc_sub_menu' => $row->id_dc_sub_menu,
                        'nama_sub_menu' => $row->nama_sub_menu,
                        'url_sub_menu' => $row->url_sub_menu,
                        'url_sub_menu_baru' => $row->url_sub_menu_baru,
                    ];
                }
            }
        }

        // Convert menus to sequential array
        $menus = array_values($menus);

        Log::info('Menus for User ' . $id_dd_user . ' Modul ' . $modul . ': ' . json_encode($menus));

        return inertia('Dashboard', [
            'dashboard' => [
                'module_name' => $moduleName,
                'modul_id' => $modul,
                'menus' => $menus
            ]
        ]);
    }

    /**
     * API API untuk mengambil metrics dashboard Kasir melalui Stored Procedure
     */
    public function getKasirMetrics(Request $request)
    {
        try {
            $startDate = $request->query('start_date', date('Y-m-d', strtotime('-6 days')));
            $endDate = $request->query('end_date', date('Y-m-d'));

            // Memanggil Stored Procedure
            // Karena SP mengembalikan multiple result sets, kita menggunakan PDO langsung untuk meloop
            $pdo = DB::connection()->getPdo();
            $stmt = $pdo->prepare("EXEC sp_DashboardKasir_GetMetrics ?, ?");
            $stmt->execute([$startDate, $endDate]);

            // Result 1: Header Metrics
            $header = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $stmt->nextRowset();

            // Result 2: Revenue Trend
            $revenueTrend = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $stmt->nextRowset();

            // Result 3: Payment Methods
            $paymentMethods = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return response()->json([
                'status' => 'success',
                'data' => [
                    'header' => $header[0] ?? ['TotalPendapatanHariIni' => 0, 'TotalTransaksiHariIni' => 0, 'TotalPiutangHariIni' => 0],
                    'revenueTrend' => $revenueTrend,
                    'paymentMethods' => $paymentMethods
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching Kasir metrics via SP: ' . $e->getMessage());

            // Fallback Dummy Data jika koneksi database putus atau SP belum ada di server (Demo mode)
            return response()->json([
                'status' => 'error',
                'message' => 'SP execution failed, returning fallback data. ' . $e->getMessage(),
                'data' => [
                    'header' => [
                        'TotalPendapatanHariIni' => 12500000,
                        'TotalTransaksiHariIni' => 145,
                        'TotalPiutangHariIni' => 2100000
                    ],
                    'revenueTrend' => [
                        ['name' => 'Senin', 'revenue' => 15000000],
                        ['name' => 'Selasa', 'revenue' => 12500000],
                        ['name' => 'Rabu', 'revenue' => 18000000],
                        ['name' => 'Kamis', 'revenue' => 14000000],
                        ['name' => 'Jumat', 'revenue' => 19500000],
                        ['name' => 'Sabtu', 'revenue' => 22000000],
                        ['name' => 'Minggu', 'revenue' => 25000000],
                    ],
                    'paymentMethods' => [
                        ['name' => 'Tunai', 'value' => 45],
                        ['name' => 'Transfer Bank', 'value' => 30],
                        ['name' => 'QRIS', 'value' => 15],
                        ['name' => 'Kartu Kredit', 'value' => 10],
                    ]
                ]
            ]);
        }
    }
}

