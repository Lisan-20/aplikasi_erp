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
        DB::statement("CREATE VIEW dbo.update_showa_diskon_ri_manual_v2
AS
SELECT     kode_perusahaan, no_registrasi, status_batal, bill_rs_jatah, bill_dr1_jatah, bill_dr2_jatah, lain_lain, status_kredit, diskon_rs_jatah, diskon_dr1_jatah, 
                      diskon_dr2_jatah, CAST(diskon_total * 5 / 100 AS decimal) AS diskon_total, kode_bagian
FROM         dbo.update_showa_diskon_ri_manual_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_showa_diskon_ri_manual_v2]");
    }
};
