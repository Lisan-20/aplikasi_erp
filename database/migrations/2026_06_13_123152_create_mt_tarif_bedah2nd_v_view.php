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
        DB::statement("CREATE VIEW dbo.mt_tarif_bedah2nd_v
AS
SELECT     dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.kode_bagian, 
                      dbo.mt_master_tarif.referensi, dbo.mt_master_tarif.jenis_tindakan, dbo.mt_master_tarif.paket_askes, mt_master_tarif_1.nama_tarif AS nama_operasi, 
                      mt_master_tarif_1.tingkatan AS tingkat_operasi, mt_master_tarif_1.kode_bagian AS kode_bgn_operasi, 
                      mt_master_tarif_1.referensi AS referensi_operasi, mt_master_tarif_1.jenis_tindakan AS jenis_tindakan_operasi, 
                      mt_master_tarif_1.paket_askes AS paket_askes_operasi, dbo.mt_tgl_tarif.status, mt_master_tarif_2.kode_tarif AS kode_tarif_detail, 
                      mt_master_tarif_2.nama_tarif AS nama_tarif_detail, mt_master_tarif_2.tingkatan AS tingkat_detail, mt_master_tarif_2.kode_bagian AS kode_bgn_detail, 
                      mt_master_tarif_2.referensi AS referensi_detail, mt_master_tarif_2.jenis_tindakan AS jenis_tindakan_detail, 
                      mt_master_tarif_2.paket_askes AS paket_askes_detail, dbo.mt_master_tarif_detail.kode_master_tarif_detail, dbo.mt_master_tarif_detail.kode_klas, 
                      dbo.mt_master_tarif_detail.bill_rs, dbo.mt_master_tarif_detail.bill_dr1, dbo.mt_master_tarif_detail.bill_dr2, dbo.mt_master_tarif_detail.total
FROM         dbo.mt_master_tarif mt_master_tarif_2 INNER JOIN
                      dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif mt_master_tarif_1 ON dbo.mt_master_tarif.referensi = mt_master_tarif_1.kode_tarif ON 
                      mt_master_tarif_2.referensi = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.mt_master_tarif_detail ON mt_master_tarif_2.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif INNER JOIN
                      dbo.mt_tgl_tarif ON dbo.mt_master_tarif_detail.kode_tgl_tarif = dbo.mt_tgl_tarif.kode_tgl_tarif
WHERE     (dbo.mt_master_tarif.tingkatan = 4) AND (dbo.mt_master_tarif.kode_bagian = '030901') AND (mt_master_tarif_1.tingkatan = 3) AND 
                      (mt_master_tarif_2.tingkatan = 5) AND (dbo.mt_tgl_tarif.status = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tarif_bedah2nd_v]");
    }
};
