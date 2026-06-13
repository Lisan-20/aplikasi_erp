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
        DB::statement("CREATE VIEW dbo.tc_hand_over_shift_cetak_v
AS
SELECT     dbo.tc_hand_over_shift.no_urut_over, dbo.tc_hand_over_shift.kode_shift, dbo.tc_hand_over_shift.no_induk_kirim, dbo.tc_hand_over_shift.no_induk_terima, dbo.tc_hand_over_shift.tgl_jam, 
                      dbo.tc_hand_over_shift.kode_dokter, dbo.tc_hand_over_shift_detail.no_urut, dbo.tc_hand_over_shift_detail.no_mr, dbo.tc_hand_over_shift_detail.no_registrasi, 
                      dbo.tc_hand_over_shift_detail.no_kunjungan, dbo.tc_hand_over_shift_detail.bag_pas, dbo.tc_hand_over_shift_detail.dr_merawat, dbo.tc_hand_over_shift_detail.dok_tgl_jam, 
                      dbo.tc_hand_over_shift_detail.dok_hp_o, dbo.tc_hand_over_shift_detail.dok_hp_s, dbo.tc_hand_over_shift_detail.dok_hp_a, dbo.tc_hand_over_shift_detail.dok_hp_p, 
                      dbo.tc_hand_over_shift_detail.dok_instruksi, dbo.tc_hand_over_shift_detail.tgl_jam_per, dbo.tc_hand_over_shift_detail.hp_s, dbo.tc_hand_over_shift_detail.hp_o, 
                      dbo.tc_hand_over_shift_detail.hp_a, dbo.tc_hand_over_shift_detail.hp_p, dbo.tc_hand_over_shift_detail.instruksi, dbo.tc_hand_over_shift_detail.notes
FROM         dbo.tc_hand_over_shift INNER JOIN
                      dbo.tc_hand_over_shift_detail ON dbo.tc_hand_over_shift.no_urut_over = dbo.tc_hand_over_shift_detail.no_urut_over
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_hand_over_shift_cetak_v]");
    }
};
