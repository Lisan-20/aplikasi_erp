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
        DB::statement("CREATE VIEW dbo.pasien_ranap_bln_feb
AS
SELECT     dbo.ri_tc_rawatinap.tgl_masuk, dbo.ri_tc_rawatinap.tgl_keluar, dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.debet, dbo.tc_trans_kasir.kredit, dbo.tc_trans_kasir.nd, dbo.tc_trans_kasir.nk, 
                      dbo.tc_trans_kasir.nk_perusahaan
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_kunjungan.no_registrasi = dbo.tc_trans_kasir.no_registrasi INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (MONTH(dbo.tc_kunjungan.tgl_masuk) IN (2, 3, 4)) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_kasir.seri_kuitansi <> 'UM') AND 
                      (dbo.tc_trans_kasir.tunai + dbo.tc_trans_kasir.debet + dbo.tc_trans_kasir.kredit + dbo.tc_trans_kasir.nk + dbo.tc_trans_kasir.nk_perusahaan BETWEEN 5000000 AND 
                      6000000) AND (dbo.tc_registrasi.kode_kelompok = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_ranap_bln_feb]");
    }
};
