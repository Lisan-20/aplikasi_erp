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
        DB::statement("CREATE OR ALTER VIEW dbo.v_saldo_awal_hutang_sup
AS
SELECT     dbo.saldo_awal_hutang.tgl_saldo_awal, dbo.saldo_awal_hutang.kodesupplier, dbo.mt_supplier.namasupplier, dbo.saldo_awal_hutang.saldo_awal, 
                      dbo.saldo_awal_hutang.kd_saldo_awal_hutang
FROM         dbo.saldo_awal_hutang INNER JOIN
                      dbo.mt_supplier ON dbo.saldo_awal_hutang.kodesupplier = dbo.mt_supplier.kodesupplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_saldo_awal_hutang_sup]");
    }
};
