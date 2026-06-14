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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rm_msh_dirawat_v
AS
SELECT        tgl_pulang, tgl_masuk, no_registrasi, COUNT(no_registrasi) AS tot_pasien
FROM            dbo.pasien_masih_dirawat_v
GROUP BY tgl_pulang, tgl_masuk, no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rm_msh_dirawat_v]");
    }
};
