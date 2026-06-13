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
        DB::statement("CREATE VIEW dbo.cek_bill_fisio_nonbpjs_v
AS
SELECT     no_mr, no_registrasi, SUM(fee) AS bill, tgl_jam, no_kunjungan
FROM         dbo.v_bill_fisio_nonbpjs
GROUP BY no_mr, no_registrasi, tgl_jam, no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_bill_fisio_nonbpjs_v]");
    }
};
