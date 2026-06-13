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
        DB::statement("CREATE VIEW dbo.serah_terima_pasien_v
AS
SELECT     no_kunjungan AS no_kunjungan_asal, no_registrasi, MAX(kode_tc_periksa) AS Expr1, hasil
FROM         dbo.tc_pemeriksaan_erm
WHERE     (kode_pemeriksaan = 33405)
GROUP BY no_kunjungan, no_registrasi, hasil
HAVING      (hasil = ' ')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [serah_terima_pasien_v]");
    }
};
