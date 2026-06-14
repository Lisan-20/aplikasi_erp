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
        DB::statement("CREATE OR ALTER VIEW dbo.penagihan_jamkesda_list_v
AS
SELECT     SUM(CASE WHEN bill_rs IS NULL THEN 0 ELSE bill_rs END) + SUM(CASE WHEN bill_dr1 IS NULL THEN 0 ELSE bill_dr1 END) + SUM(CASE WHEN bill_dr2 IS NULL THEN 0 ELSE bill_dr2 END) 
                      + SUM(CASE WHEN lain_lain IS NULL THEN 0 ELSE lain_lain END) AS biaya, CASE WHEN dbo.bill_icu_jamkesda_v.bill IS NULL THEN 0 ELSE dbo.bill_icu_jamkesda_v.bill END AS bill, 
                      dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.GROUPER_INACBG_REST.Inacbg, 
                      dbo.GROUPER_INACBG_REST.TotalTarif, dbo.tc_trans_kasir.tgl_jam, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir.flag_tagih, 
                      dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.no_jaminan, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.nk_perusahaan, 
                      dbo.tc_trans_kasir.status_batal
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_kasir.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                      dbo.bill_icu_jamkesda_v ON dbo.tc_trans_pelayanan.no_registrasi = dbo.bill_icu_jamkesda_v.no_registrasi LEFT OUTER JOIN
                      dbo.GROUPER_INACBG_REST ON dbo.mt_master_pasien.no_mr = dbo.GROUPER_INACBG_REST.no_mr AND dbo.tc_registrasi.no_sjp = dbo.GROUPER_INACBG_REST.NoSep
GROUP BY CASE WHEN dbo.bill_icu_jamkesda_v.bill IS NULL THEN 0 ELSE dbo.bill_icu_jamkesda_v.bill END, dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_kasir.status_batal, 
                      dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.GROUPER_INACBG_REST.Inacbg, 
                      dbo.GROUPER_INACBG_REST.TotalTarif, dbo.tc_trans_kasir.tgl_jam, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir.flag_tagih, 
                      dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.no_jaminan, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.nk_perusahaan
HAVING      (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_registrasi.kode_kelompok = 10) AND (dbo.tc_trans_kasir.kd_inv_persh_tx IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penagihan_jamkesda_list_v]");
    }
};
