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
        DB::statement("CREATE VIEW dbo.laporan_ranap2_bpjs_ketenagakerjaan_v
AS
SELECT     dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, 
                      dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.kode_bagian, 
                      dbo.tc_trans_kasir.status_batal, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bln, YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, DAY(dbo.tc_trans_kasir.tgl_jam) AS tgl, 
                      dbo.tc_registrasi.kode_dokter, dbo.tc_registrasi.noSep, dbo.tc_registrasi.noKartuPeserta, dbo.GROUPER_INACBG_REST.Inacbg, 
                      SUM(CAST(dbo.GROUPER_INACBG_REST.TotalTarif AS decimal)) AS Tarif, dbo.GROUPER_INACBG_REST.NoSep AS NoSep_coding
FROM         dbo.GROUPER_INACBG_REST RIGHT OUTER JOIN
                      dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi ON dbo.GROUPER_INACBG_REST.NoSep = dbo.tc_registrasi.noSep
GROUP BY dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, 
                      dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.kode_bagian, 
                      dbo.tc_trans_kasir.status_batal, MONTH(dbo.tc_trans_kasir.tgl_jam), DAY(dbo.tc_trans_kasir.tgl_jam), YEAR(dbo.tc_trans_kasir.tgl_jam), 
                      dbo.tc_registrasi.kode_dokter, dbo.tc_registrasi.noSep, dbo.tc_registrasi.noKartuPeserta, dbo.GROUPER_INACBG_REST.Inacbg, 
                      dbo.GROUPER_INACBG_REST.NoSep
HAVING      (dbo.tc_registrasi.kode_kelompok = 8) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_kasir.nk_perusahaan > 0) AND 
                      (dbo.tc_trans_kasir.seri_kuitansi IN ('AI', 'NK'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laporan_ranap2_bpjs_ketenagakerjaan_v]");
    }
};
