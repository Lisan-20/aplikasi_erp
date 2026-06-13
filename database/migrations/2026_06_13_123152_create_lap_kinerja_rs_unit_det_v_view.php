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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kinerja_rs_unit_det_v
AS
SELECT     kode_bagian, DAY(tgl_jam) AS tgl, MONTH(tgl_jam) AS bln, YEAR(tgl_jam) AS thn, SUM(bill_rs + bill_dr1 + bill_dr2 + bill_dr3 + lain_lain) AS jumlah, kode_kelompok, COUNT(no_registrasi) 
                      AS jml_pasien
FROM         dbo.lap_kinerja_rs_unit_v
GROUP BY DAY(tgl_jam), MONTH(tgl_jam), YEAR(tgl_jam), kode_kelompok, kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kinerja_rs_unit_det_v]");
    }
};
