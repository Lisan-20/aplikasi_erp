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
        DB::statement("CREATE OR ALTER VIEW dbo.sie_kinerja_rs_unit2_persh_v
AS
SELECT     dbo.sie_kinerja_rs_unit.jml_perusahaan, dbo.sie_kinerja_rs_unit2_v.jumlah, dbo.sie_kinerja_rs_unit2_v.id_grup, dbo.sie_kinerja_rs_unit2_v.jml_pasien, dbo.sie_kinerja_rs_unit.tot_perusahaan, 
                      dbo.sie_kinerja_rs_unit.thn
FROM         dbo.sie_kinerja_rs_unit INNER JOIN
                      dbo.sie_kinerja_rs_unit2_v ON dbo.sie_kinerja_rs_unit.thn = dbo.sie_kinerja_rs_unit2_v.thn AND dbo.sie_kinerja_rs_unit.bln = dbo.sie_kinerja_rs_unit2_v.bln
WHERE     (dbo.sie_kinerja_rs_unit2_v.id_grup = 5)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sie_kinerja_rs_unit2_persh_v]");
    }
};
