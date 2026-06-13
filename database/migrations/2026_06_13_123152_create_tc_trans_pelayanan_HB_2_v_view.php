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
        DB::statement("CREATE VIEW dbo.tc_trans_pelayanan_HB_2_v
AS
SELECT     kode_trans_pelayanan, kode_tarif, no_registrasi, kode_penunjang
FROM         dbo.tc_trans_pelayanan
WHERE     (kode_tarif IN (501010212, 501010103))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_trans_pelayanan_HB_2_v]");
    }
};
