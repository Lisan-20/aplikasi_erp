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
        DB::statement("CREATE OR ALTER VIEW dbo.estimasipelyanan_v
AS
SELECT     dbo.pl_tc_poli.kode_poli, dbo.pl_tc_poli.no_kunjungan, dbo.mt_jadwal_dokter.jam_mulai, dbo.pl_tc_poli.no_antrian, dbo.pl_tc_poli.no_antrian * 15 * 60000 AS waktu_tunggu, 
                      dbo.pl_tc_poli.tgl_jam_poli, { fn HOUR(dbo.mt_jadwal_dokter.jam_mulai) } * 3600000 AS waktu_mulai
FROM         dbo.mt_jadwal_dokter INNER JOIN
                      dbo.pl_tc_poli ON dbo.mt_jadwal_dokter.id_mt_jadwal_dokter = dbo.pl_tc_poli.id_mt_jadwal_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [estimasipelyanan_v]");
    }
};
