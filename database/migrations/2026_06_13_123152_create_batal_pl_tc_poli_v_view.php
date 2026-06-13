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
        DB::statement("CREATE OR ALTER VIEW dbo.batal_pl_tc_poli_v
AS
SELECT     dbo.pl_tc_poli.id_pl_tc_poli, dbo.pl_tc_poli.kode_poli, dbo.pl_tc_poli.no_kunjungan, dbo.pl_tc_poli.kode_bagian, dbo.pl_tc_poli.no_antrian, dbo.pl_tc_poli.tgl_jam_poli, dbo.pl_tc_poli.kode_dokter, 
                      dbo.pl_tc_poli.kode_resep, dbo.pl_tc_poli.kode_gcu, dbo.pl_tc_poli.status_periksa, dbo.pl_tc_poli.no_induk, dbo.pl_tc_poli.kode_jadwal, dbo.pl_tc_poli.status_isihasil, dbo.pl_tc_poli.status_bayar, 
                      dbo.pl_tc_poli.datang, dbo.pl_tc_poli.id_mt_jadwal_dokter, dbo.pl_tc_poli.status_batal, dbo.pl_tc_poli.jam_praktek, dbo.pl_tc_poli.no_antrian_bpjs, dbo.pl_tc_poli.no_antrian_umum, 
                      dbo.pl_tc_poli.tgl_jam_panggil, dbo.pl_tc_poli.tgl_jam_keluar, dbo.pl_tc_poli.status_panggil, dbo.pl_tc_poli.status_keluar, dbo.pl_tc_poli_batal.id_pl_tc_poli AS Expr1
FROM         dbo.pl_tc_poli LEFT OUTER JOIN
                      dbo.pl_tc_poli_batal ON dbo.pl_tc_poli.id_pl_tc_poli = dbo.pl_tc_poli_batal.id_pl_tc_poli
WHERE     (dbo.pl_tc_poli.no_kunjungan IN
                          (SELECT     no_kunjungan
                            FROM          dbo.tc_kunjungan_batal)) AND (dbo.pl_tc_poli_batal.id_pl_tc_poli IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [batal_pl_tc_poli_v]");
    }
};
