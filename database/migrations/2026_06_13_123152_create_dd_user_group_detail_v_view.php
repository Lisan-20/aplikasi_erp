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
CREATE VIEW dbo.dd_user_group_detail_v
AS
SELECT     TOP 100 PERCENT a.*, b.nawil_kerja AS nawil_kerja, dbo.dd_user_group.nama_group AS nama_group
FROM         dbo.dd_user a LEFT OUTER JOIN
                      dbo.dd_user_group ON a.id_dd_user_group = dbo.dd_user_group.id_dd_user_group LEFT OUTER JOIN
                      dbo.dc_wilayah_kerja b ON a.ko_wil = b.ko_wil
ORDER BY a.username

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dd_user_group_detail_v]");
    }
};
