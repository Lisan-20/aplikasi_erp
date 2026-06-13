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
        DB::statement("CREATE VIEW dbo.lap_kinerja_rs_unit_det3_v
AS
SELECT     kode_bagian, kode_perusahaan, YEAR(tgl_jam) AS thn, SUM(bill_rs + bill_dr1 + bill_dr2 + bill_dr3 + lain_lain) AS jumlah, COUNT(no_registrasi) AS jml_pasien
FROM         dbo.lap_kinerja_rs_unit2_v
GROUP BY YEAR(tgl_jam), kode_bagian, kode_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kinerja_rs_unit_det3_v]");
    }
};
