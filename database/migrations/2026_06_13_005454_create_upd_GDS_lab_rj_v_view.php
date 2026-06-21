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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_GDS_lab_rj_v
AS
SELECT     dbo.fee_dokter_rajal_temp.id_fee_dr_rj_temp, dbo.fee_dokter_rajal_temp.kode_dr, dbo.fee_dokter_rajal_temp.no_kunjungan, dbo.fee_dokter_rajal_temp.no_registrasi, 
                      dbo.fee_dokter_rajal_temp.no_mr, dbo.fee_dokter_rajal_temp.seri_kuitansi, dbo.fee_dokter_rajal_temp.no_kuitansi, dbo.fee_dokter_rajal_temp.tgl_transaksi, dbo.fee_dokter_rajal_temp.tgl_kuitansi, 
                      dbo.fee_dokter_rajal_temp.kode_bagian, dbo.fee_dokter_rajal_temp.nama_tindakan, dbo.fee_dokter_rajal_temp.kode_trans_pelayanan, dbo.fee_dokter_rajal_temp.no_sppu, 
                      dbo.fee_dokter_rajal_temp.flag_sppu, dbo.fee_dokter_rajal_temp.tahun, dbo.fee_dokter_rajal_temp.jumlah, dbo.fee_dokter_rajal_temp.kode_kelompok, 
                      dbo.fee_dokter_rajal_temp.kode_perusahaan, dbo.fee_dokter_rajal_temp.kode_tc_trans_kasir, dbo.fee_dokter_rajal_temp.nama_pasien, dbo.fee_dokter_rajal_temp.no_induk, 
                      dbo.fee_dokter_rajal_temp.flag_umum, dbo.fee_dokter_rajal_temp.flag_pt, dbo.fee_dokter_rajal_temp.flag_ass, dbo.fee_dokter_rajal_temp.flag_bpjs, dbo.tc_trans_pelayanan.bill_rs, 
                      dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_rs_jatah + dbo.tc_trans_pelayanan.bill_dr1_jatah AS total, 
                      CAST((dbo.tc_trans_pelayanan.bill_rs_jatah + dbo.tc_trans_pelayanan.bill_dr1_jatah) * 1 / 100 AS int) AS jml_sekarang
FROM         dbo.fee_dokter_rajal_temp INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.fee_dokter_rajal_temp.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan
WHERE     (dbo.fee_dokter_rajal_temp.kode_dr = 138) AND (MONTH(dbo.fee_dokter_rajal_temp.tgl_kuitansi) = 12) AND (dbo.fee_dokter_rajal_temp.kode_kelompok > 1) AND 
                      (dbo.fee_dokter_rajal_temp.kode_kelompok NOT IN (9, 10))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_GDS_lab_rj_v]");
    }
};
