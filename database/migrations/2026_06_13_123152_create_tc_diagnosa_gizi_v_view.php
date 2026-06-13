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
        DB::statement("CREATE VIEW dbo.tc_diagnosa_gizi_v
AS
SELECT     dbo.tc_diagnosa_gizi.kd_gizi, dbo.tc_diagnosa_gizi.no_kunjungan, dbo.tc_diagnosa_gizi.no_registrasi, dbo.tc_diagnosa_gizi.no_mr, dbo.tc_diagnosa_gizi.id_diag_gizi_asupan, 
                      dbo.tc_diagnosa_gizi.id_diag_gizi_klinis, dbo.tc_diagnosa_gizi.id_diag_gizi_prilaku, dbo.tc_diagnosa_gizi.input_tgl, dbo.tc_diagnosa_gizi.id_user, dbo.tc_diagnosa_gizi.kode_rm, 
                      dbo.tc_diagnosa_gizi.no_urut, dbo.tc_diagnosa_gizi.id_diet, dbo.mt_diagnosa_gizi.nama_diagnosa AS asupan, mt_diagnosa_gizi_1.nama_diagnosa AS klinis, 
                      mt_diagnosa_gizi_2.nama_diagnosa AS prilaku, dbo.mt_jenis_diet.jenis_diet, dbo.tc_diagnosa_gizi.asupan AS tx_asupan, dbo.tc_diagnosa_gizi.klinis AS tx_klinis, 
                      dbo.tc_diagnosa_gizi.prilaku AS tx_prilaku, dbo.tc_emr_form.tgl_update
FROM         dbo.tc_diagnosa_gizi INNER JOIN
                      dbo.tc_emr_form ON dbo.tc_diagnosa_gizi.kode_rm = dbo.tc_emr_form.kode_rm AND dbo.tc_diagnosa_gizi.no_urut = dbo.tc_emr_form.no_urut AND 
                      dbo.tc_diagnosa_gizi.no_registrasi = dbo.tc_emr_form.no_registrasi LEFT OUTER JOIN
                      dbo.mt_jenis_diet ON dbo.tc_diagnosa_gizi.id_diet = dbo.mt_jenis_diet.id_diet LEFT OUTER JOIN
                      dbo.mt_diagnosa_gizi AS mt_diagnosa_gizi_2 ON dbo.tc_diagnosa_gizi.id_diag_gizi_prilaku = mt_diagnosa_gizi_2.id_diag_gizi LEFT OUTER JOIN
                      dbo.mt_diagnosa_gizi AS mt_diagnosa_gizi_1 ON dbo.tc_diagnosa_gizi.id_diag_gizi_klinis = mt_diagnosa_gizi_1.id_diag_gizi LEFT OUTER JOIN
                      dbo.mt_diagnosa_gizi ON dbo.tc_diagnosa_gizi.id_diag_gizi_asupan = dbo.mt_diagnosa_gizi.id_diag_gizi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_diagnosa_gizi_v]");
    }
};
