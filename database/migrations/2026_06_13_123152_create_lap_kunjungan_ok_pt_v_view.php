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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_ok_pt_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_bagian, dbo.lap_kunjungan_LP_v.tgl, dbo.lap_kunjungan_LP_v.bln, dbo.lap_kunjungan_LP_v.thn, 
                      COUNT(DISTINCT dbo.lap_kunjungan_LP_v.no_registrasi) AS jmlPas, dbo.lap_kunjungan_LP_v.kode_kelompok
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.lap_kunjungan_LP_v ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.lap_kunjungan_LP_v.no_kunjungan AND 
                      dbo.tc_trans_pelayanan.no_registrasi = dbo.lap_kunjungan_LP_v.no_registrasi
WHERE     (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.jenis_tindakan = 4)
GROUP BY dbo.tc_trans_pelayanan.kode_bagian, dbo.lap_kunjungan_LP_v.tgl, dbo.lap_kunjungan_LP_v.bln, dbo.lap_kunjungan_LP_v.thn, 
                      dbo.lap_kunjungan_LP_v.kode_kelompok
HAVING      (dbo.tc_trans_pelayanan.kode_bagian IN ('030901', '030501')) AND (dbo.lap_kunjungan_LP_v.kode_kelompok = 5)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_ok_pt_v]");
    }
};
