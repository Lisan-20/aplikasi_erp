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
        DB::statement("CREATE VIEW dbo.sep_belum_ad_di_temp_v
AS
SELECT     dbo.laporan_ranap2_bpjs_v.kode_kelompok, dbo.laporan_ranap2_bpjs_v.seri_kuitansi, dbo.laporan_ranap2_bpjs_v.no_kuitansi, dbo.laporan_ranap2_bpjs_v.tgl_jam, 
                      dbo.laporan_ranap2_bpjs_v.no_mr, dbo.laporan_ranap2_bpjs_v.no_registrasi, dbo.laporan_ranap2_bpjs_v.bill, dbo.laporan_ranap2_bpjs_v.nk_perusahaan, 
                      dbo.laporan_ranap2_bpjs_v.nama_pasien, dbo.laporan_ranap2_bpjs_v.kode_bagian, dbo.laporan_ranap2_bpjs_v.status_batal, dbo.laporan_ranap2_bpjs_v.bln, dbo.laporan_ranap2_bpjs_v.thn, 
                      dbo.laporan_ranap2_bpjs_v.tgl, dbo.laporan_ranap2_bpjs_v.kode_dokter, UPPER(dbo.laporan_ranap2_bpjs_v.noSep) AS no_sep, dbo.laporan_ranap2_bpjs_v.noKartuPeserta, 
                      dbo.laporan_ranap2_bpjs_v.total_tarif, dbo.laporan_ranap2_bpjs_v.tarif_rs, dbo.laporan_ranap2_bpjs_v.kode_cbg, dbo.laporan_ranap2_bpjs_v.no_sjp, dbo.laporan_ranap2_bpjs_v.description, 
                      dbo.laporan_ranap2_bpjs_v.NoSep_coding, dbo.laporan_ranap2_bpjs_v.code, dbo.KelasBPJS(dbo.ri_cari_pasien_jkn_history_v.kelas_pas) AS KL_BPJS, dbo.tariff_cbg.regional, 
                      dbo.tariff_cbg.[ tariff] AS tarif_bpjs, dbo.tariff_cbg.[ jenis_pelayanan], dbo.tariff_cbg.kode_tariff, dbo.ri_cari_pasien_jkn_history_v.tgl_masuk, CONVERT(char(10), 
                      dbo.ri_cari_pasien_jkn_history_v.tgl_masuk, 126) AS masuk, CONVERT(char(10), dbo.laporan_ranap2_bpjs_v.tgl_jam, 126) AS pulang, dbo.laporan_ranap2_bpjs_v.kdDiag
FROM         dbo.laporan_ranap2_bpjs_v INNER JOIN
                      dbo.ri_cari_pasien_jkn_history_v ON dbo.laporan_ranap2_bpjs_v.no_registrasi = dbo.ri_cari_pasien_jkn_history_v.no_registrasi INNER JOIN
                      dbo.tariff_cbg ON dbo.laporan_ranap2_bpjs_v.code = dbo.tariff_cbg.inacbg AND dbo.KelasBPJS(dbo.ri_cari_pasien_jkn_history_v.kelas_pas) = dbo.tariff_cbg.kelas_rawat
WHERE     (dbo.laporan_ranap2_bpjs_v.tgl_jam BETWEEN '2017-4-1 00:00:00' AND '2017-6-6 23:59:59') AND (dbo.tariff_cbg.regional = N'reg1') AND (dbo.tariff_cbg.kode_tariff = N'CS') AND 
                      (dbo.tariff_cbg.[ jenis_pelayanan] = 1) AND (dbo.laporan_ranap2_bpjs_v.kdDiag <> '') AND (dbo.laporan_ranap2_bpjs_v.tarif_rs IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sep_belum_ad_di_temp_v]");
    }
};
