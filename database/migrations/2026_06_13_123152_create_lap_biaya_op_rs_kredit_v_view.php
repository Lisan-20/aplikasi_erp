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
        DB::statement("CREATE VIEW dbo.lap_biaya_op_rs_kredit_v
AS
SELECT     dbo.mt_biaya_op_rs_v.kode_biaya, dbo.mt_biaya_op_rs_v.nama_biaya, dbo.mt_biaya_op_rs_v.kode_ref, dbo.mt_biaya_op_rs_v.referensi, 
                      dbo.mt_biaya_op_rs_v.acc_no, dbo.mt_biaya_op_rs_v.acc_nama, dbo.mt_biaya_op_rs_v.acc_type, SUM(CASE WHEN tx_nominal IS NULL 
                      THEN 0 ELSE tx_nominal END) AS kredit, MONTH(dbo.tx_harian.tx_tgl) AS bulan, YEAR(dbo.tx_harian.tx_tgl) AS tahun, dbo.tx_harian.tx_tipe
FROM         dbo.mt_biaya_op_rs_v INNER JOIN
                      dbo.tx_harian ON dbo.mt_biaya_op_rs_v.acc_no = dbo.tx_harian.acc_no
GROUP BY dbo.mt_biaya_op_rs_v.kode_biaya, dbo.mt_biaya_op_rs_v.nama_biaya, dbo.mt_biaya_op_rs_v.kode_ref, dbo.mt_biaya_op_rs_v.referensi, 
                      dbo.mt_biaya_op_rs_v.acc_no, dbo.mt_biaya_op_rs_v.acc_nama, dbo.mt_biaya_op_rs_v.acc_type, MONTH(dbo.tx_harian.tx_tgl), YEAR(dbo.tx_harian.tx_tgl), 
                      dbo.tx_harian.tx_tipe
HAVING      (dbo.tx_harian.tx_tipe = 'K')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_biaya_op_rs_kredit_v]");
    }
};
