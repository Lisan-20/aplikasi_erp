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
        DB::statement("CREATE OR ALTER VIEW dbo.v_potongan_bulanan
AS
SELECT     dbo.tc_potongan.id_tc_potongan, dbo.tc_potongan.npp, dbo.tc_potongan.nama_pegawai, dbo.tc_potongan.id_dd_kelompok, dbo.tc_potongan.kelompok, 
                      dbo.tc_potongan.id_dd_ket_potongan, dbo.tc_potongan.ket_potongan, dbo.tc_potongan.id_bln_awal, dbo.tc_potongan.bln_awal, dbo.tc_potongan.id_bln_akhir, 
                      dbo.tc_potongan.bln_akhir, dbo.tc_potongan.periode, dbo.tc_potongan.tahun, dbo.tc_potongan.gaji_pokok, dbo.tc_potongan.jenis_pot_kel, 
                      dbo.tc_potongan.ket_jenis_pot_kel, dbo.tc_potongan.nilai_pot_kel, dbo.tc_potongan.prosen_pot_kel, dbo.tc_potongan.jumlah_pot_kel, dbo.tc_potongan.input_id, 
                      dbo.tc_potongan.input_tgl, dbo.tc_potongan.status, dbo.tc_potongan.status_tgl, dbo.tc_potongan.id_mt_periode_gaji
FROM         dbo.tc_potongan INNER JOIN
                      dbo.mt_periode_gaji ON dbo.tc_potongan.id_mt_periode_gaji = dbo.mt_periode_gaji.id_periode_gaji
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_potongan_bulanan]");
    }
};
