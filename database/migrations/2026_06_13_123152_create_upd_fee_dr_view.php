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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_fee_dr
AS
SELECT     dbo.fee_dokter_manual_temp.id_fee_dr_manual, dbo.fee_dokter_rinap_temp.id_fee_dr_manual AS Expr1
FROM         dbo.fee_dokter_rinap_temp INNER JOIN
                      dbo.fee_dokter_manual_temp ON dbo.fee_dokter_rinap_temp.no_registrasi = dbo.fee_dokter_manual_temp.no_reg AND 
                      dbo.fee_dokter_rinap_temp.kode_dr = dbo.fee_dokter_manual_temp.kode_dr AND dbo.fee_dokter_rinap_temp.kode_bagian = dbo.fee_dokter_manual_temp.kode_bag
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_fee_dr]");
    }
};
