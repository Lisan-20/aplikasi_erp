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
        DB::statement("CREATE OR ALTER VIEW dbo.laporan_ranap2_bpjs_new_v
AS
SELECT     dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, 
                      dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.status_batal, MONTH(dbo.tc_trans_kasir.tgl_jam) 
                      AS bln, YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, DAY(dbo.tc_trans_kasir.tgl_jam) AS tgl, dbo.tc_registrasi.kode_dokter, dbo.tc_registrasi.noSep, dbo.tc_registrasi.noKartuPeserta, 
                      dbo.tc_registrasi.no_sjp, dbo.tc_registrasi.kdDiag, dbo.tc_registrasi.code, dbo.dc_asal_pasien.asal_pasien, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, 
                      dbo.tc_registrasi.diagAwal, dbo.tc_registrasi.plafon_bpjs, dbo.tc_registrasi.diagnosa, dbo.mt_diag_bpjs.description
FROM         dbo.dc_asal_pasien RIGHT OUTER JOIN
                      dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi ON dbo.dc_asal_pasien.id_dc_asal_pasien = dbo.tc_registrasi.id_dc_asal_pasien LEFT OUTER JOIN
                      dbo.mt_diag_bpjs ON dbo.tc_registrasi.code = dbo.mt_diag_bpjs.code
GROUP BY dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.no_registrasi, 
                      dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.status_batal, MONTH(dbo.tc_trans_kasir.tgl_jam), 
                      DAY(dbo.tc_trans_kasir.tgl_jam), YEAR(dbo.tc_trans_kasir.tgl_jam), dbo.tc_registrasi.kode_dokter, dbo.tc_registrasi.noSep, dbo.tc_registrasi.noKartuPeserta, dbo.tc_registrasi.no_sjp, 
                      dbo.tc_registrasi.kdDiag, dbo.tc_registrasi.code, dbo.dc_asal_pasien.asal_pasien, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.diagAwal, 
                      dbo.tc_registrasi.plafon_bpjs, dbo.tc_registrasi.diagnosa, dbo.mt_diag_bpjs.description
HAVING      (dbo.tc_registrasi.kode_kelompok IN (8, 9, 10, 11, 12)) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_kasir.nk_perusahaan > 0) AND (dbo.tc_trans_kasir.seri_kuitansi IN ('AI', 
                      'NK'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laporan_ranap2_bpjs_new_v]");
    }
};
