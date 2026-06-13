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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_pengiriman_ke_unit_v
AS
SELECT        dbo.tc_permintaan_inst.nomor_permintaan, dbo.tc_permintaan_inst.tgl_permintaan, dbo.tc_permintaan_inst.kode_bagian_minta, dbo.tc_permintaan_inst.kode_bagian_kirim, dbo.tc_permintaan_inst.status_batal, 
                         dbo.tc_permintaan_inst_det.jumlah_permintaan, dbo.tc_permintaan_inst_det.kode_brg, dbo.tc_permintaan_inst_det.satuan, dbo.tc_permintaan_inst.nomor_pengiriman, 
                         dbo.tc_permintaan_inst.tgl_pengiriman
FROM            dbo.tc_permintaan_inst INNER JOIN
                         dbo.tc_permintaan_inst_det ON dbo.tc_permintaan_inst.id_tc_permintaan_inst = dbo.tc_permintaan_inst_det.id_tc_permintaan_inst
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_pengiriman_ke_unit_v]");
    }
};
