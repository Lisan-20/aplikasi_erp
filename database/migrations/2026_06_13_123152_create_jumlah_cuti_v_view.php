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
        DB::statement("CREATE VIEW dbo.jumlah_cuti_v
AS
SELECT     id_dd_jenis_cuti, npp, jumlah_hari, YEAR(tgl_mulai_cuti) AS thn, MONTH(tgl_mulai_cuti) AS bln, tgl_pengajuan
FROM         dbo.tc_cuti
GROUP BY id_dd_jenis_cuti, npp, YEAR(tgl_mulai_cuti), MONTH(tgl_mulai_cuti), tgl_pengajuan, jumlah_hari
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jumlah_cuti_v]");
    }
};
