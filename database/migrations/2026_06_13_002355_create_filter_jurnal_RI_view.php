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
        DB::statement("CREATE OR ALTER VIEW dbo.filter_jurnal_RI
AS
SELECT     dbo.filter_jurnal_RI_D.no_registrasi, dbo.filter_jurnal_RI_D.D, dbo.filter_jurnal_RI_K_diskon.K
FROM         dbo.filter_jurnal_RI_D INNER JOIN
                      dbo.filter_jurnal_RI_K_diskon ON dbo.filter_jurnal_RI_D.D = dbo.filter_jurnal_RI_K_diskon.K AND 
                      dbo.filter_jurnal_RI_D.no_registrasi = dbo.filter_jurnal_RI_K_diskon.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [filter_jurnal_RI]");
    }
};
