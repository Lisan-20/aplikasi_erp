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
        DB::statement("CREATE VIEW dbo.rl_31_det_v
AS
SELECT     dbo.tc_kunjungan.no_registrasi, DAY(dbo.tc_kunjungan.tgl_masuk) AS day, MONTH(dbo.tc_kunjungan.tgl_masuk) AS bln, 
                      YEAR(dbo.tc_kunjungan.tgl_masuk) AS thn, dbo.tc_kunjungan.kode_bagian_tujuan AS kode_bagian, dbo.tc_kunjungan.kode_bagian_asal, 
                      dbo.th_icd10_pasien.status_hidup AS jml
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.th_icd10_pasien ON dbo.tc_kunjungan.no_mr = dbo.th_icd10_pasien.no_mr AND 
                      dbo.tc_kunjungan.no_registrasi = dbo.th_icd10_pasien.no_registrasi
GROUP BY DAY(dbo.tc_kunjungan.tgl_masuk), MONTH(dbo.tc_kunjungan.tgl_masuk), YEAR(dbo.tc_kunjungan.tgl_masuk), 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_kunjungan.no_registrasi, 
                      dbo.th_icd10_pasien.status_hidup
HAVING      (dbo.tc_kunjungan.kode_bagian_asal LIKE '03%') AND (dbo.th_icd10_pasien.status_hidup = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rl_31_det_v]");
    }
};
