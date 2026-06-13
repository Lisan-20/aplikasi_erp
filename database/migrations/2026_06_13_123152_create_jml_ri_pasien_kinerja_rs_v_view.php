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
        DB::statement("CREATE VIEW dbo.jml_ri_pasien_kinerja_rs_v
AS
SELECT     COUNT(no_registrasi) AS jml, YEAR(tgl_jam_masuk) AS thn, MONTH(tgl_jam_masuk) AS bln, kode_bagian_masuk
FROM         dbo.tc_registrasi
GROUP BY YEAR(tgl_jam_masuk), MONTH(tgl_jam_masuk), status_batal, kode_bagian_masuk
HAVING      (status_batal IS NULL) AND (kode_bagian_masuk LIKE '03%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jml_ri_pasien_kinerja_rs_v]");
    }
};
