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
        DB::statement("CREATE OR ALTER VIEW dbo.kasir_batal_v
AS
SELECT     db_17415.dbo.tc_trans_kasir.kode_tc_trans_kasir, db_17415.dbo.tc_trans_kasir.status_batal, tc_trans_kasir_1.status_batal AS batal
FROM         db_17415.dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_kasir AS tc_trans_kasir_1 ON db_17415.dbo.tc_trans_kasir.kode_tc_trans_kasir = tc_trans_kasir_1.kode_tc_trans_kasir AND 
                      db_17415.dbo.tc_trans_kasir.no_registrasi = tc_trans_kasir_1.no_registrasi
WHERE     (tc_trans_kasir_1.status_batal = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kasir_batal_v]");
    }
};
