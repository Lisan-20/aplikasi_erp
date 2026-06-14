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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_jml_partus_v
AS
SELECT     dbo.tc_bedah.kode_bagian, dbo.tc_bedah.kode_klas, MONTH(dbo.tc_bedah.tgl_transaksi) AS bulan, YEAR(dbo.tc_bedah.tgl_transaksi) AS tahun, 
                      dbo.tc_bedah.kode_kelompok, dbo.tc_bedah.kode_tarif, COUNT(dbo.tc_bedah.no_registrasi) AS jumlah, dbo.tc_bedah.kode_perusahaan, 
                      dbo.mt_master_tarif.nama_tarif
FROM         dbo.tc_bedah INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_bedah.kode_tarif = dbo.mt_master_tarif.kode_tarif
GROUP BY dbo.tc_bedah.kode_tarif, dbo.mt_master_tarif.nama_tarif, YEAR(dbo.tc_bedah.tgl_transaksi), MONTH(dbo.tc_bedah.tgl_transaksi), dbo.tc_bedah.kode_bagian, 
                      dbo.tc_bedah.kode_klas, dbo.tc_bedah.kode_kelompok, dbo.tc_bedah.kode_perusahaan
HAVING      (dbo.mt_master_tarif.nama_tarif LIKE 'partus%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_jml_partus_v]");
    }
};
