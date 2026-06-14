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
        DB::statement("CREATE OR ALTER VIEW dbo.dc_kelurahan_view
AS
SELECT     dbo.dc_kecamatan.nama_kecamatan, dbo.dc_kelurahan.id_dc_kelurahan, dbo.dc_kelurahan.nama_kelurahan, dbo.dc_kelurahan.inisial_kelurahan, 
                      dbo.dc_kelurahan.kode_pos
FROM         dbo.dc_kecamatan INNER JOIN
                      dbo.dc_kelurahan ON dbo.dc_kecamatan.id_dc_kecamatan = dbo.dc_kelurahan.id_dc_kecamatan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dc_kelurahan_view]");
    }
};
