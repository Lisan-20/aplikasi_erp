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
        DB::statement("CREATE VIEW dbo.upd_sesp_v
AS
SELECT     dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.no_mr, 
                      dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.status_batal, 
                      MONTH(dbo.tc_trans_kasir.tgl_jam) AS bln, YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, dbo.tc_registrasi.kode_dokter, dbo.tc_registrasi.noKartuPeserta, 
                      dbo.billing_manual_inacbgs_v.TariffRS, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_registrasi.noSep, dbo.billing_manual_inacbgs_v.NoSep AS noSep_up, 
                      dbo.tc_trans_kasir.no_registrasi
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi INNER JOIN
                      dbo.billing_manual_inacbgs_v ON dbo.tc_trans_kasir.no_mr = dbo.billing_manual_inacbgs_v.no_mr AND 
                      dbo.tc_trans_kasir.nk_perusahaan = dbo.billing_manual_inacbgs_v.TariffRS
WHERE     (dbo.tc_registrasi.kode_kelompok IN ('8', '9', '11')) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_kasir.nk_perusahaan > 0) AND 
                      (dbo.tc_trans_kasir.seri_kuitansi IN ('AI', 'NK')) AND (dbo.tc_registrasi.noSep IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_sesp_v]");
    }
};
