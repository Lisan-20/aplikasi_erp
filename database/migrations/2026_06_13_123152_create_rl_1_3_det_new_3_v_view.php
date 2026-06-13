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
        DB::statement("CREATE VIEW dbo.rl_1_3_det_new_3_v
AS
SELECT     dbo.ri_tc_rawatinap.kelas_pas AS kelas_tujuan, dbo.ri_tc_rawatinap.status_batal, dbo.ri_tc_rawatinap.bag_pas AS bagian_asal, dbo.mt_bagian.nama_bagian, dbo.ri_tc_rawatinap.dr_merawat, 
                      dbo.mt_dokter_v.kd_bagian, YEAR(dbo.ri_tc_rawatinap.tgl_keluar) AS thn, MONTH(dbo.ri_tc_rawatinap.tgl_keluar) AS bln, dbo.ri_tc_rawatinap.tgl_keluar, dbo.mt_dokter_v.nama_bagian AS tujuan, 
                      dbo.ri_tc_rawatinap.kode_ri, dbo.mt_dokter_v.nama_pegawai
FROM         dbo.ri_tc_rawatinap INNER JOIN
                      dbo.mt_bagian ON dbo.ri_tc_rawatinap.bag_pas = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_dokter_v ON dbo.ri_tc_rawatinap.dr_merawat = dbo.mt_dokter_v.kode_dokter
WHERE     (dbo.ri_tc_rawatinap.status_batal IS NULL) AND (dbo.ri_tc_rawatinap.tgl_keluar IS NOT NULL) AND (dbo.ri_tc_rawatinap.bag_pas = '030601')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rl_1_3_det_new_3_v]");
    }
};
