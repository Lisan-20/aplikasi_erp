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
        DB::statement("CREATE VIEW dbo.v_group_bagian
AS
SELECT     kode_bagian AS kd_bag_unit, nama_bagian, acc_ref, acc_ref_biaya
FROM         dbo.mt_bagian
WHERE     (kode_bagian IN ('010001', '030001', '050001', '060001'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_group_bagian]");
    }
};
