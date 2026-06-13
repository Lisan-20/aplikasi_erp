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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_vk_tgl_v
AS
SELECT     tgl, bln, thn, kode_bagian from  lap_kunjungan_vk_baru_v union 
SELECT     tgl, bln, thn, kode_bagian from  lap_kunjungan_vk_lama_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_vk_tgl_v]");
    }
};
