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
        DB::statement("CREATE VIEW dbo.saldo_awal_kb_gabung_v
AS
SELECT     acc_nama, id_bank, Kas_Bank, urutan, acc_no, tahun, bulan, ko_wil
FROM         dbo.v_saldo_awal_cashflow

union

SELECT     acc_nama, id_bank, Kas_Bank, urutan, acc_no, tahun, bulan, ko_wil
FROM         dbo.v_saldo_awal_cashflow
v_saldo_awal_kb
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [saldo_awal_kb_gabung_v]");
    }
};
