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
        DB::statement("CREATE VIEW dbo.cek_regis_dobel_v
AS
SELECT     TOP (100) PERCENT no_mr, tgl_jam_masuk, kode_bagian_masuk, COUNT(no_mr) AS jml_mr, tgl_jam_keluar
FROM         dbo.tc_registrasi
GROUP BY no_mr, tgl_jam_masuk, kode_bagian_masuk, tgl_jam_keluar
HAVING      (COUNT(no_mr) > 1)
ORDER BY tgl_jam_masuk DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_regis_dobel_v]");
    }
};
