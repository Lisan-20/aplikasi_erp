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
        DB::statement("CREATE OR ALTER VIEW dbo.fee_dokter_rinap_ok_bpjs_v
AS
SELECT     TOP (100) PERCENT dbo.fee_dokter_rinap_temp.id_fee_dr_ri_temp, dbo.fee_dokter_rinap_temp.kode_dr, dbo.fee_dokter_rinap_temp.no_kunjungan, dbo.fee_dokter_rinap_temp.no_registrasi, 
                      dbo.fee_dokter_rinap_temp.no_mr, dbo.fee_dokter_rinap_temp.seri_kuitansi, dbo.fee_dokter_rinap_temp.no_kuitansi, dbo.fee_dokter_rinap_temp.tgl_transaksi, 
                      dbo.fee_dokter_rinap_temp.tgl_kuitansi, dbo.fee_dokter_rinap_temp.kode_bagian, dbo.fee_dokter_rinap_temp.nama_tindakan, dbo.fee_dokter_rinap_temp.kode_trans_pelayanan, 
                      dbo.fee_dokter_rinap_temp.no_sppu, dbo.fee_dokter_rinap_temp.flag_sppu, dbo.fee_dokter_rinap_temp.tahun, dbo.fee_dokter_rinap_temp.jumlah, dbo.fee_dokter_rinap_temp.kode_kelompok, 
                      dbo.fee_dokter_rinap_temp.kode_perusahaan, dbo.fee_dokter_rinap_temp.kode_tc_trans_kasir, dbo.fee_dokter_rinap_temp.nama_pasien, dbo.fee_dokter_rinap_temp.no_induk, 
                      dbo.fee_dokter_rinap_temp.flag_umum, dbo.fee_dokter_rinap_temp.flag_pt, dbo.fee_dokter_rinap_temp.flag_ass, dbo.fee_dokter_rinap_temp.flag_bpjs, 
                      dbo.fee_dokter_rinap_temp.flag_dr_pengirim_lab, dbo.fee_dokter_rinap_temp.flag_dr_pengirim_fis, dbo.fee_dokter_rinap_temp.id_fee_dr_manual, dbo.fee_dokter_rinap_temp.flag_billing_dr, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.fee_dokter_rinap_temp.fee_bpjs
FROM         dbo.fee_dokter_rinap_temp INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.fee_dokter_rinap_temp.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan
WHERE     (dbo.fee_dokter_rinap_temp.flag_sppu IS NULL OR
                      dbo.fee_dokter_rinap_temp.flag_sppu = 0) AND (dbo.fee_dokter_rinap_temp.kode_kelompok NOT IN (1, 3, 5)) AND (dbo.fee_dokter_rinap_temp.kode_bagian IN ('030901', '030501')) AND 
                      (dbo.tc_trans_pelayanan.jenis_tindakan <> 3) AND (NOT (dbo.fee_dokter_rinap_temp.nama_tindakan LIKE 'visit%'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_dokter_rinap_ok_bpjs_v]");
    }
};
