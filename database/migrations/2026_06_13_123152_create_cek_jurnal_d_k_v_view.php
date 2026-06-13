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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_jurnal_d_k_v
AS
SELECT     TOP (100) PERCENT dbo.cek_jurnal_d_v.debet, dbo.cek_jurnal_k_v.kredit, dbo.cek_jurnal_d_v.acc_no, dbo.cek_jurnal_d_v.no_bukti
FROM         dbo.cek_jurnal_d_v INNER JOIN
                      dbo.cek_jurnal_k_v ON dbo.cek_jurnal_d_v.bln = dbo.cek_jurnal_k_v.bln AND dbo.cek_jurnal_d_v.tgl = dbo.cek_jurnal_k_v.tgl AND dbo.cek_jurnal_d_v.no_bukti = dbo.cek_jurnal_k_v.no_bukti AND 
                      dbo.cek_jurnal_d_v.debet = dbo.cek_jurnal_k_v.kredit AND dbo.cek_jurnal_d_v.acc_no = dbo.cek_jurnal_k_v.acc_no AND dbo.cek_jurnal_d_v.kel_jurnal = dbo.cek_jurnal_k_v.kel_jurnal AND 
                      dbo.cek_jurnal_d_v.no_jurnal = dbo.cek_jurnal_k_v.no_jurnal
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_jurnal_d_k_v]");
    }
};
