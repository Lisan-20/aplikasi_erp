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
        DB::statement("CREATE VIEW dbo.lap_poli_rujuk_rs_lain_v
AS
SELECT     DAY(dbo.gd_th_rujuk_rs.tgl_input) AS tgl, MONTH(dbo.gd_th_rujuk_rs.tgl_input) AS bln, YEAR(dbo.gd_th_rujuk_rs.tgl_input) AS thn, 
                      dbo.mt_master_pasien.nama_pasien, dbo.gd_th_rujuk_rs.alasan_rujuk, dbo.gd_th_rujuk_rs.no_registrasi, dbo.gd_th_rujuk_rs.no_mr, 
                      dbo.gd_th_rujuk_rs.kode_bagian_asal, dbo.mt_bagian.nama_bagian, dbo.gd_th_rujuk_rs.tgl_input, dbo.gd_th_rujuk_rs.rs_rujuk, dbo.mt_rs.nama_rs, 
                      dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.umur_pasien
FROM         dbo.gd_th_rujuk_rs LEFT OUTER JOIN
                      dbo.mt_rs ON dbo.gd_th_rujuk_rs.rs_rujuk = dbo.mt_rs.kode_rs LEFT OUTER JOIN
                      dbo.mt_bagian ON dbo.gd_th_rujuk_rs.kode_bagian_asal = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_master_pasien ON dbo.gd_th_rujuk_rs.no_mr = dbo.mt_master_pasien.no_mr
WHERE     (dbo.mt_master_pasien.nama_pasien IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_poli_rujuk_rs_lain_v]");
    }
};
