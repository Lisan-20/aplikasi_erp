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
        DB::statement("CREATE VIEW dbo.bill_ri_showa_update_sp_v2
AS
SELECT     kode_perusahaan, no_registrasi, status_batal, bill_rs_jatah, bill_dr1_jatah, bill_dr2_jatah, lain_lain, status_kredit, diskon_rs_jatah, diskon_dr1_jatah, 
                      diskon_dr2_jatah, diskon_total AS diskon_total1, kode_bagian, CAST(0.05 * diskon_total AS decimal) AS diskon_total
FROM         dbo.bill_ri_showa_update_sp_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bill_ri_showa_update_sp_v2]");
    }
};
