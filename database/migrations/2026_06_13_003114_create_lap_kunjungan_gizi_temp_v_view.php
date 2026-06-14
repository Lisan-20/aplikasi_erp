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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_gizi_temp_v
AS
SELECT     dbo.rekap_jml_diet_temp.jns_diet, dbo.rekap_jml_diet_temp.jumlah AS jml_diet, dbo.lap_kunjungan_gizi_temp.kelas_vvip, dbo.lap_kunjungan_gizi_temp.kelas_vip, 
                      dbo.lap_kunjungan_gizi_temp.kelas_I, dbo.lap_kunjungan_gizi_temp.kelas_II, dbo.lap_kunjungan_gizi_temp.kelas_III, dbo.lap_kunjungan_gizi_temp.anak, dbo.lap_kunjungan_gizi_temp.dewasa, 
                      dbo.lap_kunjungan_gizi_temp.umum, dbo.lap_kunjungan_gizi_temp.bpjs_pbi, dbo.lap_kunjungan_gizi_temp.bpjs_nonpbi, dbo.lap_kunjungan_gizi_temp.jamkesda, 
                      dbo.lap_kunjungan_gizi_temp.asuransi_lain, dbo.lap_kunjungan_gizi_temp.perusahaan, dbo.lap_kunjungan_gizi_temp.Bpjs_Ktngkrja, dbo.lap_kunjungan_gizi_temp.bpjs_cob, 
                      dbo.lap_kunjungan_gizi_temp.mutu, dbo.lap_kunjungan_gizi_temp.ketepatan_waktu, dbo.lap_kunjungan_gizi_temp.jumlah_pasien_tepat, dbo.lap_kunjungan_gizi_temp.jumlah_pasien, 
                      dbo.lap_kunjungan_gizi_temp.presentase, dbo.lap_kunjungan_gizi_temp.tepat_diet, dbo.lap_kunjungan_gizi_temp.sisa_makan, dbo.lap_kunjungan_gizi_temp.thn, 
                      dbo.lap_kunjungan_gizi_temp.bln, dbo.lap_kunjungan_gizi_temp.tgl, dbo.lap_kunjungan_gizi_temp.Jenis_diet, dbo.lap_kunjungan_gizi_temp.ml_diet, dbo.lap_kunjungan_gizi_temp.mb_diet, 
                      dbo.lap_kunjungan_gizi_temp.mc, dbo.lap_kunjungan_gizi_temp.b_saring, dbo.lap_kunjungan_gizi_temp.b_tim, dbo.lap_kunjungan_gizi_temp.ml_tanpa_diet, 
                      dbo.lap_kunjungan_gizi_temp.mb_tanpa_diet, dbo.lap_kunjungan_gizi_temp.jumlah_diet, dbo.lap_kunjungan_gizi_temp.jumlah_pasien_kelas, dbo.lap_kunjungan_gizi_temp.total_kelas, 
                      dbo.lap_kunjungan_gizi_temp.jumlah_hari_rawat, dbo.lap_kunjungan_gizi_temp.tota_hari, dbo.lap_kunjungan_gizi_temp.cara_pembayaran, dbo.lap_kunjungan_gizi_temp.total_bayar, 
                      dbo.lap_kunjungan_gizi_temp.distribusi
FROM         dbo.rekap_jml_diet_temp INNER JOIN
                      dbo.lap_kunjungan_gizi_temp ON dbo.rekap_jml_diet_temp.tgl = dbo.lap_kunjungan_gizi_temp.tgl AND dbo.rekap_jml_diet_temp.bln = dbo.lap_kunjungan_gizi_temp.bln AND 
                      dbo.rekap_jml_diet_temp.thn = dbo.lap_kunjungan_gizi_temp.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_gizi_temp_v]");
    }
};
