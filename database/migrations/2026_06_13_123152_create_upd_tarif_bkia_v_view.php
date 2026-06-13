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
        DB::statement("CREATE VIEW dbo.upd_tarif_bkia_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, 
                      dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, 
                      dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.kode_dokter1, 
                      dbo.mt_master_tarif_detail.total, dbo.mt_master_tarif_detail.kode_tarif
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif AND 
                      dbo.tc_trans_pelayanan.kode_klas = dbo.mt_master_tarif_detail.kode_klas
WHERE     (dbo.tc_trans_pelayanan.jenis_tindakan = 4) AND (dbo.tc_trans_pelayanan.kode_bagian = '030601') AND (dbo.tc_trans_pelayanan.kode_kelompok = 1) AND 
                      (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) >= 8) AND (dbo.mt_master_tarif_detail.kode_tarif = 301010133)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_tarif_bkia_v]");
    }
};
