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
        DB::statement("CREATE VIEW dbo.pm_jumlah_pemeriksaan_pasien_v
AS
SELECT     dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.nama_pasien_layan, 
                      dbo.pm_pasien_pm_all_v.kode_kelompok, dbo.pm_pasien_pm_all_v.kode_perusahaan, dbo.tc_trans_pelayanan.tgl_transaksi, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, 
                      dbo.tc_trans_pelayanan.bill_dr2, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.bill_dr2_jatah, 
                      dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, 
                      dbo.tc_trans_pelayanan.kode_klas, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_pelayanan.kode_penunjang, dbo.mt_master_tarif.kode_tarif, 
                      dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.tingkatan, dbo.tc_kunjungan.status_batal
FROM         dbo.pm_pasien_pm_all_v INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_pasien_pm_all_v.kode_penunjang = dbo.tc_trans_pelayanan.kode_penunjang INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.tc_kunjungan.no_kunjungan RIGHT OUTER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.mt_master_tarif.tingkatan >= 4) AND (dbo.tc_trans_pelayanan.status_selesai >= 2) AND (dbo.tc_kunjungan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_jumlah_pemeriksaan_pasien_v]");
    }
};
