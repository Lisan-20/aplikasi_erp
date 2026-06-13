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
        DB::statement("CREATE VIEW dbo.v_saldo_awal_piutang
AS
SELECT     kode_perusahaan, YEAR(tgl_saldo_awal) AS tahun, saldo_awal
FROM         dbo.saldo_awal_piutang
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_saldo_awal_piutang]");
    }
};
