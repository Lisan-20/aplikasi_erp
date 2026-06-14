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
        DB::statement("CREATE OR ALTER VIEW dbo.v_selisih_billing_nk
AS
SELECT     dbo.v_cek_billing_nk.kode_tc_trans_kasir, dbo.v_cek_billing_nk.no_registrasi, dbo.v_cek_kuitansi_nk.kode_tc_trans_kasir AS Expr1, 
                      dbo.v_cek_kuitansi_nk.no_registrasi AS Expr2, dbo.v_cek_kuitansi_nk.nk_perusahaan, dbo.v_cek_billing_nk.billing, dbo.v_cek_kuitansi_nk.seri_kuitansi, 
                      dbo.v_cek_kuitansi_nk.no_kuitansi, dbo.v_cek_billing_nk.billing - dbo.v_cek_kuitansi_nk.nk_perusahaan AS selisih, dbo.v_cek_kuitansi_nk.jml_tunai
FROM         dbo.v_cek_billing_nk INNER JOIN
                      dbo.v_cek_kuitansi_nk ON dbo.v_cek_billing_nk.kode_tc_trans_kasir = dbo.v_cek_kuitansi_nk.kode_tc_trans_kasir AND 
                      dbo.v_cek_billing_nk.no_registrasi = dbo.v_cek_kuitansi_nk.no_registrasi AND dbo.v_cek_billing_nk.billing <> dbo.v_cek_kuitansi_nk.nk_perusahaan AND 
                      dbo.v_cek_billing_nk.billing - dbo.v_cek_kuitansi_nk.nk_perusahaan <> dbo.v_cek_kuitansi_nk.jml_tunai
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_selisih_billing_nk]");
    }
};
