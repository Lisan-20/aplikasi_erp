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
        DB::statement("CREATE OR ALTER VIEW dbo.v_insentif_bpjs_dokter
AS
SELECT     dbo.v_insentif_bpjs.kode_tc_trans_kasir, dbo.v_insentif_bpjs.no_kunjungan, dbo.v_insentif_bpjs.no_registrasi, dbo.v_insentif_bpjs.no_mr, 
                      dbo.v_insentif_bpjs.tgl_transaksi, dbo.v_insentif_bpjs.billing, dbo.v_insentif_bpjs.plafon, dbo.v_insentif_bpjs.selisih, dbo.v_insentif_bpjs.kode_plafon, 
                      dbo.v_insentif_bpjs.kode_bagian_asal, dbo.v_insentif_bpjs.flag_ins, dbo.v_insentif_bpjs.seri_kuitansi, dbo.v_insentif_bpjs.no_kuitansi, 
                      dbo.jumlah_dr_bpjs_v.jumlah_dr, dbo.dokter_bpjs_v.kode_dokter1 AS kode_dr, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.seri_kuitansi AS Expr1, 
                      dbo.tc_trans_kasir.no_kuitansi AS Expr2, dbo.tc_trans_kasir.nama_pasien, dbo.perbandingan_jasa_dr_bpjs_v.billing_dr, 
                      dbo.perbandingan_jasa_dr_bpjs_v.plafon_dr
FROM         dbo.v_insentif_bpjs INNER JOIN
                      dbo.jumlah_dr_bpjs_v ON dbo.v_insentif_bpjs.no_registrasi = dbo.jumlah_dr_bpjs_v.no_registrasi INNER JOIN
                      dbo.dokter_bpjs_v ON dbo.v_insentif_bpjs.no_registrasi = dbo.dokter_bpjs_v.no_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.v_insentif_bpjs.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.perbandingan_jasa_dr_bpjs_v ON dbo.v_insentif_bpjs.no_registrasi = dbo.perbandingan_jasa_dr_bpjs_v.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_insentif_bpjs_dokter]");
    }
};
