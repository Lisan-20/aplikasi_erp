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
        DB::statement("CREATE VIEW dbo.jumlah_pasien_v
AS
SELECT     COUNT(kode_ri) AS jumlah_pasien, MONTH(tgl_masuk) AS bulan, YEAR(tgl_masuk) AS tahun, 1 AS nilai, status_batal
FROM         dbo.ri_tc_rawatinap
GROUP BY MONTH(tgl_masuk), YEAR(tgl_masuk), status_batal
HAVING      (status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jumlah_pasien_v]");
    }
};
