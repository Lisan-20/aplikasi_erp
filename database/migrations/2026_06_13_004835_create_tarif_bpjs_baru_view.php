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
        DB::statement("CREATE OR ALTER VIEW dbo.tarif_bpjs_baru
AS
SELECT     dbo.tarif_bpjs_1.kode_tarif, dbo.tarif_bpjs_1.bill_rs, dbo.tarif_bpjs_1.bill_dr1, dbo.tarif_bpjs_2.bill_rs AS rs, dbo.tarif_bpjs_2.bill_dr1 AS dr1, 
                      dbo.tarif_bpjs_2.kode_klas
FROM         dbo.tarif_bpjs_1 INNER JOIN
                      dbo.tarif_bpjs_2 ON dbo.tarif_bpjs_1.kode_tarif = dbo.tarif_bpjs_2.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tarif_bpjs_baru]");
    }
};
