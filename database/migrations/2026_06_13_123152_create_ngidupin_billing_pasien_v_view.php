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
        DB::statement("CREATE OR ALTER VIEW dbo.ngidupin_billing_pasien_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.nama_pasien_layan, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, 
                      dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.ri_tc_rawatinap.tgl_keluar, 
                      dbo.ri_tc_rawatinap.status_pulang, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.status_selesai, dbo.mt_master_tarif_ruangan.harga_r, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.tgl_pindah, 
                      dbo.tc_trans_pelayanan.bill_dr2, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.bill_dr2_jatah
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.mt_master_tarif_ruangan ON dbo.ri_tc_rawatinap.bag_pas = dbo.mt_master_tarif_ruangan.kode_bagian AND 
                      dbo.tc_trans_pelayanan.kode_klas = dbo.mt_master_tarif_ruangan.kode_klas AND dbo.ri_tc_rawatinap.kelas_pas = dbo.mt_master_tarif_ruangan.kode_klas AND 
                      dbo.tc_trans_pelayanan.no_bed = dbo.mt_master_tarif_ruangan.kode_ruangan
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL) OR
                      (dbo.tc_trans_pelayanan.kode_tc_trans_kasir = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ngidupin_billing_pasien_v]");
    }
};
