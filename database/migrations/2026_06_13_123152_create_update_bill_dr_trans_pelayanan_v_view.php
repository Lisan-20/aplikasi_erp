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
        DB::statement("CREATE VIEW dbo.update_bill_dr_trans_pelayanan_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, 
                      dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.bill_rs, 
                      dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.mt_master_tarif_detail.total, dbo.mt_master_tarif.kode_bagian, 
                      dbo.tc_trans_pelayanan.status_selesai, dbo.mt_master_tarif_detail.total * 55 / 100 AS tarif_rs, dbo.mt_master_tarif_detail.total * 45 / 100 AS tarif_dr, 
                      dbo.tc_trans_pelayanan.bill_rs + dbo.tc_trans_pelayanan.bill_dr1 AS TOTAL2, dbo.tc_trans_pelayanan.kode_klas
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif AND 
                      dbo.tc_trans_pelayanan.kode_klas = dbo.mt_master_tarif_detail.kode_klas INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif AND 
                      dbo.mt_master_tarif_detail.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.status_selesai >= 2) AND (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) = 8) AND (dbo.tc_trans_pelayanan.kode_kelompok = 5) AND 
                      (dbo.tc_trans_pelayanan.kode_perusahaan > 0) AND (dbo.tc_trans_pelayanan.kode_bagian IN ('030501', '030901')) AND (dbo.tc_trans_pelayanan.jenis_tindakan = 4) 
                      AND (dbo.tc_trans_pelayanan.nama_tindakan NOT LIKE '%spesialis%') AND (dbo.tc_trans_pelayanan.nama_tindakan NOT LIKE '%phone%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_bill_dr_trans_pelayanan_v]");
    }
};
