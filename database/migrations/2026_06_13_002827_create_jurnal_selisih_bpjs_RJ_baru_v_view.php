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
        DB::statement("CREATE OR ALTER VIEW dbo.jurnal_selisih_bpjs_RJ_baru_v
AS
SELECT     dbo.tc_registrasi.noSep, dbo.upload_sep_temp.no_sep, dbo.upload_sep_temp.total_tarif, dbo.upload_sep_temp.tarif_rs, dbo.upload_sep_temp.total_tarif - dbo.upload_sep_temp.tarif_rs AS selisih, 
                      dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.no_registrasi, dbo.upload_sep_temp.jenis, 
                      dbo.upload_sep_temp.flag_jurnal, 208 AS kode_perusahaan, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.kode_tc_trans_kasir
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.upload_sep_temp ON dbo.tc_registrasi.noSep = dbo.upload_sep_temp.no_sep INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi
GROUP BY dbo.tc_registrasi.noSep, dbo.upload_sep_temp.no_sep, dbo.upload_sep_temp.total_tarif, dbo.upload_sep_temp.tarif_rs, dbo.upload_sep_temp.total_tarif - dbo.upload_sep_temp.tarif_rs, 
                      dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.no_registrasi, dbo.upload_sep_temp.jenis, 
                      dbo.upload_sep_temp.flag_jurnal, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.kode_tc_trans_kasir
HAVING      (dbo.upload_sep_temp.jenis = 'RJ') AND (dbo.upload_sep_temp.flag_jurnal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_selisih_bpjs_RJ_baru_v]");
    }
};
