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
        DB::statement("CREATE OR ALTER VIEW dbo.dc_kecamatan_view
AS
SELECT     dbo.dc_kota.nama_kota, dbo.dc_kecamatan.id_dc_kecamatan, dbo.dc_kecamatan.nama_kecamatan, dbo.dc_kecamatan.inisial_kecamatan
FROM         dbo.dc_kota INNER JOIN
                      dbo.dc_kecamatan ON dbo.dc_kota.id_dc_kota = dbo.dc_kecamatan.id_dc_kota
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dc_kecamatan_view]");
    }
};
