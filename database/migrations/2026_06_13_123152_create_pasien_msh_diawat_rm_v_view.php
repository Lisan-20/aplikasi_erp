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
        DB::statement("CREATE VIEW dbo.pasien_msh_diawat_rm_v
AS
SELECT     COUNT(no_registrasi) AS jumlah, DAY(tgl_masuk) AS hari, MONTH(tgl_masuk) AS bulan, YEAR(tgl_masuk) AS tahun
FROM         dbo.pasien_masih_dirawat_v
GROUP BY DAY(tgl_masuk), MONTH(tgl_masuk), YEAR(tgl_masuk)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_msh_diawat_rm_v]");
    }
};
