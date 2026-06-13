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
        DB::statement("CREATE OR ALTER VIEW dbo.fee_paramedis_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.no_registrasi, 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_kasir.status_batal, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_paramedis, dbo.tc_trans_kasir.no_mr, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_kasir.kode_perusahaan, dbo.mt_master_tarif.nama_tarif AS nama_tindakan, 
                      dbo.tc_trans_pelayanan.flag_param1, dbo.tc_trans_pelayanan.kode_dokter1, 
                      CASE WHEN dbo.tc_trans_pelayanan.kode_tarif = 305010110 THEN ((dbo.tc_trans_pelayanan.bill_dr1 + dbo.tc_trans_pelayanan.bill_rs) * 0.75) 
                      ELSE ((dbo.tc_trans_pelayanan.bill_dr1 + dbo.tc_trans_pelayanan.bill_rs) * 0.40) END AS insentif, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_pelayanan.tgl_transaksi
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.mt_master_tarif.flag_insentif = 1) AND (dbo.tc_trans_pelayanan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_paramedis_v]");
    }
};
