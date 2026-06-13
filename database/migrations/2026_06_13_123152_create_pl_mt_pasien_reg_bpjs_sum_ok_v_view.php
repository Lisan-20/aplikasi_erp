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
        DB::statement("CREATE VIEW dbo.pl_mt_pasien_reg_bpjs_sum_ok_v
AS
SELECT     TOP (100) PERCENT dbo.pl_mt_pasien_reg_bpjs_sum_v.kodepoli, dbo.pl_mt_pasien_reg_bpjs_sum_v.tgl_masuk, CASE WHEN pl_mt_pasien_reg_bpjs_layan_sum_v.jumlahterlayani IS NULL 
                      THEN 0 ELSE pl_mt_pasien_reg_bpjs_layan_sum_v.jumlahterlayani END AS jumlahterlayani, dbo.pl_mt_pasien_reg_bpjs_sum_v.nama_poli, dbo.pl_mt_pasien_reg_bpjs_sum_v.totalantrean, 
                      dbo.pl_mt_pasien_reg_bpjs_sum_v.lastupdate, dbo.pl_mt_pasien_reg_bpjs_sum_v.tanggalperiksa
FROM         dbo.pl_mt_pasien_reg_bpjs_layan_sum_v RIGHT OUTER JOIN
                      dbo.pl_mt_pasien_reg_bpjs_sum_v ON dbo.pl_mt_pasien_reg_bpjs_layan_sum_v.kodepoli = dbo.pl_mt_pasien_reg_bpjs_sum_v.kodepoli AND 
                      dbo.pl_mt_pasien_reg_bpjs_layan_sum_v.tgl_masuk = dbo.pl_mt_pasien_reg_bpjs_sum_v.tgl_masuk AND 
                      dbo.pl_mt_pasien_reg_bpjs_layan_sum_v.nama_poli = dbo.pl_mt_pasien_reg_bpjs_sum_v.nama_poli
ORDER BY dbo.pl_mt_pasien_reg_bpjs_sum_v.tanggalperiksa DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pl_mt_pasien_reg_bpjs_sum_ok_v]");
    }
};
