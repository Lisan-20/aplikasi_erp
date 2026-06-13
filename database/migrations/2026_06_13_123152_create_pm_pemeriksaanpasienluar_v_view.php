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
        DB::statement("CREATE VIEW dbo.pm_pemeriksaanpasienluar_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, 
                      dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, 
                      dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, 
                      dbo.tc_trans_pelayanan.bill_dr2, dbo.tc_trans_pelayanan.bill_rs_askes, dbo.tc_trans_pelayanan.bill_dr1_askes, dbo.tc_trans_pelayanan.bill_dr2_askes, dbo.tc_trans_pelayanan.bill_rs_jatah, 
                      dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.bill_dr2_jatah, dbo.tc_trans_pelayanan.lain_lain, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_dokter2, 
                      dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.kode_master_tarif_detail, dbo.tc_trans_pelayanan.kode_master_tarif_detail_jatah, 
                      dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.kode_penunjang, 
                      dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_pelayanan.status_nk, dbo.pm_pasienluar_v.nama_pasien, dbo.pm_pasienluar_v.jen_kelamin, dbo.pm_pasienluar_v.dr_pengirim, 
                      dbo.pm_pasienluar_v.status_daftar, dbo.pm_pasienluar_v.catatan_hasil, dbo.pm_pasienluar_v.no_hasil_pm, dbo.pm_pasienluar_v.status_isihasil, dbo.pm_pasienluar_v.petugas_isihasil, 
                      dbo.pm_pasienluar_v.kode_kelompok AS Expr1, dbo.pm_pasienluar_v.kode_klas, dbo.pm_pasienluar_v.tgl_masuk, YEAR(dbo.pm_pasienluar_v.tgl_masuk) AS thn, 
                      MONTH(dbo.pm_pasienluar_v.tgl_masuk) AS bln, DAY(dbo.pm_pasienluar_v.tgl_masuk) AS tgl, dbo.pm_pasienluar_v.tgl_keluar, dbo.pm_pasienluar_v.status_batal, 
                      dbo.tc_trans_pelayanan.kode_paramedis, dbo.mt_master_tarif.flag_listrik, dbo.tc_trans_pelayanan.status_batal AS Expr2, dbo.pm_pasienluar_v.dokter_pengirim
FROM         dbo.pm_pasienluar_v INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_pasienluar_v.kode_penunjang = dbo.tc_trans_pelayanan.kode_penunjang LEFT OUTER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pemeriksaanpasienluar_v]");
    }
};
