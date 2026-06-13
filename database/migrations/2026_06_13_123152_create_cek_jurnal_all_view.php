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
        DB::statement("CREATE VIEW dbo.cek_jurnal_all
AS
SELECT     TOP (100) PERCENT dbo.cek_jurnal_all_K.kel_jurnal, SUM(dbo.cek_jurnal_all_K.KREDIT) AS K, SUM(dbo.cek_jurnal_all_D.DEBET) AS D, dbo.cek_jurnal_all_K.bln, dbo.cek_jurnal_all_D.tahun
FROM         dbo.cek_jurnal_all_D INNER JOIN
                      dbo.cek_jurnal_all_K ON dbo.cek_jurnal_all_D.kel_jurnal = dbo.cek_jurnal_all_K.kel_jurnal AND dbo.cek_jurnal_all_D.bln = dbo.cek_jurnal_all_K.bln AND 
                      dbo.cek_jurnal_all_D.DEBET <> dbo.cek_jurnal_all_K.KREDIT AND dbo.cek_jurnal_all_D.tahun = dbo.cek_jurnal_all_K.tahun
GROUP BY dbo.cek_jurnal_all_K.kel_jurnal, dbo.cek_jurnal_all_K.bln, dbo.cek_jurnal_all_D.tahun
ORDER BY dbo.cek_jurnal_all_K.bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_jurnal_all]");
    }
};
