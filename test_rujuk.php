<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$patient = DB::table('pl_tc_poli')
    ->join('tc_kunjungan', 'tc_kunjungan.no_kunjungan', '=', 'pl_tc_poli.no_kunjungan')
    ->where('pl_tc_poli.kode_poli', 143693)
    ->first();

if (!$patient) {
    die("Patient not found\n");
}

try { 
    $kode_rujukan = DB::table('rg_tc_rujukan')->max('kode_rujukan') + 1;
    DB::table('rg_tc_rujukan')->insert([
        'kode_rujukan' => $kode_rujukan, 
        'rujukan_dari' => $patient->kode_bagian, 
        'no_mr' => $patient->no_mr, 
        'no_kunjungan_lama' => $patient->no_kunjungan, 
        'no_registrasi' => $patient->no_registrasi, 
        'status' => '0', 
        'tgl_input' => date('Y-m-d H:i:s')
    ]); 
    echo "Rujukan Success\n";

    $no_kunjungan = DB::table('tc_kunjungan')->max('no_kunjungan') + 1;
    DB::table('tc_kunjungan')->insert([
        'no_kunjungan' => $no_kunjungan, 
        'no_registrasi' => $patient->no_registrasi, 
        'no_mr' => $patient->no_mr, 
        'kode_dokter' => $patient->kode_dokter, 
        'kode_bagian_tujuan' => '030001', 
        'kode_bagian_asal' => $patient->kode_bagian, 
        'tgl_masuk' => date('Y-m-d H:i:s'), 
        'status_masuk' => 1
    ]); 
    echo "Kunjungan Success\n";

} catch (\Exception $e) { 
    echo "ERROR: " . $e->getMessage() . "\n"; 
}
