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
        DB::statement("CREATE OR ALTER VIEW dbo.fee_dr_perujuk_lab_v
AS
SELECT     dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.fee_dr, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.no_registrasi, 
                      dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_mr, dbo.tc_registrasi.kode_dokter, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.flag_dr_lab_perujuk, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_kasir.kode_tc_trans_kasir, 
                      dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_kasir.tgl_jam AS tgl_kuitansi, dbo.tc_trans_kasir.tgl_jam AS tgl_transaksi, 
                      dbo.mt_master_tarif.fee_dr * dbo.tc_trans_pelayanan.jumlah AS bill_dr
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi AND 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.mt_master_tarif.kode_bagian = '050101') AND (dbo.mt_master_tarif.fee_dr > 0) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND 
                      (dbo.tc_trans_pelayanan.flag_dr_lab_perujuk IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_dr_perujuk_lab_v]");
    }
};
