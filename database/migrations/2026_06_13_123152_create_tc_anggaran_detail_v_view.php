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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_anggaran_detail_v
AS
SELECT     dbo.mt_anggaran.id_master_agg, dbo.mt_anggaran.agg_no, dbo.mt_anggaran.agg_nama, dbo.mt_anggaran.level_agg, dbo.anggaran_pengajuan_v.bln, 
                      dbo.anggaran_pengajuan_v.thn, dbo.anggaran_pengajuan_v.minggu1, dbo.anggaran_pengajuan_v.minggu2, dbo.anggaran_pengajuan_v.minggu3, 
                      dbo.anggaran_pengajuan_v.minggu4, dbo.anggaran_pengajuan_v.ver_minggu1, dbo.anggaran_pengajuan_v.ver_minggu2, dbo.anggaran_pengajuan_v.ver_minggu3, 
                      dbo.anggaran_pengajuan_v.ver_minggu4, dbo.anggaran_pengajuan_v.catatan_verifikasi, dbo.anggaran_pengajuan_v.flag_agg, 
                      dbo.anggaran_pengajuan_v.rev_minggu5, dbo.anggaran_pengajuan_v.minggu5, dbo.anggaran_pengajuan_v.ver_minggu5, 
                      dbo.anggaran_pengajuan_v.rev_ver_minggu5, dbo.anggaran_pengajuan_v.flag_umd
FROM         dbo.anggaran_pengajuan_v RIGHT OUTER JOIN
                      dbo.mt_anggaran ON dbo.anggaran_pengajuan_v.agg_no = dbo.mt_anggaran.agg_no
WHERE     (dbo.anggaran_pengajuan_v.flag_umd IS NULL) AND (dbo.anggaran_pengajuan_v.bln = 6)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_anggaran_detail_v]");
    }
};
