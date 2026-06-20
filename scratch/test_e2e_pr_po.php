<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::create('/', 'GET')
);

use Illuminate\Support\Facades\DB;

try {
    DB::beginTransaction();
    echo "1. Memulai simulasi Permintaan Pembelian (Gudang)...\n";
    
    // Auth bypass (simulate system user)
    $userId = 1;
    
    // 1. Gudang creates PR
    $kodesupplier = DB::table('mt_supplier')->value('kodesupplier') ?? 'SUP001';
    $kode_brg = DB::table('mt_barang_nm')->value('kode_brg') ?? 'BRG001';
    
    $reqDataPR = [
        'kodesupplier' => $kodesupplier,
        'tgl_permohonan' => now()->toDateString(),
        'cart' => [
            [
                'kode_brg' => $kode_brg,
                'qty' => 10
            ]
        ]
    ];
    
    $req1 = Illuminate\Http\Request::create('/gudang/permintaan-pembelian', 'POST', $reqDataPR);
    $req1->setUserResolver(function() use ($userId) {
        return (object)['id' => $userId, 'nama_pegawai' => 'Test System'];
    });
    
    $controller1 = app(\App\Http\Controllers\Gudang\PermintaanPembelianController::class);
    $resp1 = $controller1->store($req1);
    
    $pr = DB::table('tc_permohonan_nm')->orderBy('id_tc_permohonan', 'desc')->first();
    echo "   => PR Dibuat: {$pr->kode_permohonan} (ID: {$pr->id_tc_permohonan})\n";
    
    // 2. Manajemen Approves PR
    echo "2. Manajemen Melakukan Approval (Acc Purchasing)...\n";
    $req2 = Illuminate\Http\Request::create("/manajemen/acc-purchasing/{$pr->id_tc_permohonan}/approve", 'POST');
    $req2->setUserResolver(function() use ($userId) {
        return (object)['id' => $userId, 'nama_pegawai' => 'Test System'];
    });
    $controller2 = app(\App\Http\Controllers\Manajemen\AccPurchasingController::class);
    $resp2 = $controller2->approve($req2, $pr->id_tc_permohonan);
    
    $prUpdated = DB::table('tc_permohonan_nm')->where('id_tc_permohonan', $pr->id_tc_permohonan)->first();
    echo "   => PR Di-ACC: {$prUpdated->no_acc}\n";
    
    // 3. Pengadaan Creates PO based on PR
    echo "3. Pengadaan Menerbitkan PO...\n";
    $prDet = DB::table('tc_permohonan_nm_det')->where('id_tc_permohonan', $pr->id_tc_permohonan)->first();
    
    $reqDataPO = [
        'kodesupplier' => $prUpdated->kodesupplier,
        'tgl_po' => now()->toDateString(),
        'ppn' => 11,
        'discount_harga' => 0,
        'cart' => [
            [
                'id_tc_permohonan' => $prUpdated->id_tc_permohonan,
                'id_tc_permohonan_det' => $prDet->id_tc_permohonan_det,
                'kode_brg' => $prDet->kode_brg,
                'qty' => $prDet->jumlah_besar,
                'harga_beli' => 50000,
                'satuan_besar' => $prDet->satuan
            ]
        ]
    ];
    
    $req3 = Illuminate\Http\Request::create('/pengadaan/po', 'POST', $reqDataPO);
    $req3->setUserResolver(function() use ($userId) {
        return (object)['id' => $userId, 'nama_pegawai' => 'Test System'];
    });
    
    $controller3 = app(\App\Http\Controllers\Pengadaan\PengadaanController::class);
    $resp3 = $controller3->store($req3);
    
    $po = DB::table('tc_po_nm')->orderBy('id_tc_po', 'desc')->first();
    echo "   => PO Dibuat: {$po->no_po} (ID: {$po->id_tc_po})\n";
    
    // 4. Gudang Menerima Barang
    echo "4. Gudang Menerima Barang...\n";
    $poDet = DB::table('tc_po_nm_det')->where('id_tc_po', $po->id_tc_po)->first();
    
    $reqDataPenerimaan = [
        'id_tc_po' => $po->id_tc_po,
        'no_faktur' => 'INV-TEST-001',
        'tgl_penerimaan' => now()->toDateString(),
        'items' => [
            [
                'kode_brg' => $poDet->kode_brg,
                'qty_pesan' => $poDet->jumlah_besar,
                'qty_terima' => $poDet->jumlah_besar,
                'id_tc_po_det' => $poDet->id_tc_po_det,
                'harga_satuan' => $poDet->harga_satuan,
                'satuan' => $poDet->satuan
            ]
        ]
    ];
    
    $req4 = Illuminate\Http\Request::create('/gudang/penerimaan', 'POST', $reqDataPenerimaan);
    $req4->setUserResolver(function() use ($userId) {
        return (object)['id' => $userId, 'nama_pegawai' => 'Test System'];
    });
    
    $controller4 = app(\App\Http\Controllers\Gudang\PenerimaanBarangController::class);
    $resp4 = $controller4->store($req4);
    
    $penerimaan = DB::table('tc_penerimaan_barang_nm')->orderBy('id_tc_penerimaan_brg_nm', 'desc')->first();
    echo "   => Penerimaan Berhasil: {$penerimaan->kode_penerimaan} (Faktur: {$penerimaan->no_faktur})\n";
    
    echo "\n=== END-TO-END TEST SUCCESSFUL ===\n";
    DB::rollBack();
    echo "Rolled back all transactions.\n";
} catch (\Exception $e) {
    DB::rollBack();
    echo "\n!!! ERROR !!!\n";
    echo $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
