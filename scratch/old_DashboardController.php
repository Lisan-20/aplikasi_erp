Created At: 2026-06-20T13:28:46Z
Completed At: 2026-06-20T13:28:46Z
File Path: `file:///d:/001_Aplikasi/aplikasi_erp_laravel/app/Http/Controllers/DashboardController.php`
Total Lines: 157
Total Bytes: 6099
Showing lines 1 to 157
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
1: <?php
2: 
3: namespace App\Http\Controllers;
4: 
5: use Illuminate\Http\Request;
6: use Illuminate\Support\Facades\DB;
7: use Illuminate\Support\Facades\Session;
8: use Illuminate\Support\Facades\Log;
9: 
10: class DashboardController extends Controller
11: {
12:     public function show($modul)
13:     {
14:         $id_dd_user = Session::get('id_dd_user');
15:         Log::info('DashboardController show: id_dd_user=' . $id_dd_user . ' modul=' . $modul);
16: 
17:         // Fetch Module Info
18:         $module = DB::table('dc_modul')->where('id_dc_modul', $modul)->first();
19:         $moduleName = $module ? $module->nama_modul : 'Dashboard';
20: 
21:         // Fetch User Privileges for this Module from admin_hak_user_v
22:         $hakAkses = DB::table('admin_hak_user_v')
23:             ->join('dc_sub_menu', 'admin_hak_user_v.id_dc_sub_menu', '=', 'dc_sub_menu.id_dc_sub_menu')
24:             ->select(
25:                 'admin_hak_user_v.id_dc_menu',
26:                 'admin_hak_user_v.nama_menu',
27:                 'admin_hak_user_v.no_urut_menu',
28:                 'admin_hak_user_v.id_dc_sub_menu',
29:                 'admin_hak_user_v.nama_sub_menu',
30:                 'admin_hak_user_v.url_sub_menu',
31:                 'dc_sub_menu.url_sub_menu_baru',
32:                 'admin_hak_user_v.no_urut_sub_menu'
33:             )
34:             ->where('id_dd_user', $id_dd_user)
35:             ->where('id_dc_modul', $modul)
36:             ->distinct()
37:             ->orderBy('no_urut_menu')
38:             ->orderBy('no_urut_sub_menu')
39:             ->get();
40: 
41:         $menus = [];
42: 
43:         foreach ($hakAkses as $row) {
44:             // Check if menu already exists in array
45:             if (!isset($menus[$row->id_dc_menu])) {
46:                 $menus[$row->id_dc_menu] = [
47:                     'id_dc_menu' => $row->id_dc_menu,
48:                     'nama_menu' => $row->nama_menu,
49:                     'sub_menus' => []
50:                 ];
51:             }
52: 
53:             // Append sub menu if exists
54:             if ($row->id_dc_sub_menu) {
55:                 // Ensure sub menu is not duplicated
56:                 $subExists = false;
57:                 foreach ($menus[$row->id_dc_menu]['sub_menus'] as $sub) {
58:                     if ($sub['id_dc_sub_menu'] == $row->id_dc_sub_menu) {
59:                         $subExists = true;
60:                         break;
61:                     }
62:                 }
63: 
64:                 if (!$subExists) {
65:                     $menus[$row->id_dc_menu]['sub_menus'][] = [
66:                         'id_dc_sub_menu' => $row->id_dc_sub_menu,
67:                         'nama_sub_menu' => $row->nama_sub_menu,
68:                         'url_sub_menu' => $row->url_sub_menu,
69:                         'url_sub_menu_baru' => $row->url_sub_menu_baru,
70:                     ];
71:                 }
72:             }
73:         }
74: 
75:         // Convert menus to sequential array
76:         $menus = array_values($menus);
77: 
78:         Log::info('Menus for User ' . $id_dd_user . ' Modul ' . $modul . ': ' . json_encode($menus));
79: 
80:         return inertia('Dashboard', [
81:             'dashboard' => [
82:                 'module_name' => $moduleName,
83:                 'modul_id' => $modul,
84:                 'menus' => $menus
85:             ]
86:         ]);
87:     }
88: 
89:     /**
90:      * API API untuk mengambil metrics dashboard Kasir melalui Stored Procedure
91:      */
92:     public function getKasirMetrics(Request $request)
93:     {
94:         try {
95:             $startDate = $request->query('start_date', date('Y-m-d', strtotime('-6 days')));
96:             $endDate = $request->query('end_date', date('Y-m-d'));
97: 
98:             // Memanggil Stored Procedure
99:             // Karena SP mengembalikan multiple result sets, kita menggunakan PDO langsung untuk meloop
100:             $pdo = DB::connection()->getPdo();
101:             $stmt = $pdo->prepare("EXEC sp_DashboardKasir_GetMetrics ?, ?");
102:             $stmt->execute([$startDate, $endDate]);
103: 
104:             // Result 1: Header Metrics
105:             $header = $stmt->fetchAll(\PDO::FETCH_ASSOC);
106:             $stmt->nextRowset();
107: 
108:             // Result 2: Revenue Trend
109:             $revenueTrend = $stmt->fetchAll(\PDO::FETCH_ASSOC);
110:             $stmt->nextRowset();
111: 
112:             // Result 3: Payment Methods
113:             $paymentMethods = $stmt->fetchAll(\PDO::FETCH_ASSOC);
114: 
115:             return response()->json([
116:                 'status' => 'success',
117:                 'data' => [
118:                     'header' => $header[0] ?? ['TotalPendapatanHariIni' => 0, 'TotalTransaksiHariIni' => 0, 'TotalPiutangHariIni' => 0],
119:                     'revenueTrend' => $revenueTrend,
120:                     'paymentMethods' => $paymentMethods
121:                 ]
122:             ]);
123: 
124:         } catch (\Exception $e) {
125:             Log::error('Error fetching Kasir metrics via SP: ' . $e->getMessage());
126: 
127:             // Fallback Dummy Data jika koneksi database putus atau SP belum ada di server (Demo mode)
128:             return response()->json([
129:                 'status' => 'error',
130:                 'message' => 'SP execution failed, returning fallback data. ' . $e->getMessage(),
131:                 'data' => [
132:                     'header' => [
133:                         'TotalPendapatanHariIni' => 12500000,
134:                         'TotalTransaksiHariIni' => 145,
135:                         'TotalPiutangHariIni' => 2100000
136:                     ],
137:                     'revenueTrend' => [
138:                         ['name' => 'Senin', 'revenue' => 15000000],
139:                         ['name' => 'Selasa', 'revenue' => 12500000],
140:                         ['name' => 'Rabu', 'revenue' => 18000000],
141:                         ['name' => 'Kamis', 'revenue' => 14000000],
142:                         ['name' => 'Jumat', 'revenue' => 19500000],
143:                         ['name' => 'Sabtu', 'revenue' => 22000000],
144:                         ['name' => 'Minggu', 'revenue' => 25000000],
145:                     ],
146:                     'paymentMethods' => [
147:                         ['name' => 'Tunai', 'value' => 45],
148:                         ['name' => 'Transfer Bank', 'value' => 30],
149:                         ['name' => 'QRIS', 'value' => 15],
150:                         ['name' => 'Kartu Kredit', 'value' => 10],
151:                     ]
152:                 ]
153:             ]);
154:         }
155:     }
156: }
157: 
The above content shows the entire, complete file contents of the requested file.
