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
        DB::statement("CREATE OR ALTER VIEW dbo.lama_kontraksi_partograf_v
AS
SELECT     TOP (100) PERCENT kode_pemeriksaan, nama_pemeriksaan, hasil, no_urut_ews, no_registrasi, ket, CASE WHEN CAST(hasil AS int) < 20 THEN 'dotted' WHEN CAST(hasil AS int) >= 20 AND 
                      CAST(hasil AS int) < 40 THEN 'diagonal' WHEN CAST(hasil AS int) >= 40 THEN 'block' ELSE ' ' END AS style, ROW_NUMBER() OVER (partition by no_registrasi ORDER BY no_urut_ews) AS RowNumber
FROM         dbo.tc_pemeriksaan_ews_det
WHERE     (kode_pemeriksaan = N'47302') 
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lama_kontraksi_partograf_v]");
    }
};
