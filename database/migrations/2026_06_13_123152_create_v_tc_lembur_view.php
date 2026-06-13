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
        DB::statement("CREATE OR ALTER VIEW dbo.v_tc_lembur
AS
SELECT     TOP (100) PERCENT dbo.mt_karyawan.nama_pegawai, dbo.tc_lembur.id_hrtc_lembur, dbo.tc_lembur.npp, dbo.tc_lembur.tgl_lembur, dbo.tc_lembur.kegiatan, dbo.tc_lembur.jam_mulai_lembur, 
                      dbo.tc_lembur.jam_akhir_lembur, dbo.tc_lembur.jumlah_jam_lembur, dbo.tc_lembur.jumlah_uang_makan, dbo.tc_lembur.jumlah_uang_lembur, dbo.tc_lembur.surat_perintah, 
                      dbo.tc_lembur.input_id, dbo.tc_lembur.input_tgl, dbo.tc_lembur.status, dbo.tc_lembur.status_tgl, dbo.tc_lembur.keterangan, dbo.tc_lembur.flag_gol_lembur, dbo.tc_lembur.flag_ver, 
                      dbo.tc_lembur.tgl_ver, dbo.tc_lembur.user_ver, dbo.mt_karyawan.kode_bagian
FROM         dbo.tc_lembur INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_lembur.npp = dbo.mt_karyawan.npp
ORDER BY dbo.tc_lembur.tgl_lembur DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_tc_lembur]");
    }
};
