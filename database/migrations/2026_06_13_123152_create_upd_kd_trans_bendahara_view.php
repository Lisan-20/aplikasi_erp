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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_kd_trans_bendahara
AS
SELECT     dbo.bd_tc_hutang_dr.kode_dokter, dbo.bd_tc_hutang_dr.no_voucher, dbo.bd_tc_hutang_dr.tgl_pembentukan, dbo.bd_tc_hutang_dr.nominal, 
                      dbo.bd_tc_hutang_dr.id_input, dbo.bd_tc_hutang_dr.status_lunas, dbo.bd_tc_hutang_dr.periode_tgl_awal, dbo.bd_tc_hutang_dr.periode_tgl_akhir, 
                      dbo.bd_tc_hutang_dr.potongan_pajak, dbo.bd_tc_hutang_dr.no_sppu, dbo.bd_tc_hutang_dr.tahun, dbo.bd_tc_hutang_dr.flag_ass, dbo.bd_tc_hutang_dr.flag_pt, 
                      dbo.bd_tc_hutang_dr.flag_umum, dbo.bd_tc_hutang_dr.flag_jamkesmas, dbo.bd_tc_hutang_dr.flag_sktm, dbo.bd_tc_hutang_dr.flag_jampersal, 
                      dbo.bd_tc_hutang_dr.no_bukti, dbo.bd_tc_hutang_dr.potongan, dbo.bd_tc_hutang_dr.total_kuitansi, dbo.bd_tc_hutang_dr.tgl_ver, dbo.bd_tc_hutang_dr.status_ver, 
                      dbo.bd_tc_hutang_dr.rj_ri, dbo.bd_tc_hutang_dr.flag_bpjs, dbo.tx_harian.no_bukti AS Expr1, dbo.tx_harian.kd_trans_bendahara, dbo.tx_harian.acc_no, 
                      dbo.tx_harian.tx_tgl
FROM         dbo.bd_tc_hutang_dr INNER JOIN
                      dbo.tx_harian ON dbo.bd_tc_hutang_dr.no_bukti = dbo.tx_harian.no_bukti
WHERE     (dbo.bd_tc_hutang_dr.rj_ri = 'RI') AND (dbo.tx_harian.kd_trans_bendahara IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kd_trans_bendahara]");
    }
};
