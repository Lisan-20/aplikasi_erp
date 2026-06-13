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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_ok_gol_bsr_v
AS
SELECT     TOP (100) PERCENT dbo.lap_kunjungan_ok_tind_v.tgl, dbo.lap_kunjungan_ok_tind_v.bln, dbo.lap_kunjungan_ok_tind_v.thn, mt_master_tarif_1.kode_grup_tindakan, 
                      COUNT(dbo.lap_kunjungan_ok_tind_v.no_registrasi) AS JmlPas, mt_master_tarif_1.kode_bagian
FROM         dbo.lap_kunjungan_ok_tind_v INNER JOIN
                      dbo.mt_master_tarif ON dbo.lap_kunjungan_ok_tind_v.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.mt_master_tarif AS mt_master_tarif_1 ON dbo.mt_master_tarif.referensi = mt_master_tarif_1.kode_tarif
GROUP BY dbo.lap_kunjungan_ok_tind_v.tgl, dbo.lap_kunjungan_ok_tind_v.bln, dbo.lap_kunjungan_ok_tind_v.thn, mt_master_tarif_1.kode_grup_tindakan, mt_master_tarif_1.kode_bagian
HAVING      (mt_master_tarif_1.kode_grup_tindakan = 3)
ORDER BY dbo.lap_kunjungan_ok_tind_v.bln, dbo.lap_kunjungan_ok_tind_v.tgl, mt_master_tarif_1.kode_grup_tindakan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_ok_gol_bsr_v]");
    }
};
