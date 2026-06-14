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
        DB::statement("CREATE OR ALTER VIEW dbo.pl_mt_pasien_reg_bpjs_layan_sum_v
AS
SELECT     kode_poli_vclaim AS kodepoli, tgl_masuk, COUNT(no_mr) AS jumlahterlayani, nama_poli, GETDATE() AS lastupdate, tgl_masuk_poli AS tanggalperiksa
FROM         dbo.pl_mt_pasien_reg_bpjs_v
WHERE     (tgl_jam_keluar IS NOT NULL)
GROUP BY kode_poli_vclaim, tgl_masuk, nama_poli, tgl_masuk_poli
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pl_mt_pasien_reg_bpjs_layan_sum_v]");
    }
};
