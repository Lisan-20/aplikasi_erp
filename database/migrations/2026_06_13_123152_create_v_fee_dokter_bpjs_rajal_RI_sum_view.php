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
        DB::statement("CREATE VIEW dbo.v_fee_dokter_bpjs_rajal_RI_sum
AS
SELECT     dbo.v_fee_dokter_bpjs_rajal_RI.seri_kuitansi, dbo.v_fee_dokter_bpjs_rajal_RI.no_kuitansi, dbo.v_fee_dokter_bpjs_rajal_RI.tgl_jam, 
                      dbo.v_fee_dokter_bpjs_rajal_RI.no_registrasi, dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.tc_trans_jkn.persen_dr, dbo.tc_trans_jkn.id_jenis_layanan, 
                      dbo.v_fee_dokter_bpjs_rajal_RI.plafon / dbo.v_fee_dokter_bpjs_rajal_RI.persen_bpjs * dbo.tc_trans_jkn.persen_dr / dbo.v_fee_dokter_bpjs_rajal_RI.jumlah_tindakan AS
                       fee_dokter, dbo.v_fee_dokter_bpjs_rajal_RI.plafon, dbo.v_fee_dokter_bpjs_rajal_RI.persen_bpjs AS persen, dbo.tc_trans_pelayanan.kode_dokter1 AS kode_dr, 
                      dbo.tc_trans_jkn.nama_pasien_layan AS nama_pasien, dbo.tc_trans_jkn.kode_plafon, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.flag_dr1, 
                      dbo.v_fee_dokter_bpjs_rajal_RI.jumlah_tindakan
FROM         dbo.v_fee_dokter_bpjs_rajal_RI INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.v_fee_dokter_bpjs_rajal_RI.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.tc_trans_jkn ON dbo.v_fee_dokter_bpjs_rajal_RI.no_registrasi = dbo.tc_trans_jkn.no_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian AND 
                      dbo.tc_trans_jkn.id_jenis_layanan = dbo.mt_bagian.id_jenis_layanan
WHERE     (dbo.tc_trans_pelayanan.kode_bagian NOT LIKE '03%') AND (dbo.tc_trans_pelayanan.kode_tarif NOT IN
                          (SELECT     kode_tarif
                            FROM          dbo.mt_master_tarif_detail_bedah)) AND (dbo.tc_trans_pelayanan.kode_dokter1 > '0') AND (dbo.tc_trans_pelayanan.bill_dr1 > 0)
GROUP BY dbo.v_fee_dokter_bpjs_rajal_RI.seri_kuitansi, dbo.v_fee_dokter_bpjs_rajal_RI.no_kuitansi, dbo.v_fee_dokter_bpjs_rajal_RI.tgl_jam, 
                      dbo.v_fee_dokter_bpjs_rajal_RI.no_registrasi, dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.tc_trans_jkn.persen_dr, dbo.tc_trans_jkn.id_jenis_layanan, dbo.v_fee_dokter_bpjs_rajal_RI.plafon, dbo.v_fee_dokter_bpjs_rajal_RI.persen_bpjs, 
                      dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_jkn.nama_pasien_layan, dbo.tc_trans_jkn.kode_plafon, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.flag_dr1, dbo.v_fee_dokter_bpjs_rajal_RI.jumlah_tindakan
HAVING      (dbo.tc_trans_jkn.id_jenis_layanan IN (8, 9, 10, 11, 12))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_fee_dokter_bpjs_rajal_RI_sum]");
    }
};
