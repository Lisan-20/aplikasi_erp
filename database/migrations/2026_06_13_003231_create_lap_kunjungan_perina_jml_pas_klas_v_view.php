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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_perina_jml_pas_klas_v
AS
SELECT        dbo.lap_kunjungan_perina_sum_all_v.tgl, dbo.lap_kunjungan_perina_sum_all_v.bln, dbo.lap_kunjungan_perina_sum_all_v.thn, 
                         dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm, CASE WHEN lap_kunjungan_perina_pas1_v.pas1 IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_pas1_v.pas1 END AS pas1, CASE WHEN lap_kunjungan_perina_pas2_v.pas2 IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_pas2_v.pas2 END AS pas2, CASE WHEN lap_kunjungan_perina_pas3_v.pas3 IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_pas3_v.pas3 END AS pas3, dbo.lap_kunjungan_new_perina_temp.pas1 AS pas11, 
                         dbo.lap_kunjungan_new_perina_temp.pas2 AS pas21, dbo.lap_kunjungan_new_perina_temp.pas3 AS pas31
FROM            dbo.lap_kunjungan_perina_sum_all_v INNER JOIN
                         dbo.lap_kunjungan_new_perina_temp ON dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_new_perina_temp.thnnya AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_new_perina_temp.blnnya AND 
                         dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_new_perina_temp.tglnya LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_pas3_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_pas3_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_pas3_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_pas3_v.thn AND 
                         dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm = dbo.lap_kunjungan_perina_pas3_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_pas2_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_pas2_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_pas2_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_pas2_v.thn AND 
                         dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm = dbo.lap_kunjungan_perina_pas2_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_pas1_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_pas1_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_pas1_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_pas1_v.thn AND 
                         dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm = dbo.lap_kunjungan_perina_pas1_v.validasi_lap_rm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_perina_jml_pas_klas_v]");
    }
};
