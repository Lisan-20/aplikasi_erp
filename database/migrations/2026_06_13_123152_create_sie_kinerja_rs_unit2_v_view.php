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
        DB::statement("CREATE VIEW dbo.sie_kinerja_rs_unit2_v
AS
SELECT     MONTH(tgl_jam) AS bln, YEAR(tgl_jam) AS thn, SUM(bill_rs + bill_dr1 + bill_dr2 + bill_dr3 + lain_lain) AS jumlah, id_grup, COUNT(no_registrasi) AS jml_pasien
FROM         dbo.sie_kinerja_rs_unit_v
GROUP BY MONTH(tgl_jam), YEAR(tgl_jam), id_grup
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sie_kinerja_rs_unit2_v]");
    }
};
