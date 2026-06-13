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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_lembur_cuti_v
AS
SELECT     TOP (100) PERCENT a.id_hrtc_lembur, a.npp, a.tgl_lembur, a.kegiatan, a.jam_mulai_lembur, a.jam_akhir_lembur, a.jumlah_jam_lembur, a.jumlah_uang_makan, a.jumlah_uang_lembur, 
                      a.surat_perintah, a.input_id, a.input_tgl, a.status, a.status_tgl, a.keterangan, b.nama_pegawai, a.flag_gol_lembur, b.kode_bagian, dbo.mt_bagian.kode_bagian AS Expr1, 
                      dbo.mt_bagian.nama_bagian, DAY(a.tgl_lembur) AS hari, dbo.jumlah_cuti_v.tgl_pengajuan, dbo.jumlah_cuti_v.jumlah_hari, dbo.jumlah_cuti_v.id_dd_jenis_cuti
FROM         dbo.tc_lembur AS a INNER JOIN
                      dbo.mt_karyawan AS b ON a.npp = b.npp INNER JOIN
                      dbo.mt_bagian ON b.kode_bagian = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.jumlah_cuti_v ON b.npp = dbo.jumlah_cuti_v.npp
ORDER BY a.tgl_lembur DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_lembur_cuti_v]");
    }
};
