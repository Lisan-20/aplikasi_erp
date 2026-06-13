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
        DB::statement("CREATE VIEW dbo.tc_hand_over_shift_v
AS
SELECT     dbo.tc_hand_over_shift.no_urut_over, dbo.tc_hand_over_shift.tgl_jam, dbo.tc_hand_over_shift.kode_shift, dbo.tc_hand_over_shift.kode_dokter, 
                      dbo.mt_karyawan.nama_pegawai AS nama_per_terima, mt_karyawan_1.nama_pegawai AS nama_per_kirm, dbo.tc_hand_over_shift.no_induk_kirim, dbo.tc_hand_over_shift.no_induk_terima, 
                      mt_karyawan_2.nama_pegawai AS nama_dokter
FROM         dbo.mt_karyawan AS mt_karyawan_1 INNER JOIN
                      dbo.tc_hand_over_shift ON mt_karyawan_1.no_induk = dbo.tc_hand_over_shift.no_induk_kirim INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_hand_over_shift.no_induk_terima = dbo.mt_karyawan.no_induk INNER JOIN
                      dbo.mt_karyawan AS mt_karyawan_2 ON dbo.tc_hand_over_shift.kode_dokter = mt_karyawan_2.kode_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_hand_over_shift_v]");
    }
};
