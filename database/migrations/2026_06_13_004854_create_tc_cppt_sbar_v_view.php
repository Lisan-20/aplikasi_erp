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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_cppt_sbar_v
AS
SELECT     dbo.tc_cppt_sbar.Id, dbo.tc_cppt_sbar.no_mr, dbo.tc_cppt_sbar.no_registrasi, dbo.tc_cppt_sbar.no_kunjungan, dbo.tc_cppt_sbar.tgl_jam, dbo.tc_cppt_sbar.kode_bagian, dbo.tc_cppt_sbar.hp_s, 
                      dbo.tc_cppt_sbar.instruksi, dbo.tc_cppt_sbar.user_id, dbo.tc_cppt_sbar.kode_dokter, dbo.tc_cppt_sbar.hp_o, dbo.tc_cppt_sbar.hp_a, dbo.tc_cppt_sbar.hp_p, dbo.tc_cppt_sbar.profesi, 
                      dbo.tc_cppt_sbar.id_user_dok, dbo.tc_cppt_sbar.id_user, dbo.tc_cppt_sbar.no_urut, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.jen_kelamin, dbo.tc_kunjungan.tgl_masuk, 
                      dbo.tc_cppt_sbar.flag_ver
FROM         dbo.tc_cppt_sbar INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_cppt_sbar.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_cppt_sbar.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_cppt_sbar_v]");
    }
};
