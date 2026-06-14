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
        DB::statement("CREATE OR ALTER VIEW dbo.v_tunjangan_bulanan
AS
SELECT     dbo.tc_tunjangan.id_tc_tunjangan, dbo.tc_tunjangan.npp, dbo.tc_tunjangan.nama_pegawai, dbo.tc_tunjangan.id_dd_kelompok, dbo.tc_tunjangan.kelompok, 
                      dbo.tc_tunjangan.id_dd_ket_tunjangan, dbo.tc_tunjangan.ket_tunjangan, dbo.tc_tunjangan.id_bln_awal, dbo.tc_tunjangan.bln_awal, dbo.tc_tunjangan.id_bln_akhir, 
                      dbo.tc_tunjangan.bln_akhir, dbo.tc_tunjangan.periode, dbo.tc_tunjangan.tahun, dbo.tc_tunjangan.jenis_tunj_kel, dbo.tc_tunjangan.ket_jenis_tunj_kel, 
                      dbo.tc_tunjangan.nilai_tunj_kel, dbo.tc_tunjangan.prosen_tunj_kel, dbo.tc_tunjangan.jumlah_tunj_kel, dbo.tc_tunjangan.input_id, dbo.tc_tunjangan.input_tgl, 
                      dbo.tc_tunjangan.status, dbo.tc_tunjangan.status_tgl, dbo.tc_tunjangan.id_mt_periode_gaji
FROM         dbo.mt_periode_gaji INNER JOIN
                      dbo.tc_tunjangan ON dbo.mt_periode_gaji.id_periode_gaji = dbo.tc_tunjangan.id_mt_periode_gaji
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_tunjangan_bulanan]");
    }
};
