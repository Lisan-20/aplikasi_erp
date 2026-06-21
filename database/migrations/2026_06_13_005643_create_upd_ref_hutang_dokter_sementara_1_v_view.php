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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_ref_hutang_dokter_sementara_1_v
AS
SELECT     dbo.bd_tc_hutang_dr.no_bukti, dbo.fee_dokter_rj_umum_temp.kode_tc_trans_kasir, dbo.fee_dokter_rj_umum_temp.seri_kuitansi, 
                      dbo.fee_dokter_rj_umum_temp.no_kuitansi, dbo.bd_tc_hutang_dr.no_sppu, dbo.tx_harian.no_bukti AS Expr1, dbo.tx_harian.referensi, dbo.tx_harian.kel_jurnal, 
                      dbo.tx_harian.acc_no
FROM         dbo.bd_tc_hutang_dr INNER JOIN
                      dbo.fee_dokter_rj_umum_temp ON dbo.bd_tc_hutang_dr.no_sppu = dbo.fee_dokter_rj_umum_temp.no_sppu AND 
                      dbo.bd_tc_hutang_dr.kode_dokter = dbo.fee_dokter_rj_umum_temp.kode_dr INNER JOIN
                      dbo.tx_harian ON dbo.fee_dokter_rj_umum_temp.kode_dr = dbo.tx_harian.kode_dr AND 
                      dbo.fee_dokter_rj_umum_temp.no_registrasi = dbo.tx_harian.no_registrasi
WHERE     (dbo.tx_harian.kel_jurnal IN ('1', '2'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_ref_hutang_dokter_sementara_1_v]");
    }
};
