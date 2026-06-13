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
        DB::statement("CREATE VIEW dbo.v_fee_dokter_bpjs_RI_visit_sum_sum
AS
SELECT     dbo.v_fee_dokter_bpjs_RI_visit_sum.no_registrasi, dbo.v_fee_dokter_bpjs_RI_visit_sum.seri_kuitansi, dbo.v_fee_dokter_bpjs_RI_visit_sum.no_kuitansi, 
                      dbo.v_fee_dokter_bpjs_RI_visit_sum.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_dokter1 AS kode_dr, dbo.tc_trans_pelayanan.flag_dr1, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.v_fee_dokter_bpjs_RI_visit_sum.jumlah_tindakan, 
                      dbo.v_fee_dokter_bpjs_RI_visit_sum.plafon, dbo.v_fee_dokter_bpjs_RI_visit_sum.persen_bpjs AS persen, dbo.v_fee_dokter_bpjs_RI_visit_sum.persen_dr, 
                      dbo.v_fee_dokter_bpjs_RI_visit_sum.plafon / dbo.v_fee_dokter_bpjs_RI_visit_sum.persen_bpjs * dbo.v_fee_dokter_bpjs_RI_visit_sum.persen_dr / dbo.v_fee_dokter_bpjs_RI_visit_sum.jumlah_tindakan
                       AS fee_dokter, dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.v_fee_dokter_bpjs_RI_visit_sum.kode_plafon, dbo.tc_trans_pelayanan.no_kunjungan, dbo.v_fee_dokter_bpjs_RI_visit_sum.nama_pasien, 
                      dbo.v_fee_dokter_bpjs_RI_visit_sum.no_mr, dbo.v_fee_dokter_bpjs_RI_visit_sum.tgl_jam, dbo.mt_karyawan.kode_spesialisasi, dbo.tc_registrasi.byr_selisih
FROM         dbo.v_fee_dokter_bpjs_RI_visit_sum INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.v_fee_dokter_bpjs_RI_visit_sum.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_trans_pelayanan.kode_dokter1 = dbo.mt_karyawan.kode_dokter INNER JOIN
                      dbo.tc_registrasi ON dbo.v_fee_dokter_bpjs_RI_visit_sum.no_registrasi = dbo.tc_registrasi.no_registrasi
GROUP BY dbo.v_fee_dokter_bpjs_RI_visit_sum.no_registrasi, dbo.v_fee_dokter_bpjs_RI_visit_sum.seri_kuitansi, dbo.v_fee_dokter_bpjs_RI_visit_sum.no_kuitansi, 
                      dbo.v_fee_dokter_bpjs_RI_visit_sum.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.flag_dr1, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.v_fee_dokter_bpjs_RI_visit_sum.jumlah_tindakan, dbo.v_fee_dokter_bpjs_RI_visit_sum.plafon, dbo.v_fee_dokter_bpjs_RI_visit_sum.persen_bpjs, 
                      dbo.v_fee_dokter_bpjs_RI_visit_sum.persen_dr, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.kode_trans_pelayanan,
                       dbo.tc_trans_pelayanan.tgl_transaksi, dbo.v_fee_dokter_bpjs_RI_visit_sum.kode_plafon, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.v_fee_dokter_bpjs_RI_visit_sum.nama_pasien, dbo.v_fee_dokter_bpjs_RI_visit_sum.no_mr, dbo.v_fee_dokter_bpjs_RI_visit_sum.tgl_jam, 
                      dbo.mt_karyawan.kode_spesialisasi, dbo.tc_registrasi.byr_selisih
HAVING      (dbo.tc_trans_pelayanan.jenis_tindakan = 4) AND (dbo.tc_trans_pelayanan.kode_bagian LIKE '03%') AND (dbo.tc_trans_pelayanan.kode_tarif NOT IN
                          (SELECT     kode_tarif
                            FROM          dbo.mt_master_tarif_detail_bedah)) AND (dbo.tc_trans_pelayanan.bill_dr1 > 0) AND (dbo.tc_registrasi.byr_selisih IS NULL OR
                      dbo.tc_registrasi.byr_selisih = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_fee_dokter_bpjs_RI_visit_sum_sum]");
    }
};
