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
        DB::statement("CREATE OR ALTER VIEW dbo.v_revisi_kuitansi_ruangan_fix
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.bill_rs, 
                      dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.no_bed, 
                      dbo.mt_master_tarif_ruangan.kode_ruangan, dbo.mt_master_tarif_ruangan.harga_r, dbo.tc_trans_pelayanan.jumlah, dbo.mt_master_tarif_ruangan.harga_pt_ass, 
                      dbo.mt_master_tarif_ruangan.harga_bpjs, dbo.mt_master_tarif_ruangan.harga_inhealth, dbo.mt_master_tarif_ruangan.harga_hardlent, 
                      dbo.mt_master_tarif_ruangan.harga_nayaka, dbo.mt_master_tarif_ruangan.harga_kapitasi, dbo.mt_master_tarif_ruangan.harga_cahaya
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif_ruangan ON dbo.tc_trans_pelayanan.no_bed = dbo.mt_master_tarif_ruangan.kode_ruangan AND 
                      dbo.tc_trans_pelayanan.kode_klas = dbo.mt_master_tarif_ruangan.kode_klas
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0) AND (dbo.tc_trans_pelayanan.kode_tarif IS NULL) AND (dbo.tc_trans_pelayanan.jenis_tindakan IN (1)) AND 
                      (dbo.tc_trans_pelayanan.nama_tindakan LIKE 'ruangan%') AND (dbo.tc_trans_pelayanan.jumlah > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_revisi_kuitansi_ruangan_fix]");
    }
};
