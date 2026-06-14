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
        DB::statement("
CREATE OR ALTER VIEW dbo.update_kasir_v
AS
SELECT     dbo.tc_trans_kasir.*, dbo.ks_tc_trans_um.no_registrasi AS no_registrasi_x, dbo.ks_tc_trans_um.no_mr AS no_mr_x
FROM         dbo.ks_tc_trans_um INNER JOIN
                      dbo.tc_trans_kasir ON dbo.ks_tc_trans_um.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kasir_v]");
    }
};
