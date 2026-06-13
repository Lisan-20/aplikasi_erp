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
        DB::statement("CREATE OR ALTER VIEW dbo.sie_kinerja_rs_unit3_umum_v
AS
SELECT     dbo.sie_kinerja_rs_unit.bln, dbo.sie_kinerja_rs_unit.jml_umum_LL, dbo.sie_kinerja_rs_unit.tot_umum_LL, dbo.sie_kinerja_rs_unit2_v.jumlah, dbo.sie_kinerja_rs_unit2_v.jml_pasien, 
                      dbo.sie_kinerja_rs_unit2_v.id_grup
FROM         dbo.sie_kinerja_rs_unit INNER JOIN
                      dbo.sie_kinerja_rs_unit2_v ON dbo.sie_kinerja_rs_unit.bln = dbo.sie_kinerja_rs_unit2_v.bln AND dbo.sie_kinerja_rs_unit.thn - 1 = dbo.sie_kinerja_rs_unit2_v.thn
WHERE     (dbo.sie_kinerja_rs_unit2_v.id_grup = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sie_kinerja_rs_unit3_umum_v]");
    }
};
