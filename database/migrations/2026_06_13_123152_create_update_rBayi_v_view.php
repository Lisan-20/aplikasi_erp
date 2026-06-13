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
        DB::statement("CREATE VIEW dbo.update_rBayi_v
AS
SELECT     dbo.tc_registrasi.no_mr, dbo.tc_registrasi.no_registrasi, dbo.mt_master_pasien.nama_pasien, dbo.ri_tc_riwayat_kelas.kode_ruangan, dbo.ri_tc_rawatinap.kode_ruangan AS kode_r1, 
                      dbo.tc_trans_pelayanan.kode_ruangan AS kode_r2, dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_registrasi.kode_bagian_keluar, dbo.ri_tc_riwayat_kelas.bagian_tujuan, 
                      dbo.ri_tc_rawatinap.bag_pas, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_trans_pelayanan.kode_bagian_asal AS kode_bagian_asal1, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.ri_tc_riwayat_kelas.kelas_tujuan, dbo.ri_tc_rawatinap.jatah_klas, dbo.tc_trans_pelayanan.kode_klas, dbo.ri_tc_rawatinap.kelas_pas, 
                      dbo.ri_tc_riwayat_kelas.no_kamar_tujuan, dbo.tc_trans_pelayanan.no_kamar, dbo.ri_tc_riwayat_kelas.no_bed_tujuan, dbo.tc_trans_pelayanan.no_bed, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.tc_trans_pelayanan.bill_rs, dbo.mt_master_tarif_ruangan.harga_r, dbo.tc_trans_pelayanan.jumlah
FROM         dbo.ri_tc_rawatinap INNER JOIN
                      dbo.ri_tc_riwayat_kelas ON dbo.ri_tc_rawatinap.kode_ri = dbo.ri_tc_riwayat_kelas.kode_ri INNER JOIN
                      dbo.tc_kunjungan ON dbo.ri_tc_rawatinap.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.ri_tc_riwayat_kelas.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.ri_tc_riwayat_kelas.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan INNER JOIN
                      dbo.mt_master_tarif_ruangan ON dbo.tc_trans_pelayanan.kode_ruangan = dbo.mt_master_tarif_ruangan.kode_ruangan
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.jenis_tindakan = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_rBayi_v]");
    }
};
