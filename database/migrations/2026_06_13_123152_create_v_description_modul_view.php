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
        DB::statement("CREATE VIEW dbo.v_description_modul
AS
SELECT     TOP (100) PERCENT dbo.dc_modul.nama_modul, dbo.dc_menu.nama_menu, dbo.dc_sub_menu.nama_sub_menu, dbo.dc_sub_menu.summary
FROM         dbo.dc_modul INNER JOIN
                      dbo.dc_menu ON dbo.dc_modul.id_dc_modul = dbo.dc_menu.id_dc_modul INNER JOIN
                      dbo.dc_sub_menu ON dbo.dc_menu.id_dc_menu = dbo.dc_sub_menu.id_dc_menu
ORDER BY dbo.dc_modul.nama_modul, dbo.dc_menu.nama_menu
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_description_modul]");
    }
};
