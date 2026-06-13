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
        DB::statement("CREATE VIEW dbo.stat_pasien_kinerja_rs_v
AS
SELECT     COUNT(no_registrasi) AS jml, stat_pasien, YEAR(tgl_jam_masuk) AS thn, MONTH(tgl_jam_masuk) AS bln
FROM         dbo.tc_registrasi
GROUP BY stat_pasien, YEAR(tgl_jam_masuk), MONTH(tgl_jam_masuk), status_batal
HAVING      (status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [stat_pasien_kinerja_rs_v]");
    }
};
