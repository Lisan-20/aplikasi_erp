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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_tindakan_gigi_bagi_dr_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.bill_rs, 
                      dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.mt_master_tarif_detail.bill_rs_pt, dbo.mt_master_tarif_detail.bill_dr1_pt
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.kode_tarif IN ('111000000', '111010000', '111010100', '111010101', '111010102', '111010103', '111010104', '111010105', 
                      '111010106', '111010107', '111010108', '111010109', '111010110', '111010111', '111010112', '111010113', '111010114', '111010115', '111010116', 
                      '111010117', '111010118', '111010119', '111010120', '111010121', '111010122', '111010123', '111010124', '111010125', '111010126', '111010127', 
                      '111010128', '111010129', '111010130', '111010131', '111010132', '111010133', '111010134', '111010135', '111010136', '111010137', '111010138', 
                      '111010139', '111010140', '111010141', '111010142', '111010143', '111010144', '111010145', '111010146', '111010147', '111010148', '111010149', 
                      '111010150', '111010151', '111010152', '111010153', '111010154', '111010155', '111010156', '111010157', '111010158', '111010159', '111010160', 
                      '111010161', '111010162', '111010163', '111010164', '111010165', '111010166', '111010167', '111010168', '111010169', '111010170', '111010171')) 
                      AND (dbo.tc_trans_pelayanan.kode_kelompok > 1) AND (dbo.tc_trans_pelayanan.kode_tarif NOT IN (111010169, 111010171, 111010131))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_tindakan_gigi_bagi_dr_v]");
    }
};
