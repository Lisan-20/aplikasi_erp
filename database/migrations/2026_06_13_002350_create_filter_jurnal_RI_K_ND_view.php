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
        DB::statement("CREATE OR ALTER VIEW dbo.filter_jurnal_RI_K_ND
AS
SELECT     dbo.filter_jurnal_RI_K.K + (CASE WHEN dbo.filter_nd_v. D IS NULL THEN 0 ELSE dbo.filter_nd_v. D END) AS K, dbo.filter_jurnal_RI_K.no_registrasi
FROM         dbo.filter_jurnal_RI_K LEFT OUTER JOIN
                      dbo.filter_nd_v ON dbo.filter_jurnal_RI_K.no_registrasi = dbo.filter_nd_v.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [filter_jurnal_RI_K_ND]");
    }
};
