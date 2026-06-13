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
        DB::statement("CREATE VIEW dbo.laporan_rajal_bpjs_2_v
AS
SELECT     dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.nk_perusahaan, 
                      dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.status_batal, DAY(dbo.tc_trans_kasir.tgl_jam) AS tgl, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bln, 
                      YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, dbo.tc_registrasi.kode_dokter, dbo.tc_registrasi.noKartuPeserta, dbo.tc_registrasi.plafon_bpjs, dbo.tc_trans_kasir.no_induk, dbo.tc_trans_kasir.kode_shift, 
                      dbo.tc_trans_kasir.kode_loket, dbo.tc_registrasi.code, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_mr, dbo.tc_registrasi.noSep, dbo.tc_registrasi.tgl_jam_masuk, 
                      dbo.tc_registrasi.id_dc_asal_pasien, dbo.tc_registrasi.provPerujuk, dbo.tc_registrasi.noRujukan
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi
GROUP BY dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.nk_perusahaan, 
                      dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.status_batal, MONTH(dbo.tc_trans_kasir.tgl_jam), YEAR(dbo.tc_trans_kasir.tgl_jam), 
                      dbo.tc_registrasi.kode_dokter, dbo.tc_registrasi.noKartuPeserta, DAY(dbo.tc_trans_kasir.tgl_jam), dbo.tc_registrasi.plafon_bpjs, dbo.tc_trans_kasir.no_induk, dbo.tc_trans_kasir.kode_shift, 
                      dbo.tc_trans_kasir.kode_loket, dbo.tc_registrasi.code, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_mr, dbo.tc_registrasi.noSep, dbo.tc_registrasi.tgl_jam_masuk, 
                      dbo.tc_registrasi.id_dc_asal_pasien, dbo.tc_registrasi.provPerujuk, dbo.tc_registrasi.noRujukan
HAVING      (dbo.tc_registrasi.kode_kelompok IN ('8', '9', '11', '12')) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_kasir.nk_perusahaan > 0) AND (dbo.tc_trans_kasir.seri_kuitansi IN ('AJ', 
                      'NK'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laporan_rajal_bpjs_2_v]");
    }
};
