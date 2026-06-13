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
        DB::statement("CREATE OR ALTER VIEW dbo.update_ruang_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.bill_rs, dbo.mt_master_tarif_ruangan.harga_bpjs, dbo.tc_trans_pelayanan.nama_tindakan, dbo.mt_master_tarif_ruangan.harga_r, 
                      dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.no_bed, dbo.tc_trans_pelayanan.no_registrasi
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif_ruangan ON dbo.tc_trans_pelayanan.no_bed = dbo.mt_master_tarif_ruangan.kode_ruangan
WHERE     (dbo.tc_trans_pelayanan.jenis_tindakan = 1) AND (dbo.tc_trans_pelayanan.kode_tc_trans_kasir = 0) AND (dbo.tc_trans_pelayanan.nama_tindakan LIKE 'ruang%') AND 
                      (dbo.tc_trans_pelayanan.kode_kelompok IN (8, 9, 10)) AND (dbo.tc_trans_pelayanan.bill_rs IS NULL) OR
                      (dbo.tc_trans_pelayanan.jenis_tindakan = 1) AND (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL) AND (dbo.tc_trans_pelayanan.nama_tindakan LIKE 'ruang%') AND 
                      (dbo.tc_trans_pelayanan.kode_kelompok IN (8, 9, 10)) AND (dbo.tc_trans_pelayanan.bill_rs <> dbo.mt_master_tarif_ruangan.harga_bpjs) AND (dbo.tc_trans_pelayanan.jumlah = 0) AND 
                      (dbo.mt_master_tarif_ruangan.harga_bpjs > 0)
ORDER BY dbo.tc_trans_pelayanan.tgl_transaksi DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_ruang_v]");
    }
};
