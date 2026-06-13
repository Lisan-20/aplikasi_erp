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
        DB::statement("
CREATE VIEW dbo.dc_tab_v
AS
SELECT     dbo.dc_modul.id_dc_modul, dbo.dc_modul.nama_modul, dbo.dc_modul.no_urut, dbo.dc_menu.id_dc_menu, dbo.dc_menu.nama_menu, 
                      dbo.dc_sub_menu.id_dc_sub_menu, dbo.dc_sub_menu.nama_sub_menu, dbo.dc_sub_menu.url_sub_menu, dbo.dc_tab.id_dc_tab, 
                      dbo.dc_tab.nama_tab, dbo.dc_tab.url_tab, dbo.dc_tab.url_tab_default, dbo.dc_tab.jumlah_file
FROM         dbo.dc_tab RIGHT OUTER JOIN
                      dbo.dc_sub_menu ON dbo.dc_tab.id_dc_sub_menu = dbo.dc_sub_menu.id_dc_sub_menu RIGHT OUTER JOIN
                      dbo.dc_menu ON dbo.dc_sub_menu.id_dc_menu = dbo.dc_menu.id_dc_menu RIGHT OUTER JOIN
                      dbo.dc_modul ON dbo.dc_menu.id_dc_modul = dbo.dc_modul.id_dc_modul

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dc_tab_v]");
    }
};
