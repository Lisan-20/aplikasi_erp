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
        DB::statement("CREATE VIEW dbo.mt_pegawai_gaji_v
AS
SELECT     dbo.mt_gaji_pokok.status_gaji, dbo.mt_gaji_pokok.tgl_berlaku, dbo.mt_gaji_pokok.tgl_berakhir, dbo.mt_gaji_pokok.id_dd_gapok, 
                      dbo.mt_gaji_pokok.id_mt_gaji_pokok, dbo.mt_gaji_pokok.gapok, dbo.mt_gaji_pokok.tg, dbo.mt_gaji_pokok.gg, dbo.mt_gaji_pokok.npp, 
                      dbo.mt_gaji_pokok.nama_pegawai, dbo.mt_gaji_pokok.gross_pajak, dbo.mt_gaji_pokok.status_keluar, dbo.mt_gaji_pokok.id_dd_tg, dbo.mt_gaji_pokok.id_dd_gg, 
                      dbo.mt_gaji_pokok.no_sk, dbo.mt_gaji_pokok.tgl_sk, dbo.mt_gaji_pokok.id_dd_pajak_ptkp, dbo.mt_gaji_pokok.input_id, dbo.mt_gaji_pokok.input_tgl, 
                      dbo.mt_gaji_pokok.status
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.mt_gaji_pokok ON dbo.mt_karyawan.npp = dbo.mt_gaji_pokok.npp INNER JOIN
                      dbo.dd_gaji_pokok INNER JOIN
                      dbo.dd_gaji_tingkat ON dbo.dd_gaji_pokok.id_dd_tg = dbo.dd_gaji_tingkat.id_dd_tg INNER JOIN
                      dbo.dd_gaji_golongan ON dbo.dd_gaji_pokok.id_dd_gg = dbo.dd_gaji_golongan.id_dd_gg ON dbo.mt_gaji_pokok.id_dd_gapok = dbo.dd_gaji_pokok.id_dd_gapok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_pegawai_gaji_v]");
    }
};
