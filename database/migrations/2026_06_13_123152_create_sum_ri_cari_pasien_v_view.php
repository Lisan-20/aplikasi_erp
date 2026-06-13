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
        DB::statement("CREATE OR ALTER VIEW dbo.sum_ri_cari_pasien_v
AS
SELECT     COUNT(no_registrasi) AS jml_pasien, bag_pas, tgl_keluar, tgl_pulang
FROM         dbo.ri_cari_pasien_v
GROUP BY bag_pas, tgl_keluar, tgl_pulang
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_ri_cari_pasien_v]");
    }
};
