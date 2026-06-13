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
        DB::statement("CREATE OR ALTER VIEW dbo.filter_jurnal_RI_bpjs
AS
SELECT     dbo.filter_jurnal_RI_D_BPJS.no_registrasi, dbo.filter_jurnal_RI_D_BPJS.D, dbo.filter_jurnal_RI_K_bpjs.K
FROM         dbo.filter_jurnal_RI_D_BPJS INNER JOIN
                      dbo.filter_jurnal_RI_K_bpjs ON dbo.filter_jurnal_RI_D_BPJS.D = dbo.filter_jurnal_RI_K_bpjs.K AND 
                      dbo.filter_jurnal_RI_D_BPJS.no_registrasi = dbo.filter_jurnal_RI_K_bpjs.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [filter_jurnal_RI_bpjs]");
    }
};
