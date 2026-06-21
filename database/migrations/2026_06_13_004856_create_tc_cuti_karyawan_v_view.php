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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_cuti_karyawan_v
AS
SELECT     dbo.tc_cuti.id_htc_cuti, dbo.tc_cuti.npp, dbo.tc_cuti.id_dd_jenis_cuti, dbo.tc_cuti.tgl_pengajuan, dbo.tc_cuti.tgl_izin, dbo.tc_cuti.no_surat_izin, dbo.tc_cuti.tgl_mulai_cuti, dbo.tc_cuti.tgl_akhir_cuti, 
                      dbo.tc_cuti.jumlah_hari, dbo.tc_cuti.keterangan, dbo.tc_cuti.input_id, dbo.tc_cuti.input_tgl, dbo.tc_cuti.status, dbo.tc_cuti.status_tgl, dbo.tc_cuti.ko_wil, dbo.tc_cuti.flag_ver, dbo.tc_cuti.tgl_ver, 
                      dbo.tc_cuti.user_ver, CASE WHEN lev_jab = 5 THEN 1 ELSE flag_ver_ka_unit END AS flag_ver_ka_unit, dbo.tc_cuti.tgl_ver_ka_unit, dbo.tc_cuti.user_ver_ka_unit, 
                      CASE WHEN lev_jab = 4 THEN 1 ELSE flag_ver_ka_bid END AS flag_ver_ka_bid, dbo.tc_cuti.tgl_ver_ka_bid, dbo.tc_cuti.user_ver_ka_bid, dbo.mt_karyawan.nama_pegawai, 
                      dbo.mt_karyawan.kode_bagian, dbo.mt_karyawan.kode_jabatan, dbo.mt_jabatan.kd_st, dbo.mt_jabatan.ref_jab, dbo.mt_jabatan.lev_jab, dbo.mt_jabatan.nama_jabatan, dbo.tc_cuti.flag_ver_wadir, 
                      dbo.tc_cuti.nama_file, dbo.tc_cuti.tgl_ver_wadir, dbo.tc_cuti.alasan_tolak, dbo.tc_cuti.user_tolak, dbo.tc_cuti.tgl_tolak
FROM         dbo.tc_cuti INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_cuti.npp = dbo.mt_karyawan.npp LEFT OUTER JOIN
                      dbo.mt_jabatan ON dbo.mt_karyawan.kode_jabatan = dbo.mt_jabatan.kode_jabatan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_cuti_karyawan_v]");
    }
};
