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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_jur_all_v
AS
SELECT     TOP (100) PERCENT dbo.cek_jur_1_d_v.kel_jurnal, dbo.cek_jur_1_d_v.bln, SUM(dbo.cek_jur_1_d_v.sum_debet) AS Debet, SUM(dbo.cek_jur_1_k_v.sum_kredit) 
                      AS Kredit, dbo.cek_jur_1_k_v.no_registrasi, dbo.cek_jur_1_k_v.no_bukti, dbo.cek_jur_1_k_v.kode_tc_trans_kasir
FROM         dbo.cek_jur_1_d_v INNER JOIN
                      dbo.cek_jur_1_k_v ON dbo.cek_jur_1_d_v.sum_debet <> dbo.cek_jur_1_k_v.sum_kredit AND dbo.cek_jur_1_d_v.bln = dbo.cek_jur_1_k_v.bln AND 
                      dbo.cek_jur_1_d_v.no_bukti = dbo.cek_jur_1_k_v.no_bukti AND dbo.cek_jur_1_d_v.thn = dbo.cek_jur_1_k_v.thn AND 
                      dbo.cek_jur_1_d_v.kel_jurnal = dbo.cek_jur_1_k_v.kel_jurnal
GROUP BY dbo.cek_jur_1_d_v.kel_jurnal, dbo.cek_jur_1_d_v.bln, dbo.cek_jur_1_k_v.no_registrasi, dbo.cek_jur_1_k_v.no_bukti, dbo.cek_jur_1_k_v.kode_tc_trans_kasir
ORDER BY Debet
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_jur_all_v]");
    }
};
