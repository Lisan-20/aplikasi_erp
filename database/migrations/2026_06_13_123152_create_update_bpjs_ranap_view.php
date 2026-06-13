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
        DB::statement("CREATE OR ALTER VIEW dbo.update_bpjs_ranap
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, 
                      dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_klas, dbo.mt_master_tarif_detail_bpjs.kode_klas AS klas, 
                      dbo.mt_master_tarif_detail_bpjs.bill_rs AS rs, dbo.mt_master_tarif_detail_bpjs.bill_dr1 AS dr1, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bln
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif_detail_bpjs ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail_bpjs.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0) AND (dbo.tc_trans_pelayanan.kode_kelompok = 9) AND (dbo.tc_trans_pelayanan.kode_bagian LIKE '03%') AND 
                      (dbo.tc_trans_pelayanan.kode_tarif > 0) AND (dbo.tc_trans_pelayanan.no_registrasi IN (161398, 161993, 162011, 162012, 162432, 163157, 163470, 163522, 163646, 
                      163654, 163979, 163980, 163981, 164276, 164422, 164423, 164489, 164585, 164591, 164736, 164774, 164777, 165167, 165175, 165266, 165310, 165317, 165419, 
                      165434, 165524, 165526, 165527, 165528, 165906, 165916, 165941, 165959, 166015, 166083, 166102, 166161, 166179, 166306, 166313, 166526, 166559, 166568, 
                      166621, 166673, 166718, 166720, 166735, 166796, 166799, 166946, 167165, 167486, 167491, 167492, 167493, 167852, 167888, 168015, 168032, 168038, 168047, 
                      168162, 168397, 168418, 168434, 168628, 168702, 168706, 168717, 168877, 169018, 169404, 169410, 169615, 169646, 169657, 169824, 169853, 169915, 169933, 
                      170282, 170288, 170297, 170298, 170300, 170443, 170455, 170813, 170832, 170860, 171183, 171184, 171222, 171499, 171741, 171917, 171930, 172040, 172107, 
                      172112, 172408, 172506, 172519, 172559, 172712, 172747, 172891, 172892, 172994, 173083, 173444, 173537, 173551, 173616, 173626, 173714, 173729, 173730, 
                      173731, 173832, 173971, 174001, 174025, 174069, 174169, 174184, 174300, 174311, 174373, 174386, 174557, 174568, 174575, 174745, 174816, 174878, 174888, 
                      175015, 175035)) AND (dbo.tc_trans_pelayanan.kode_bagian <> '030901') AND (dbo.tc_trans_pelayanan.kode_klas <> 7) AND 
                      (dbo.mt_master_tarif_detail_bpjs.kode_klas = 7) AND (dbo.tc_trans_pelayanan.jenis_tindakan <> 4) AND (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) <> 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_bpjs_ranap]");
    }
};
