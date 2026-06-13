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
        DB::statement("CREATE VIEW dbo.v_tc_cuti_2
AS
SELECT     dbo.mt_karyawan.nama_pegawai, dbo.tc_cuti.id_htc_cuti, dbo.tc_cuti.npp, dbo.tc_cuti.id_dd_jenis_cuti, dbo.tc_cuti.tgl_pengajuan, dbo.tc_cuti.tgl_izin, dbo.tc_cuti.no_surat_izin, 
                      dbo.tc_cuti.jumlah_hari, dbo.tc_cuti.tgl_akhir_cuti, dbo.tc_cuti.tgl_mulai_cuti, dbo.tc_cuti.keterangan, dbo.tc_cuti.input_id, dbo.tc_cuti.input_tgl, dbo.tc_cuti.status, dbo.tc_cuti.status_tgl, 
                      dbo.tc_cuti.ko_wil, dbo.tc_cuti.flag_ver, dbo.tc_cuti.tgl_ver, dbo.tc_cuti.user_ver
FROM         dbo.tc_cuti INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_cuti.npp = dbo.mt_karyawan.npp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_tc_cuti_2]");
    }
};
