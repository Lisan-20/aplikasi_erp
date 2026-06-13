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
        DB::statement("CREATE VIEW dbo.pl_mt_pasien_reg_bpjs_sum_v
AS
SELECT     TOP (100) PERCENT kode_poli_vclaim AS kodepoli, tgl_masuk, nama_poli, COUNT(no_mr) AS totalantrean, GETDATE() AS lastupdate, tgl_masuk_poli AS tanggalperiksa, kode_dokter, nama_dokter, 
                      kode_dokter_hfis
FROM         dbo.pl_mt_pasien_reg_bpjs_v
GROUP BY kode_poli_vclaim, tgl_masuk, nama_poli, tgl_masuk_poli, kode_dokter, nama_dokter, kode_dokter_hfis
ORDER BY tanggalperiksa DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pl_mt_pasien_reg_bpjs_sum_v]");
    }
};
