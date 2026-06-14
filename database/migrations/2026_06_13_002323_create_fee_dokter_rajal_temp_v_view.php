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
        DB::statement("CREATE OR ALTER VIEW dbo.fee_dokter_rajal_temp_v
AS
SELECT        dbo.fee_dokter_rajal_temp.id_fee_dr_rj_temp, dbo.fee_dokter_rajal_temp.kode_dr, dbo.fee_dokter_rajal_temp.no_kunjungan, 
                         dbo.fee_dokter_rajal_temp.no_registrasi, dbo.fee_dokter_rajal_temp.no_mr, dbo.fee_dokter_rajal_temp.seri_kuitansi, dbo.fee_dokter_rajal_temp.no_kuitansi, 
                         dbo.fee_dokter_rajal_temp.tgl_transaksi, dbo.fee_dokter_rajal_temp.tgl_kuitansi, dbo.fee_dokter_rajal_temp.kode_bagian, 
                         dbo.fee_dokter_rajal_temp.nama_tindakan, dbo.fee_dokter_rajal_temp.kode_trans_pelayanan, dbo.fee_dokter_rajal_temp.no_sppu, 
                         dbo.fee_dokter_rajal_temp.flag_sppu, dbo.fee_dokter_rajal_temp.tahun, dbo.fee_dokter_rajal_temp.jumlah, dbo.fee_dokter_rajal_temp.kode_kelompok, 
                         dbo.fee_dokter_rajal_temp.kode_perusahaan, dbo.fee_dokter_rajal_temp.nama_pasien, dbo.fee_dokter_rajal_temp.no_induk, dbo.fee_dokter_rajal_temp.flag_umum, 
                         dbo.fee_dokter_rajal_temp.flag_pt, dbo.fee_dokter_rajal_temp.flag_ass, dbo.fee_dokter_rajal_temp.flag_bpjs, dbo.fee_dokter_rajal_temp.flag_dr_pengirim_lab, 
                         dbo.fee_dokter_rajal_temp.flag_dr_pengirim_fis, dbo.fee_dokter_rajal_temp.flag_dr_pengirim_rad, dbo.fee_dokter_rajal_temp.id_fee_dr_manual, 
                         dbo.fee_dokter_rajal_temp.flag_billing_dr, dbo.fee_dokter_rajal_temp.id_jadwal, dbo.fee_dokter_rajal_temp.flag_inpatient, dbo.tc_trans_pelayanan.jenis_tindakan, 
                         dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.fee_dokter_rajal_temp.fee_bpjs
FROM            dbo.tc_trans_pelayanan RIGHT OUTER JOIN
                         dbo.fee_dokter_rajal_temp ON dbo.tc_trans_pelayanan.kode_trans_pelayanan = dbo.fee_dokter_rajal_temp.kode_trans_pelayanan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_dokter_rajal_temp_v]");
    }
};
