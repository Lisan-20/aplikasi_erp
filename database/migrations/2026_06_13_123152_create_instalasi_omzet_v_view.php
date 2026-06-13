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
        DB::statement("CREATE VIEW dbo.instalasi_omzet_v
AS
SELECT DISTINCT kode_tc_trans_kasir, kode_bagian, status_batal
FROM         dbo.tc_trans_pelayanan
WHERE     (status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [instalasi_omzet_v]");
    }
};
