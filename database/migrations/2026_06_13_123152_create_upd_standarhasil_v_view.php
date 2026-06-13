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
        DB::statement("CREATE VIEW dbo.upd_standarhasil_v
AS
SELECT     dbo.pm_mt_standarhasil.*, dbo.pm_mt_standarhasil_2.standar_hasil_wanita AS a, dbo.pm_mt_standarhasil_2.standar_hasil_pria AS b
FROM         dbo.pm_mt_standarhasil INNER JOIN
                      dbo.pm_mt_standarhasil_2 ON dbo.pm_mt_standarhasil.nama_pemeriksaan = dbo.pm_mt_standarhasil_2.nama_pemeriksaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_standarhasil_v]");
    }
};
