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
        DB::statement("CREATE VIEW dbo.update_transaksi_bpjs
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.mt_master_tarif_detail_bpjs.bill_rs AS rs, dbo.mt_master_tarif_detail_bpjs.bill_dr1 AS dr, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_klas, dbo.mt_master_tarif_detail_bpjs.kode_klas AS Expr3, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_pelayanan.tgl_transaksi, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) 
                      AS bln
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif_detail_bpjs ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail_bpjs.kode_tarif INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_pelayanan.kode_kelompok = 9) AND (dbo.tc_trans_pelayanan.jenis_tindakan <> 4) AND (NOT (dbo.tc_trans_pelayanan.kode_bagian LIKE '05%')) AND 
                      (dbo.mt_master_tarif_detail_bpjs.kode_klas = 7) AND (dbo.tc_trans_pelayanan.kode_tarif NOT IN
                          (SELECT     kode_tarif
                            FROM          dbo.mt_master_tarif_detail_bedah)) AND (dbo.tc_trans_pelayanan.bill_rs <> dbo.mt_master_tarif_detail_bpjs.bill_rs) AND 
                      (dbo.tc_trans_kasir.seri_kuitansi IN ('AI')) AND (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) >= 2) AND (dbo.tc_trans_pelayanan.no_registrasi IN (166102, 165959, 
                      163157, 163522, 166568, 166306, 166718, 166946, 165916, 166161, 166799, 166735, 166720, 165310, 165434, 165175, 164774, 167165, 163470, 167888, 174025, 
                      174025, 173444, 172891, 172891, 172891, 173444, 173444)) OR
                      (dbo.tc_trans_pelayanan.kode_kelompok = 9) AND (dbo.tc_trans_pelayanan.jenis_tindakan <> 4) AND (NOT (dbo.tc_trans_pelayanan.kode_bagian LIKE '05%')) AND 
                      (dbo.mt_master_tarif_detail_bpjs.kode_klas = 7) AND (dbo.tc_trans_pelayanan.kode_tarif NOT IN
                          (SELECT     kode_tarif
                            FROM          dbo.mt_master_tarif_detail_bedah AS mt_master_tarif_detail_bedah_1)) AND 
                      (dbo.tc_trans_pelayanan.bill_dr1 <> dbo.mt_master_tarif_detail_bpjs.bill_dr1) AND (dbo.tc_trans_kasir.seri_kuitansi IN ('AI')) AND 
                      (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) >= 2) AND (dbo.tc_trans_pelayanan.no_registrasi IN (166102, 165959, 163157, 163522, 166568, 166306, 166718, 
                      166946, 165916, 166161, 166799, 166735, 166720, 165310, 165434, 165175, 164774, 167165, 163470, 167888, 174025, 174025, 173444, 172891, 172891, 172891, 
                      173444, 173444))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_transaksi_bpjs]");
    }
};
