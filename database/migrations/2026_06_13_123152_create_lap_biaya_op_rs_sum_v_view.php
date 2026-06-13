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
        DB::statement("CREATE VIEW dbo.lap_biaya_op_rs_sum_v
AS
SELECT     dbo.lap_biaya_op_rs_debet_v.kode_biaya, dbo.lap_biaya_op_rs_debet_v.nama_biaya, dbo.lap_biaya_op_rs_debet_v.kode_ref, 
                      dbo.lap_biaya_op_rs_debet_v.referensi, dbo.lap_biaya_op_rs_debet_v.acc_no, dbo.lap_biaya_op_rs_debet_v.acc_nama, dbo.lap_biaya_op_rs_debet_v.acc_type, 
                      dbo.lap_biaya_op_rs_debet_v.debet, dbo.lap_biaya_op_rs_debet_v.bulan, dbo.lap_biaya_op_rs_debet_v.tahun, dbo.lap_biaya_op_rs_debet_v.tx_tipe, 
                      dbo.lap_biaya_op_rs_kredit_v.kredit, dbo.lap_biaya_op_rs_debet_v.debet - (CASE WHEN kredit IS NULL THEN 0 ELSE kredit END) AS jumlah
FROM         dbo.lap_biaya_op_rs_debet_v LEFT OUTER JOIN
                      dbo.lap_biaya_op_rs_kredit_v ON dbo.lap_biaya_op_rs_debet_v.tahun = dbo.lap_biaya_op_rs_kredit_v.tahun AND 
                      dbo.lap_biaya_op_rs_debet_v.bulan = dbo.lap_biaya_op_rs_kredit_v.bulan AND 
                      dbo.lap_biaya_op_rs_debet_v.kode_biaya = dbo.lap_biaya_op_rs_kredit_v.kode_biaya AND 
                      dbo.lap_biaya_op_rs_debet_v.kode_ref = dbo.lap_biaya_op_rs_kredit_v.kode_ref AND dbo.lap_biaya_op_rs_debet_v.acc_no = dbo.lap_biaya_op_rs_kredit_v.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_biaya_op_rs_sum_v]");
    }
};
