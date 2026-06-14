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
        DB::statement("CREATE OR ALTER VIEW dbo.sie_kinerja_rs_unit4_v
AS
SELECT     MONTH(dbo.sie_kinerja_rs_unit_v.tgl_jam) AS bln, YEAR(dbo.sie_kinerja_rs_unit_v.tgl_jam) AS thn, 
                      SUM(dbo.sie_kinerja_rs_unit_v.bill_rs + dbo.sie_kinerja_rs_unit_v.bill_dr1 + dbo.sie_kinerja_rs_unit_v.bill_dr2 + dbo.sie_kinerja_rs_unit_v.bill_dr3 + dbo.sie_kinerja_rs_unit_v.lain_lain) 
                      AS jumlah, dbo.sie_kinerja_rs_unit_v.id_grup, COUNT(dbo.sie_kinerja_rs_unit_v.no_registrasi) AS jml_pasien, dbo.sie_kinerja_rs_unit_v.kode_bagian, dbo.mt_bagian.nama_bagian
FROM         dbo.sie_kinerja_rs_unit_v INNER JOIN
                      dbo.mt_bagian ON dbo.sie_kinerja_rs_unit_v.kode_bagian = dbo.mt_bagian.kode_bagian
GROUP BY MONTH(dbo.sie_kinerja_rs_unit_v.tgl_jam), YEAR(dbo.sie_kinerja_rs_unit_v.tgl_jam), dbo.sie_kinerja_rs_unit_v.id_grup, dbo.sie_kinerja_rs_unit_v.kode_bagian, dbo.mt_bagian.nama_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sie_kinerja_rs_unit4_v]");
    }
};
