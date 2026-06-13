<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE VIEW dbo.upd_ref_kartu_hutang_sementara_v
AS
SELECT     dbo.tc_penerimaan_barang.kode_penerimaan, dbo.tx_harian.no_bukti, dbo.tc_hutang_supplier_vcr.no_voucher, dbo.tx_harian.referensi
FROM         dbo.tc_hutang_supplier_vcr INNER JOIN
                      dbo.tc_hutang_supplier_vcr_det ON dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr = dbo.tc_hutang_supplier_vcr_det.id_tc_hutang_supplier_vcr INNER JOIN
                      dbo.tc_penerimaan_barang ON dbo.tc_hutang_supplier_vcr_det.kode_penerimaan = dbo.tc_penerimaan_barang.kode_penerimaan INNER JOIN
                      dbo.tx_harian ON dbo.tc_penerimaan_barang.kode_penerimaan = dbo.tx_harian.no_bukti
WHERE     (dbo.tx_harian.kel_jurnal = 6) AND (dbo.tx_harian.tx_tipe = 'K')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_ref_kartu_hutang_sementara_v]");
    }
};
