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
        DB::statement("CREATE VIEW dbo.fee_dokter_rinap_bpjs_temp_v
AS
SELECT        dbo.fee_dokter_rinap_temp.kode_dr, dbo.fee_dokter_rinap_temp.no_registrasi, dbo.fee_dokter_rinap_temp.no_mr, dbo.fee_dokter_rinap_temp.seri_kuitansi, 
                         dbo.fee_dokter_rinap_temp.no_kuitansi, dbo.fee_dokter_rinap_temp.tgl_kuitansi, dbo.fee_dokter_rinap_temp.nama_tindakan, dbo.fee_dokter_rinap_temp.no_sppu, 
                         dbo.fee_dokter_rinap_temp.flag_sppu, dbo.fee_dokter_rinap_temp.tahun, dbo.fee_dokter_rinap_temp.kode_kelompok, dbo.fee_dokter_rinap_temp.kode_perusahaan, 
                         dbo.fee_dokter_rinap_temp.kode_tc_trans_kasir, dbo.fee_dokter_rinap_temp.nama_pasien, dbo.fee_dokter_rinap_temp.no_induk, 
                         dbo.fee_dokter_rinap_temp.flag_umum, dbo.fee_dokter_rinap_temp.flag_pt, dbo.fee_dokter_rinap_temp.flag_ass, dbo.fee_dokter_rinap_temp.flag_bpjs, 
                         dbo.fee_dokter_rinap_temp.flag_dr_pengirim_lab, dbo.fee_dokter_rinap_temp.flag_dr_pengirim_fis, dbo.fee_dokter_rinap_temp.id_fee_dr_manual, 
                         dbo.fee_dokter_rinap_temp.flag_billing_dr, dbo.fee_dokter_rinap_temp.id_jadwal, dbo.fee_dokter_rinap_temp.flag_inpatient, 
                         dbo.fee_dokter_rinap_temp.flag_bedah_bpjs, SUM(dbo.fee_dokter_rinap_temp.jumlah) AS jumlah, dbo.tc_registrasi.kode_plafon, dbo.tc_registrasi.plafon_bpjs, 
                         dbo.tc_trans_pelayanan.jenis_tindakan, dbo.fee_dokter_rinap_temp.kode_bagian
FROM            dbo.fee_dokter_rinap_temp LEFT OUTER JOIN
                         dbo.tc_trans_pelayanan ON dbo.fee_dokter_rinap_temp.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan LEFT OUTER JOIN
                         dbo.tc_registrasi ON dbo.fee_dokter_rinap_temp.no_registrasi = dbo.tc_registrasi.no_registrasi
GROUP BY dbo.fee_dokter_rinap_temp.kode_dr, dbo.fee_dokter_rinap_temp.no_registrasi, dbo.fee_dokter_rinap_temp.no_mr, dbo.fee_dokter_rinap_temp.seri_kuitansi, 
                         dbo.fee_dokter_rinap_temp.no_kuitansi, dbo.fee_dokter_rinap_temp.tgl_kuitansi, dbo.fee_dokter_rinap_temp.nama_tindakan, dbo.fee_dokter_rinap_temp.no_sppu, 
                         dbo.fee_dokter_rinap_temp.flag_sppu, dbo.fee_dokter_rinap_temp.tahun, dbo.fee_dokter_rinap_temp.kode_kelompok, dbo.fee_dokter_rinap_temp.kode_perusahaan, 
                         dbo.fee_dokter_rinap_temp.kode_tc_trans_kasir, dbo.fee_dokter_rinap_temp.nama_pasien, dbo.fee_dokter_rinap_temp.no_induk, 
                         dbo.fee_dokter_rinap_temp.flag_umum, dbo.fee_dokter_rinap_temp.flag_pt, dbo.fee_dokter_rinap_temp.flag_ass, dbo.fee_dokter_rinap_temp.flag_bpjs, 
                         dbo.fee_dokter_rinap_temp.flag_dr_pengirim_lab, dbo.fee_dokter_rinap_temp.flag_dr_pengirim_fis, dbo.fee_dokter_rinap_temp.id_fee_dr_manual, 
                         dbo.fee_dokter_rinap_temp.flag_billing_dr, dbo.fee_dokter_rinap_temp.id_jadwal, dbo.fee_dokter_rinap_temp.flag_inpatient, 
                         dbo.fee_dokter_rinap_temp.flag_bedah_bpjs, dbo.tc_registrasi.kode_plafon, dbo.tc_registrasi.plafon_bpjs, dbo.tc_trans_pelayanan.jenis_tindakan, 
                         dbo.fee_dokter_rinap_temp.kode_bagian
HAVING        (dbo.fee_dokter_rinap_temp.flag_sppu = 1) AND (dbo.fee_dokter_rinap_temp.kode_kelompok <> 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_dokter_rinap_bpjs_temp_v]");
    }
};
