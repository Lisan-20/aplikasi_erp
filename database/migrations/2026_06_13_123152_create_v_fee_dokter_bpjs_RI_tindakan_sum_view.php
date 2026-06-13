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
        DB::statement("CREATE VIEW dbo.v_fee_dokter_bpjs_RI_tindakan_sum
AS
SELECT     dbo.v_fee_dokter_bpjs_tindakan.seri_kuitansi, dbo.v_fee_dokter_bpjs_tindakan.no_kuitansi, dbo.tc_trans_pelayanan.kode_trans_pelayanan, 
                      dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.tc_trans_pelayanan.kode_dokter1 AS kode_dr, dbo.tc_trans_pelayanan.kode_bagian, dbo.v_fee_dokter_bpjs_tindakan.no_mr, 
                      dbo.v_fee_dokter_bpjs_tindakan.no_registrasi, dbo.v_fee_dokter_bpjs_tindakan.persen_bpjs AS persen, dbo.v_fee_dokter_bpjs_tindakan.plafon, 
                      dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.flag_dr1, dbo.tc_trans_jkn.nama_pasien_layan AS nama_pasien, dbo.tc_trans_jkn.id_jenis_layanan, 
                      dbo.tc_trans_jkn.persen_dr, dbo.v_fee_dokter_bpjs_tindakan.jumlah_tindakan, 
                      dbo.v_fee_dokter_bpjs_tindakan.plafon / dbo.v_fee_dokter_bpjs_tindakan.persen_bpjs * dbo.tc_trans_jkn.persen_dr / dbo.v_fee_dokter_bpjs_tindakan.jumlah_tindakan
                       AS fee_dokter, dbo.tc_trans_jkn.kode_plafon, dbo.v_fee_dokter_bpjs_tindakan.tgl_jam
FROM         dbo.v_fee_dokter_bpjs_tindakan INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.v_fee_dokter_bpjs_tindakan.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi INNER JOIN
                      dbo.tc_trans_jkn ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_jkn.kode_tc_trans_kasir AND 
                      dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_trans_jkn.no_registrasi
WHERE     (dbo.tc_trans_pelayanan.jenis_tindakan <> 4) AND (dbo.tc_trans_pelayanan.kode_bagian LIKE '03%') AND (dbo.tc_trans_pelayanan.kode_bagian <> '030901') AND 
                      (dbo.tc_trans_pelayanan.bill_dr1 > 0) AND (dbo.tc_trans_pelayanan.kode_dokter1 > 0) AND (dbo.tc_trans_jkn.id_jenis_layanan = 5)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_fee_dokter_bpjs_RI_tindakan_sum]");
    }
};
