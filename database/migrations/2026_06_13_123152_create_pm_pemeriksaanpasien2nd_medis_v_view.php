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
        DB::statement("CREATE VIEW dbo.pm_pemeriksaanpasien2nd_medis_v
AS
SELECT     dbo.pm_pasienpm_v.status_daftar, dbo.pm_pasienpm_v.jen_kelamin, dbo.pm_pasienpm_v.catatan_hasil, dbo.pm_pasienpm_v.nama_pasien, 
                      dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.nama_pasien_layan, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.jenis_tindakan, 
                      dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_dr2, 
                      dbo.tc_trans_pelayanan.bill_rs_askes, dbo.tc_trans_pelayanan.bill_dr1_askes, dbo.tc_trans_pelayanan.bill_dr2_askes, 
                      dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.bill_dr2_jatah, 
                      dbo.tc_trans_pelayanan.lain_lain, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_dokter2, dbo.tc_trans_pelayanan.jumlah, 
                      dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.kode_master_tarif_detail, dbo.tc_trans_pelayanan.kode_master_tarif_detail_jatah, 
                      dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.status_selesai, 
                      dbo.tc_trans_pelayanan.status_nk, dbo.pm_pasienpm_v.dr_pengirim, dbo.pm_pasienpm_v.no_registrasi, dbo.pm_pasienpm_v.kode_bagian, 
                      dbo.pm_pasienpm_v.kode_penunjang, dbo.pm_pasienpm_v.tgl_daftar AS tgl_transaksi, dbo.pm_pasienpm_v.status_isihasil, 
                      dbo.pm_pasienpm_v.no_kunjungan, dbo.pm_pasienpm_v.no_mr, dbo.tc_trans_pelayanan.kode_klas
FROM         dbo.pm_pasienpm_v LEFT OUTER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_pasienpm_v.kode_penunjang = dbo.tc_trans_pelayanan.kode_penunjang
WHERE     (NOT (dbo.tc_trans_pelayanan.nama_tindakan LIKE '%ADM%'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pemeriksaanpasien2nd_medis_v]");
    }
};
