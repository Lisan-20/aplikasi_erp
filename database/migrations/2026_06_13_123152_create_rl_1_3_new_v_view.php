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
        DB::statement("CREATE VIEW dbo.rl_1_3_new_v
AS
SELECT     dbo.mt_bagian.nama_bagian AS tujuan, dbo.ri_tc_riwayat_kelas.bagian_asal, COUNT(dbo.tc_registrasi.no_registrasi) AS jml_pasien, YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS thn
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.ri_tc_riwayat_kelas ON dbo.tc_registrasi.no_registrasi = dbo.ri_tc_riwayat_kelas.no_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.ri_tc_riwayat_kelas.bagian_asal = dbo.mt_bagian.kode_bagian
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_registrasi.no_registrasi IN
                          (SELECT     no_registrasi
                            FROM          dbo.tc_trans_kasir
                            WHERE      (status_batal IS NULL) AND (seri_kuitansi NOT IN ('UM'))))
GROUP BY YEAR(dbo.tc_registrasi.tgl_jam_masuk), dbo.mt_bagian.nama_bagian, dbo.ri_tc_riwayat_kelas.bagian_asal
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rl_1_3_new_v]");
    }
};
