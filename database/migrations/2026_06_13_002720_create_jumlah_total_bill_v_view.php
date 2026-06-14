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
        DB::statement("CREATE OR ALTER VIEW dbo.jumlah_total_bill_v
AS
SELECT     no_registrasi, no_kunjungan, kode_bagian, nama_bagian, bill_rs, bill_dr1, bill_dr2, lain_lain, diskon_rs, diskon_dr1, diskon_dr2, bill_total, bill_total_retur,kode_trans_far
FROM         dbo.jumlah_bill_1_v
UNION
SELECT     no_registrasi, no_kunjungan, kode_bagian, nama_bagian, bill_rs, bill_dr1, bill_dr2, lain_lain, diskon_rs, diskon_dr1, diskon_dr2, bill_total, bill_total_retur,kode_trans_far
FROM         dbo.jumlah_bill_2_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jumlah_total_bill_v]");
    }
};
