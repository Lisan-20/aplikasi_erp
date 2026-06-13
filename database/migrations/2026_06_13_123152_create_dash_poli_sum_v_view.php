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
        DB::statement("CREATE OR ALTER VIEW dbo.dash_poli_sum_v
AS
SELECT     dbo.lap_dokter_harian2_v.tgl, dbo.lap_dokter_harian2_v.bln, dbo.lap_dokter_harian2_v.thn, COUNT(dbo.lap_dokter_harian2_v.no_kunjungan) AS jml, 
                      dbo.lap_dokter_harian2_v.kode_bagian_tujuan AS kode_bagian, dbo.mt_bagian.nama_bagian, dbo.mt_bagian.validasi
FROM         dbo.lap_dokter_harian2_v INNER JOIN
                      dbo.mt_bagian ON dbo.lap_dokter_harian2_v.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian
GROUP BY dbo.lap_dokter_harian2_v.tgl, dbo.lap_dokter_harian2_v.bln, dbo.lap_dokter_harian2_v.thn, dbo.lap_dokter_harian2_v.kode_bagian_tujuan, 
                      dbo.mt_bagian.nama_bagian, dbo.mt_bagian.validasi
HAVING      (dbo.mt_bagian.validasi = '010001') AND (dbo.lap_dokter_harian2_v.kode_bagian_tujuan <> '020101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dash_poli_sum_v]");
    }
};
