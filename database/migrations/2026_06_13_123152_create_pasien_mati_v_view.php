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
        DB::statement("CREATE VIEW dbo.pasien_mati_v
AS
SELECT     dbo.ri_tc_rawatinap.kode_ri, dbo.ri_tc_rawatinap.no_kunjungan, dbo.ri_tc_rawatinap.bag_pas, MONTH(dbo.ri_tc_rawatinap.tgl_keluar) AS bulan, 
                      YEAR(dbo.ri_tc_rawatinap.tgl_keluar) AS tahun, dbo.ri_tc_riwayat_kelas.kode_kematian, dbo.ri_tc_riwayat_kelas.ket_keluar, dbo.ri_tc_riwayat_kelas.no_registrasi, 
                      dbo.ri_tc_riwayat_kelas.no_mr, dbo.ri_tc_rawatinap.tgl_masuk, dbo.ri_tc_rawatinap.tgl_keluar
FROM         dbo.ri_tc_rawatinap INNER JOIN
                      dbo.ri_tc_riwayat_kelas ON dbo.ri_tc_rawatinap.kode_ri = dbo.ri_tc_riwayat_kelas.kode_ri AND 
                      dbo.ri_tc_rawatinap.bag_pas = dbo.ri_tc_riwayat_kelas.bagian_tujuan AND dbo.ri_tc_rawatinap.kelas_pas = dbo.ri_tc_riwayat_kelas.kelas_tujuan
WHERE     (dbo.ri_tc_riwayat_kelas.ket_keluar = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_mati_v]");
    }
};
