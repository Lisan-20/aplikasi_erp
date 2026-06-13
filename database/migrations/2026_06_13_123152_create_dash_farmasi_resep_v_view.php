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
        DB::statement("CREATE OR ALTER VIEW dbo.dash_farmasi_resep_v
AS
SELECT     TOP (100) PERCENT YEAR(dbo.fr_hisbebasluar_v.tgl_trans) AS thn, MONTH(dbo.fr_hisbebasluar_v.tgl_trans) AS bln, DAY(dbo.fr_hisbebasluar_v.tgl_trans) AS tgl, 
                      dbo.dash_farmasi_detail_v.nama_bagian, dbo.dash_farmasi_detail_v.kode_bagian, dbo.fr_hisbebasluar_v.kode_trans_far
FROM         dbo.fr_hisbebasluar_v INNER JOIN
                      dbo.dash_farmasi_detail_v ON dbo.fr_hisbebasluar_v.kode_trans_far = dbo.dash_farmasi_detail_v.kode_trans_far LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.fr_hisbebasluar_v.petugas = dbo.mt_karyawan.no_induk
GROUP BY YEAR(dbo.fr_hisbebasluar_v.tgl_trans), MONTH(dbo.fr_hisbebasluar_v.tgl_trans), DAY(dbo.fr_hisbebasluar_v.tgl_trans), dbo.dash_farmasi_detail_v.nama_bagian, 
                      dbo.dash_farmasi_detail_v.kode_bagian, dbo.fr_hisbebasluar_v.kode_trans_far
ORDER BY dbo.fr_hisbebasluar_v.kode_trans_far
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dash_farmasi_resep_v]");
    }
};
