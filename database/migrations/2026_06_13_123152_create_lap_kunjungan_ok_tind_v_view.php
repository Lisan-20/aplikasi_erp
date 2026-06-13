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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_ok_tind_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_bagian, dbo.lap_kunjungan_LP_v.tgl, dbo.lap_kunjungan_LP_v.bln, dbo.lap_kunjungan_LP_v.thn, 
                      dbo.lap_kunjungan_LP_v.no_registrasi, dbo.lap_kunjungan_LP_v.stat_pasien
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.lap_kunjungan_LP_v ON dbo.tc_trans_pelayanan.no_registrasi = dbo.lap_kunjungan_LP_v.no_registrasi AND 
                      dbo.tc_trans_pelayanan.kode_bagian = dbo.lap_kunjungan_LP_v.kode_bagian_tujuan
WHERE     (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.jenis_tindakan = 4)
GROUP BY dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_bagian, dbo.lap_kunjungan_LP_v.tgl, dbo.lap_kunjungan_LP_v.bln, dbo.lap_kunjungan_LP_v.thn, 
                      dbo.lap_kunjungan_LP_v.no_registrasi, dbo.lap_kunjungan_LP_v.stat_pasien
HAVING      (dbo.tc_trans_pelayanan.kode_bagian IN ('030901', '030501'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_ok_tind_v]");
    }
};
