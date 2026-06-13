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
        DB::unprepared("

CREATE OR ALTER PROCEDURE [dbo].[semi_jurnal_obat_bebas_sp]
as
--transaksi obat karyawan, resep luar dan obat bebas 
exec inp_tran_kasir_obat_bebas_sp;
exec inp_tran_sed_obat_bebas_sp;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS semi_jurnal_obat_bebas_sp");
    }
};
