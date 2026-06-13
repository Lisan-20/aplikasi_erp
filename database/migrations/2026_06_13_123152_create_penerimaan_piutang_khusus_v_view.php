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
        DB::statement("
CREATE VIEW [dbo].[penerimaan_piutang_khusus_v]
AS
SELECT     dbo.bd_tc_trans.id_bd_tc_trans, dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans.no_ref, dbo.mt_perusahaan.nama_perusahaan, dbo.bd_tc_trans.tgl_transaksi, 
                      dbo.bd_tc_trans.jumlah, dbo.bd_tc_trans.penerima, dbo.transaksi_piutang_khusus.status_lunas, dbo.bd_tc_trans.no_induk
FROM         dbo.mt_perusahaan INNER JOIN
                      dbo.transaksi_piutang_khusus ON dbo.mt_perusahaan.kode_perusahaan = dbo.transaksi_piutang_khusus.kode_perusahaan INNER JOIN
                      dbo.bd_tc_trans ON dbo.transaksi_piutang_khusus.id_trans_piutang = dbo.bd_tc_trans.id_trans_piutang

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penerimaan_piutang_khusus_v]");
    }
};
