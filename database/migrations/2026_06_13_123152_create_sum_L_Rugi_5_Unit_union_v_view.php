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
        DB::statement("CREATE VIEW dbo.sum_L_Rugi_5_Unit_union_v
AS
SELECT     TOP (100) PERCENT dbo.L_Rugi_5_Unit_union_v.bulan, dbo.L_Rugi_5_Unit_union_v.tahun, SUM(dbo.L_Rugi_5_Unit_union_v.debet) AS nominal, dbo.L_Rugi_5_Unit_union_v.kode_bagian, 
                      dbo.L_Rugi_5_Unit_union_v.nama_bagian, dbo.L_Rugi_5_Unit_union_v.referensi, dbo.L_Rugi_5_Unit_union_v.tx_tipe, dbo.mt_account.acc_nama
FROM         dbo.L_Rugi_5_Unit_union_v INNER JOIN
                      dbo.mt_account ON dbo.L_Rugi_5_Unit_union_v.referensi = dbo.mt_account.acc_no
GROUP BY dbo.L_Rugi_5_Unit_union_v.bulan, dbo.L_Rugi_5_Unit_union_v.tahun, dbo.L_Rugi_5_Unit_union_v.kode_bagian, dbo.L_Rugi_5_Unit_union_v.nama_bagian, 
                      dbo.L_Rugi_5_Unit_union_v.referensi, dbo.L_Rugi_5_Unit_union_v.tx_tipe, dbo.mt_account.acc_nama
ORDER BY dbo.L_Rugi_5_Unit_union_v.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_L_Rugi_5_Unit_union_v]");
    }
};
