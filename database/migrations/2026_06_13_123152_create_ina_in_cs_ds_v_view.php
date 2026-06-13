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
        DB::statement("CREATE VIEW dbo.ina_in_cs_ds_v
AS
SELECT     dbo.ina_in_cs_v.inacbg, dbo.ina_in_ds_v.inacbg AS Expr1, dbo.ina_in_cs_v.inp, dbo.ina_in_ds_v.inp AS inp_up, dbo.ina_in_cs_v.[ jenis_pelayanan], dbo.ina_in_ds_v.tariff_original, 
                      dbo.ina_in_cs_v.tariff_original AS Expr2
FROM         dbo.ina_in_cs_v INNER JOIN
                      dbo.ina_in_ds_v ON dbo.ina_in_cs_v.inacbg = dbo.ina_in_ds_v.inacbg AND dbo.ina_in_cs_v.[ jenis_pelayanan] = dbo.ina_in_ds_v.[ jenis_pelayanan]
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ina_in_cs_ds_v]");
    }
};
