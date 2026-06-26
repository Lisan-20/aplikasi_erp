<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
config(['database.connections.sqlsrv.host' => '127.0.0.1']);

$details = \DB::table('tc_penerimaan_barang_nm_detail as d')
    ->join('mt_barang_jasa as b', 'd.kode_brg', '=', 'b.kode_brg')
    ->where('d.kode_penerimaan', 'LPB-20260627-0004')
    ->select(
        'd.kode_brg',
        'b.nama_brg',
        'd.jumlah_kirim as qty_terima',
        'd.satuan',
        'd.harga as harga_satuan',
        'd.harga_total'
    )
    ->get();

echo json_encode($details);
