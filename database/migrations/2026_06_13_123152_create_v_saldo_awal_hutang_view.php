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
        DB::statement("CREATE VIEW dbo.v_saldo_awal_hutang
AS
SELECT     kodesupplier, YEAR(tgl_saldo_awal) AS tahun, saldo_awal
FROM         dbo.saldo_awal_hutang
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_saldo_awal_hutang]");
    }
};
