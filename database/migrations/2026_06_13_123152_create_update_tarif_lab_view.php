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
        DB::statement("CREATE VIEW dbo.update_tarif_lab
AS
SELECT     nama_tarif, kode_klas, total, bill_rs, bill_dr1, bill_rs_bpjs, bill_dr1_bpjs, total_bpjs, kode_bagian
FROM         dbo.mt_tarif_v
WHERE     (kode_bagian = '050101') AND (kode_klas = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_tarif_lab]");
    }
};
