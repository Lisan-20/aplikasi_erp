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
        DB::unprepared("create proc [dbo].[penerimaan_nol_sp]

as

delete from tc_penerimaan_barang_detail Where jumlah_kirim=0;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS penerimaan_nol_sp");
    }
};
