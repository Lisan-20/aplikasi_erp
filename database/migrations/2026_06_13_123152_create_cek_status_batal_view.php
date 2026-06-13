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
        DB::statement("CREATE VIEW dbo.cek_status_batal
AS
SELECT     kode_tc_trans_kasir, seri_kuitansi, no_kuitansi, status_batal
FROM         dbo.tc_trans_kasir
WHERE     (status_batal = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_status_batal]");
    }
};
