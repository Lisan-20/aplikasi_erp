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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_permintaan_inst_nm_v
AS
SELECT     dbo.tc_permintaan_inst_nm.nomor_permintaan, dbo.tc_permintaan_inst_nm.tgl_permintaan, dbo.tc_permintaan_inst_nm.kode_bagian_minta, 
                      dbo.tc_permintaan_inst_nm.kode_bagian_kirim, dbo.tc_permintaan_inst_nm.status_batal, dbo.tc_permintaan_inst_nm.tgl_input, 
                      dbo.tc_permintaan_inst_nm.id_dd_user, dbo.mt_bagian.nama_bagian AS nama_bagian_minta, dbo.tc_permintaan_inst_nm.id_tc_permintaan_inst, 
                      dbo.tc_permintaan_inst_nm.tgl_input_terima, dbo.tc_permintaan_inst_nm.tgl_pengiriman, dbo.tc_permintaan_inst_nm.nomor_pengiriman
FROM         dbo.tc_permintaan_inst_nm INNER JOIN
                      dbo.mt_bagian ON dbo.tc_permintaan_inst_nm.kode_bagian_minta = dbo.mt_bagian.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_permintaan_inst_nm_v]");
    }
};
