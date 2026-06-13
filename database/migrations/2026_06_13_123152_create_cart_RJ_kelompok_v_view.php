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
        DB::statement("CREATE OR ALTER VIEW dbo.cart_RJ_kelompok_v
AS
SELECT     COUNT(no_registrasi) AS jml, kode_kelompok, YEAR(tgl_jam_masuk) AS thn, MONTH(tgl_jam_masuk) AS bln, DAY(tgl_jam_masuk) AS tgl
FROM         dbo.tc_registrasi
GROUP BY DAY(tgl_jam_masuk), MONTH(tgl_jam_masuk), YEAR(tgl_jam_masuk), status_batal, kode_kelompok
HAVING      (status_batal IS NULL) AND (YEAR(tgl_jam_masuk) >= 2015)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cart_RJ_kelompok_v]");
    }
};
