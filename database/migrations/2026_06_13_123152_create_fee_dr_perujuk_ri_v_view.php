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
        DB::statement("CREATE VIEW dbo.fee_dr_perujuk_ri_v
AS
SELECT     7500 AS fee_dr, 1 AS jumlah, dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.no_kunjungan, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.kode_dokter, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.status_batal, 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.tgl_jam AS tgl_kuitansi, dbo.tc_trans_kasir.tgl_jam AS tgl_transaksi, dbo.ri_tc_rawatinap.bag_pas AS kode_bagian, 
                      dbo.mt_bagian.nama_bagian, dbo.ri_tc_rawatinap.flag_dr_ri_perujuk, 'INPATIENT' AS nama_tindakan, dbo.tc_kunjungan.status_batal AS batal
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_kasir.seri_kuitansi <> 'UM') AND (dbo.mt_bagian.kode_bagian IN ('020101', '012201')) AND (dbo.tc_kunjungan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_dr_perujuk_ri_v]");
    }
};
