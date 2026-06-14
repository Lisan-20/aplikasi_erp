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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_ok_tind_sum_v
AS
SELECT     dbo.lap_kunjungan_ok_tind_v.tgl, dbo.lap_kunjungan_ok_tind_v.bln, dbo.lap_kunjungan_ok_tind_v.thn, dbo.lap_kunjungan_ok_tind_v.kode_bagian, 
                      COUNT(dbo.lap_kunjungan_ok_tind_v.no_registrasi) AS jmlTind, mt_master_tarif_1.referensi AS kode_tarif
FROM         dbo.lap_kunjungan_ok_tind_v INNER JOIN
                      dbo.mt_master_tarif ON dbo.lap_kunjungan_ok_tind_v.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.mt_master_tarif AS mt_master_tarif_1 ON dbo.mt_master_tarif.referensi = mt_master_tarif_1.kode_tarif
GROUP BY dbo.lap_kunjungan_ok_tind_v.tgl, dbo.lap_kunjungan_ok_tind_v.bln, dbo.lap_kunjungan_ok_tind_v.thn, dbo.lap_kunjungan_ok_tind_v.kode_bagian, mt_master_tarif_1.referensi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_ok_tind_sum_v]");
    }
};
