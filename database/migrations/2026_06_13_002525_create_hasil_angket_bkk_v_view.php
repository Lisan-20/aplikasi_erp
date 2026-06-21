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
        DB::statement("CREATE OR ALTER VIEW dbo.hasil_angket_bkk_v
AS
SELECT     id_jawaban, bagian, nama_pegawai, nama_pegawai1
FROM         dbo.hasil_angket_bkk
GROUP BY id_jawaban, bagian, nama_pegawai, nama_pegawai1
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hasil_angket_bkk_v]");
    }
};
