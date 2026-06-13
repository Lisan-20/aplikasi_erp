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
        DB::statement("CREATE VIEW dbo.fee_dr_perujuk_fis_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_kasir.kode_tc_trans_kasir, 
                      dbo.tc_trans_kasir.tgl_jam AS tgl_kuitansi, dbo.tc_registrasi.tgl_jam_masuk AS tgl_transaksi, dbo.tc_trans_kasir.status_batal AS status_batal_kasir, 
                      dbo.tc_registrasi.kode_bagian_masuk AS kode_bagian, dbo.tc_registrasi.flag_dr_fis_perujuk, dbo.pm_tc_penunjang.dr_pengirim, dbo.mt_karyawan.kode_dokter, 
                      dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.kode_trans_pelayanan
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi AND 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.pm_tc_penunjang ON dbo.tc_trans_pelayanan.kode_penunjang = dbo.pm_tc_penunjang.kode_penunjang INNER JOIN
                      dbo.mt_karyawan ON dbo.pm_tc_penunjang.dr_pengirim = dbo.mt_karyawan.nama_pegawai
GROUP BY dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_pelayanan.status_batal, 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_registrasi.flag_dr_fis_perujuk, 
                      dbo.pm_tc_penunjang.dr_pengirim, dbo.mt_karyawan.kode_dokter, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.kode_trans_pelayanan
HAVING      (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_registrasi.kode_bagian_masuk = '050301')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_dr_perujuk_fis_v]");
    }
};
