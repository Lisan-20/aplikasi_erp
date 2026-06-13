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
        DB::statement("CREATE OR ALTER VIEW dbo.v_Tobilling_bpjs_rajal
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_dr2, dbo.tc_trans_pelayanan.jumlah, 
                      dbo.mt_master_tarif_detail_bpjs.bill_rs AS bill_rs_bpjs, dbo.mt_master_tarif_detail_bpjs.bill_dr1 AS bill_dr1_bpjs, 
                      dbo.mt_master_tarif_detail_bpjs.bill_dr2 AS bill_dr2_bpjs, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.jenis_tindakan AS jt_bpjs
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif_detail_bpjs ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail_bpjs.kode_tarif AND 
                      dbo.tc_trans_pelayanan.kode_klas = dbo.mt_master_tarif_detail_bpjs.kode_klas INNER JOIN
                      dbo.mt_master_tarif ON dbo.mt_master_tarif_detail_bpjs.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.no_registrasi = 158013)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_Tobilling_bpjs_rajal]");
    }
};
