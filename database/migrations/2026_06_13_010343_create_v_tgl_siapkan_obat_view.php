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
        DB::statement("CREATE OR ALTER VIEW dbo.v_tgl_siapkan_obat
AS
SELECT     TOP (100) PERCENT MAX(dbo.fr_tc_far_detail.tgl_input) AS tgl_input, dbo.fr_tc_far_detail.kode_trans_far, dbo.fr_tc_far.no_resep, dbo.fr_tc_far.no_mr, dbo.fr_tc_far.nama_pasien, 
                      dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far.dokter_pengirim, dbo.fr_tc_far.status_transaksi, SUM(dbo.fr_tc_far_detail.biaya_tebus) AS biaya, dbo.fr_tc_far.petugas, dbo.fr_tc_far.tgl_serah, 
                      dbo.fr_tc_far.kode_bagian_asal, dbo.fr_tc_far_detail.racik
FROM         dbo.fr_tc_far_detail INNER JOIN
                      dbo.fr_tc_far ON dbo.fr_tc_far_detail.kode_trans_far = dbo.fr_tc_far.kode_trans_far
GROUP BY dbo.fr_tc_far_detail.kode_trans_far, dbo.fr_tc_far.no_resep, dbo.fr_tc_far.no_mr, dbo.fr_tc_far.nama_pasien, dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far.dokter_pengirim, dbo.fr_tc_far.status_transaksi,
                       dbo.fr_tc_far.petugas, dbo.fr_tc_far.tgl_serah, dbo.fr_tc_far.kode_bagian_asal, dbo.fr_tc_far_detail.racik
ORDER BY tgl_input DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_tgl_siapkan_obat]");
    }
};
