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
        DB::statement("CREATE VIEW dbo.tc_hutang_rujukan_v
AS
SELECT     dbo.tc_hutang_rujukan_vcr_det.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_hutang_rujukan_inv.total_harga, dbo.tc_hutang_rujukan_vcr.id_tc_hutang_rujukan_vcr, dbo.tc_trans_pelayanan.tgl_transaksi, 
                      dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.tc_hutang_rujukan_inv INNER JOIN
                      dbo.tc_hutang_rujukan_vcr ON dbo.tc_hutang_rujukan_inv.id_tc_hutang_rujukan_vcr = dbo.tc_hutang_rujukan_vcr.id_tc_hutang_rujukan_vcr INNER JOIN
                      dbo.tc_hutang_rujukan_vcr_det ON dbo.tc_hutang_rujukan_vcr.id_tc_hutang_rujukan_vcr = dbo.tc_hutang_rujukan_vcr_det.id_tc_hutang_rujukan_vcr ON 
                      dbo.tc_trans_pelayanan.kode_trans_pelayanan = dbo.tc_hutang_rujukan_vcr_det.kode_trans_pelayanan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_hutang_rujukan_v]");
    }
};
