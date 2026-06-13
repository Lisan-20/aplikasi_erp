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
        DB::statement("CREATE VIEW dbo.update_dpjb_lama_v
AS
SELECT     dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_dokter1 AS dr_merawat, 
                      dbo.tc_kunjungan.tgl_masuk AS tgl_mulai, dbo.tc_trans_pelayanan.kode_bagian AS bag_pas, dbo.tc_trans_pelayanan.no_registrasi
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_trans_pelayanan.kode_dokter1 = dbo.mt_karyawan.kode_dokter INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.tc_kunjungan.no_kunjungan AND 
                      dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_kunjungan.no_registrasi
GROUP BY dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_kunjungan.tgl_masuk
HAVING      (dbo.tc_trans_pelayanan.kode_bagian LIKE '03%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_dpjb_lama_v]");
    }
};
