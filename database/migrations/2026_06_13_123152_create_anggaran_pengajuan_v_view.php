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
        DB::statement("CREATE VIEW dbo.anggaran_pengajuan_v
AS
SELECT     TOP (100) PERCENT dbo.tc_anggaran_biaya.id_angg_bln, dbo.tc_anggaran_biaya.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.tc_anggaran_biaya.bln, dbo.tc_anggaran_biaya.thn, 
                      dbo.tc_anggaran_biaya.agg_no, dbo.mt_anggaran.agg_nama, mt_anggaran_1.agg_nama AS nama_lev_4, dbo.tc_anggaran_biaya.minggu1, dbo.tc_anggaran_biaya.minggu2, 
                      dbo.tc_anggaran_biaya.minggu3, dbo.tc_anggaran_biaya.minggu4, dbo.tc_anggaran_biaya.catatan_pengajuan, dbo.tc_anggaran_biaya.tgl_pengajuan, dbo.tc_anggaran_biaya.user_id, 
                      dbo.tc_anggaran_biaya.ver_minggu1, dbo.tc_anggaran_biaya.ver_minggu2, dbo.tc_anggaran_biaya.ver_minggu3, dbo.tc_anggaran_biaya.ver_minggu4, dbo.tc_anggaran_biaya.catatan_verifikasi, 
                      dbo.tc_anggaran_biaya.flag_agg, dbo.tc_anggaran_biaya.rev_minggu5, dbo.tc_anggaran_biaya.minggu5, dbo.tc_anggaran_biaya.ver_minggu5, dbo.tc_anggaran_biaya.rev_ver_minggu5, 
                      CAST('-->' + mt_anggaran_1.agg_nama AS varchar) AS detail, dbo.mt_anggaran.kode_bagian AS kode_bagian_master, dbo.tc_anggaran_biaya.flag_umd
FROM         dbo.tc_anggaran_biaya INNER JOIN
                      dbo.mt_anggaran ON dbo.tc_anggaran_biaya.agg_no = dbo.mt_anggaran.agg_no INNER JOIN
                      dbo.mt_anggaran AS mt_anggaran_1 ON dbo.mt_anggaran.referensi = mt_anggaran_1.agg_no LEFT OUTER JOIN
                      dbo.mt_bagian ON dbo.tc_anggaran_biaya.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (dbo.tc_anggaran_biaya.bln = 6)
ORDER BY dbo.tc_anggaran_biaya.agg_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [anggaran_pengajuan_v]");
    }
};
