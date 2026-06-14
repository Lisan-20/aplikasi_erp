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
        DB::statement("CREATE OR ALTER VIEW dbo.sie_kinerja_rs_unit_ctk_v
AS
SELECT     dbo.sie_kinerja_rs_unit.thn, dbo.dd_bulan.nama_bulan, dbo.sie_kinerja_rs_unit.jml_umum, dbo.sie_kinerja_rs_unit.jml_bpjs, dbo.sie_kinerja_rs_unit.jml_perusahaan, 
                      dbo.sie_kinerja_rs_unit.tot_umum, dbo.sie_kinerja_rs_unit.tot_bpjs, dbo.sie_kinerja_rs_unit.tot_perusahaan, dbo.sie_kinerja_rs_unit.jml_umum_LL, dbo.sie_kinerja_rs_unit.jml_bpjs_LL, 
                      dbo.sie_kinerja_rs_unit.jml_perusahaan_LL, dbo.sie_kinerja_rs_unit.tot_umum_LL, dbo.sie_kinerja_rs_unit.tot_bpjs_LL, dbo.sie_kinerja_rs_unit.tot_perusahaan_LL, dbo.sie_kinerja_rs_unit.id_lap, 
                      dbo.sie_kinerja_rs_unit.bln
FROM         dbo.dd_bulan INNER JOIN
                      dbo.sie_kinerja_rs_unit ON dbo.dd_bulan.id_bulan = dbo.sie_kinerja_rs_unit.bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sie_kinerja_rs_unit_ctk_v]");
    }
};
