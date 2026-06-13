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
        DB::statement("CREATE VIEW dbo.pasien_layan_reg_bpjs_sum_v
AS
SELECT     TOP (100) PERCENT kode_poli_vclaim AS kodepoli, tgl_masuk, COUNT(no_mr) AS jumlahterlayani, nama_poli, GETDATE() AS lastupdate, tgl_masuk_poli AS tanggalperiksa, kode_dokter, 
                      nama_dokter, kode_dokter_hfis, MAX(DISTINCT no_antrian) AS antrianterakhir
FROM         dbo.pl_mt_pasien_reg_bpjs_v
WHERE     (status_periksa = 1)
GROUP BY kode_poli_vclaim, tgl_masuk, nama_poli, tgl_masuk_poli, kode_dokter, nama_dokter, kode_dokter_hfis
ORDER BY tanggalperiksa DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_layan_reg_bpjs_sum_v]");
    }
};
