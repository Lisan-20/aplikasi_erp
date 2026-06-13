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
        DB::statement("CREATE VIEW dbo.pasien_jkn_rajal_v
AS
SELECT     TOP (100) PERCENT b.nama_pasien, c.nama_bagian, a.kode_trans_pelayanan, a.kode_tc_trans_kasir, a.no_kunjungan, a.no_registrasi, a.no_mr, a.nama_pasien_layan, a.kode_kelompok, 
                      a.kode_perusahaan, a.tgl_transaksi, a.jenis_tindakan, a.nama_tindakan, a.bill_rs, a.bill_dr1, a.bill_dr2, a.bill_rs_askes, a.bill_dr1_askes, a.bill_dr2_askes, a.bill_rs_jatah, a.bill_dr1_jatah, 
                      a.bill_dr2_jatah, a.lain_lain, a.kode_dokter1, a.kode_dokter2, a.jumlah, a.kode_barang, a.kode_master_tarif_detail, a.kode_master_tarif_detail_jatah, a.kd_tr_resep, a.kode_trans_far, a.kode_tarif, 
                      a.kode_bagian, a.kode_bagian_asal, a.kode_klas, a.no_kamar, a.no_bed, a.kode_penunjang, a.kode_profit, a.status_selesai, a.status_nk, a.status_kredit, a.status_batal, 
                      CASE WHEN diskon_rs IS NULL THEN 0 ELSE diskon_rs END AS diskon_rs, CASE WHEN diskon_dr1 IS NULL THEN 0 ELSE diskon_dr1 END AS diskon_dr1, CASE WHEN diskon_dr2 IS NULL 
                      THEN 0 ELSE diskon_dr2 END AS diskon_dr2, dbo.tc_registrasi.kode_kelompok AS Expr1, dbo.tc_registrasi.kode_perusahaan AS Expr2, dbo.tc_registrasi.kode_dokter, 
                      dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_registrasi.no_jkn, dbo.tc_registrasi.no_skp, dbo.tc_registrasi.plafon_bpjs, dbo.tc_registrasi.diagnosa, 
                      dbo.tc_registrasi.kode_plafon, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.noSep, dbo.tc_registrasi.status_batal AS Expr3, dbo.tc_registrasi.no_sjp, 
                      dbo.tc_sep_ri_temp.total_tarif AS TotalTarif
FROM         dbo.tc_trans_pelayanan AS a INNER JOIN
                      dbo.tc_registrasi ON a.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_bagian AS c ON dbo.tc_registrasi.kode_bagian_masuk = c.kode_bagian LEFT OUTER JOIN
                      dbo.tc_sep_ri_temp ON dbo.tc_registrasi.noSep = dbo.tc_sep_ri_temp.no_sep LEFT OUTER JOIN
                      dbo.mt_master_pasien AS b ON a.no_mr = b.no_mr
WHERE     (a.status_batal IS NULL) AND (dbo.tc_registrasi.kode_kelompok IN (8, 9, 10, 11, 12)) AND (dbo.tc_registrasi.kode_bagian_keluar NOT LIKE '03%') AND (dbo.tc_registrasi.status_batal IS NULL)
ORDER BY a.kode_trans_pelayanan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_jkn_rajal_v]");
    }
};
