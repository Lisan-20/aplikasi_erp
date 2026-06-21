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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_jurnal_rj
AS
SELECT     dbo.cek_jurnal_rj_k.thn, dbo.cek_jurnal_rj_d.thn AS Expr1, dbo.cek_jurnal_rj_d.bln, dbo.cek_jurnal_rj_k.bln AS Expr2, dbo.cek_jurnal_rj_k.kel_jurnal, dbo.cek_jurnal_rj_k.K, dbo.cek_jurnal_rj_d.D, 
                      dbo.cek_jurnal_rj_k.no_registrasi
FROM         dbo.cek_jurnal_rj_d INNER JOIN
                      dbo.cek_jurnal_rj_k ON dbo.cek_jurnal_rj_d.no_registrasi = dbo.cek_jurnal_rj_k.no_registrasi AND dbo.cek_jurnal_rj_d.thn = dbo.cek_jurnal_rj_k.thn AND 
                      dbo.cek_jurnal_rj_d.kel_jurnal = dbo.cek_jurnal_rj_k.kel_jurnal AND dbo.cek_jurnal_rj_d.bln = dbo.cek_jurnal_rj_k.bln AND dbo.cek_jurnal_rj_d.D <> dbo.cek_jurnal_rj_k.K
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_jurnal_rj]");
    }
};
