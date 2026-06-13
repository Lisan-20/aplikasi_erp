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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_dpjp_rinap_v
AS
SELECT     tc_dpjp_rinap_1.kd_dpjp, tc_dpjp_rinap_1.kode_ri, tc_dpjp_rinap_1.no_kunjungan, tc_dpjp_rinap_1.no_mr, tc_dpjp_rinap_1.dr_merawat, tc_dpjp_rinap_1.tgl_mulai, tc_dpjp_rinap_1.tgl_selesai, 
                      tc_dpjp_rinap_1.input_tgl, tc_dpjp_rinap_1.user_dtg, tc_dpjp_rinap_1.kode_ruangan, tc_dpjp_rinap_1.bag_pas, tc_dpjp_rinap_1.kelas_pas, tc_dpjp_rinap_1.kode_jenis_dpjp, 
                      tc_dpjp_rinap_1.no_registrasi, dbo.mt_karyawan.nama_pegawai AS nama_dokter_merawat, dbo.mt_bagian.nama_bagian AS nama_bagian_dokter, dbo.mt_karyawan.flag_anes
FROM         dbo.tc_dpjp_rinap AS tc_dpjp_rinap_1 INNER JOIN
                      dbo.mt_karyawan ON tc_dpjp_rinap_1.dr_merawat = dbo.mt_karyawan.kode_dokter INNER JOIN
                      dbo.mt_bagian ON tc_dpjp_rinap_1.bag_pas = dbo.mt_bagian.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_dpjp_rinap_v]");
    }
};
