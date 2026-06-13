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
        DB::statement("CREATE OR ALTER VIEW dbo.fee_dokter_manual_v
AS
SELECT     id_fee_dr_manual, no_kuitansi, seri_kuitansi, no_reg, no_mr, kode_bag, kode_dr, bill_rs, bill_dr, tgl_kuitansi, kode_tarif, nama_tarif, keterangan, tgl_billing, 
                      kode_kelompok, kode_klas, bill_rs_real, bill_dr_real, flag_dr, tgl_input, no_induk
FROM         dbo.fee_dokter_manual_temp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fee_dokter_manual_v]");
    }
};
