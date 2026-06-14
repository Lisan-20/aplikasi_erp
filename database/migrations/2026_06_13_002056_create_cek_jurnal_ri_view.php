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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_jurnal_ri
AS
SELECT     TOP (100) PERCENT dbo.cek_jurnal_ri_d.kel_jurnal, dbo.cek_jurnal_ri_d.thn, dbo.cek_jurnal_ri_d.bln, dbo.cek_jurnal_ri_k.kel_jurnal AS Expr1, dbo.cek_jurnal_ri_k.thn AS Expr2, 
                      dbo.cek_jurnal_ri_k.bln AS Expr3, dbo.cek_jurnal_ri_k.no_registrasi, dbo.cek_jurnal_ri_d.no_registrasi AS Expr4
FROM         dbo.cek_jurnal_ri_d INNER JOIN
                      dbo.cek_jurnal_ri_k ON dbo.cek_jurnal_ri_d.D <> dbo.cek_jurnal_ri_k.K AND dbo.cek_jurnal_ri_d.kel_jurnal = dbo.cek_jurnal_ri_k.kel_jurnal AND 
                      dbo.cek_jurnal_ri_d.thn = dbo.cek_jurnal_ri_k.thn AND dbo.cek_jurnal_ri_d.bln = dbo.cek_jurnal_ri_k.bln AND dbo.cek_jurnal_ri_d.no_registrasi = dbo.cek_jurnal_ri_k.no_registrasi
ORDER BY dbo.cek_jurnal_ri_d.kel_jurnal, Expr3
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_jurnal_ri]");
    }
};
