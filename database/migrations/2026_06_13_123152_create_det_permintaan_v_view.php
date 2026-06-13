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
        DB::statement("CREATE VIEW dbo.det_permintaan_v
AS
SELECT     dbo.mt_depo_stok_minimum_v.*, dbo.tc_permintaan_v.nomor_permintaan, dbo.tc_permintaan_v.tgl_permintaan, dbo.tc_permintaan_v.jumlah_permintaan, 
                      dbo.tc_permintaan_v.id_tc_permintaan_inst, dbo.tc_permintaan_v.nama_bagian_minta, dbo.tc_permintaan_v.nama_bagian_kirim
FROM         dbo.mt_depo_stok_minimum_v LEFT OUTER JOIN
                      dbo.tc_permintaan_v ON dbo.mt_depo_stok_minimum_v.kode_brg = dbo.tc_permintaan_v.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [det_permintaan_v]");
    }
};
