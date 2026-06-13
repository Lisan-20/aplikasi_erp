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
        DB::statement("CREATE VIEW dbo.v_permintaan_pembelian_gizi
AS
SELECT     dbo.tc_permohonan_cash_gizi.id_tc_permohonan, dbo.tc_permohonan_cash_gizi.kode_permohonan, dbo.tc_permohonan_cash_gizi.status_batal, 
                      dbo.tc_permohonan_cash_gizi.status_kirim, dbo.tc_permohonan_cash_gizi.tgl_permohonan, dbo.tc_permohonan_cash_gizi.kodesupplier, 
                      COUNT(dbo.tc_permohonan_cash_det_gizi.id_tc_permohonan_det) AS jml_brg
FROM         dbo.tc_permohonan_cash_gizi INNER JOIN
                      dbo.tc_permohonan_cash_det_gizi ON 
                      dbo.tc_permohonan_cash_gizi.id_tc_permohonan = dbo.tc_permohonan_cash_det_gizi.id_tc_permohonan INNER JOIN
                      dbo.mt_barang_nm ON dbo.tc_permohonan_cash_det_gizi.kode_brg = dbo.mt_barang_nm.kode_brg
GROUP BY dbo.tc_permohonan_cash_gizi.id_tc_permohonan, dbo.tc_permohonan_cash_gizi.kode_permohonan, dbo.tc_permohonan_cash_gizi.status_batal, 
                      dbo.tc_permohonan_cash_gizi.status_kirim, dbo.tc_permohonan_cash_gizi.tgl_permohonan, dbo.tc_permohonan_cash_gizi.kodesupplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_permintaan_pembelian_gizi]");
    }
};
