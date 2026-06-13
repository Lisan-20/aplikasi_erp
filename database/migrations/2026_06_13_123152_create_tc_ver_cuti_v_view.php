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
        DB::statement("CREATE VIEW dbo.tc_ver_cuti_v
AS
SELECT     dbo.tc_cuti.id_htc_cuti, dbo.tc_cuti.npp, dbo.dd_jenis_cuti.id_dd_jenis_cuti, dbo.tc_cuti.tgl_pengajuan, dbo.tc_cuti.tgl_izin, dbo.tc_cuti.no_surat_izin, dbo.tc_cuti.tgl_mulai_cuti, 
                      dbo.dd_jenis_cuti.jenis_cuti, dbo.tc_cuti.tgl_akhir_cuti, dbo.tc_cuti.jumlah_hari, dbo.tc_cuti.keterangan, dbo.tc_cuti.input_id, dbo.tc_cuti.input_tgl, dbo.tc_cuti.status, dbo.tc_cuti.status_tgl, 
                      dbo.tc_cuti.ko_wil, dbo.tc_cuti.flag_ver, dbo.tc_cuti.tgl_ver, dbo.tc_cuti.user_ver, dbo.tc_cuti.flag_ver_ka_unit, dbo.tc_cuti.tgl_ver_ka_unit, dbo.tc_cuti.user_ver_ka_unit, dbo.tc_cuti.flag_ver_ka_bid, 
                      dbo.tc_cuti.tgl_ver_ka_bid, dbo.tc_cuti.user_ver_ka_bid, dbo.tc_cuti.nama_file, dbo.tc_cuti.alasan_tolak, dbo.tc_cuti.user_tolak, dbo.tc_cuti.tgl_tolak, dbo.tc_cuti.flag_ver_wadir, 
                      dbo.tc_cuti.tgl_ver_wadir, dbo.tc_cuti.ket_ka_unit, dbo.tc_cuti.ket_ka_bid, dbo.tc_cuti.ket_wadir, dbo.tc_cuti.user_ver_wadir
FROM         dbo.tc_cuti INNER JOIN
                      dbo.dd_jenis_cuti ON dbo.tc_cuti.id_dd_jenis_cuti = dbo.dd_jenis_cuti.id_dd_jenis_cuti
WHERE     (dbo.tc_cuti.status = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_ver_cuti_v]");
    }
};
