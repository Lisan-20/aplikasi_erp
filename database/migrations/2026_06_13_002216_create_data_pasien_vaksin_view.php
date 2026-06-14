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
        DB::statement("CREATE OR ALTER VIEW dbo.data_pasien_vaksin
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.mt_master_pasien.no_mr, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, 
                      dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.kode_trans_far, dbo.mt_master_pasien.nama_pasien, 
                      dbo.mt_master_pasien.umur_pasien, dbo.mt_master_pasien.almt_ttp_pasien, dbo.mt_master_pasien.tlp_almt_ttp, dbo.mt_master_pasien.jen_kelamin, dbo.tc_trans_pelayanan.tgl_transaksi
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_master_pasien.no_mr = dbo.tc_trans_pelayanan.no_mr
GROUP BY dbo.tc_trans_pelayanan.no_registrasi, dbo.mt_master_pasien.no_mr, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, 
                      dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.kode_trans_far, dbo.mt_master_pasien.nama_pasien, 
                      dbo.mt_master_pasien.umur_pasien, dbo.mt_master_pasien.almt_ttp_pasien, dbo.mt_master_pasien.tlp_almt_ttp, dbo.mt_master_pasien.jen_kelamin, dbo.tc_trans_pelayanan.tgl_transaksi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [data_pasien_vaksin]");
    }
};
