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
        DB::statement("


CREATE VIEW dbo.ak_dd_mapping_v
AS
SELECT     TOP 100 PERCENT dbo.ak_dd_mapping_lv_1_v.nama_mapping_kb AS nama_mapping_1, 
                      dbo.ak_dd_mapping_kb.nama_mapping_kb AS nama_mapping_2, dbo.ak_dd_mapping_kb_det.id_ak_dd_mapping_kb_det, 
                      dbo.ak_dd_mapping_kb_det.acc_type, dbo.ak_dd_mapping_kb_det.acc_no, dbo.ak_dd_mapping_kb_det.keterangan_det, dbo.mt_account.acc_nama, 
                      dbo.ak_dd_mapping_kb_det.kode_mapping_kb, dbo.ak_dd_mapping_kb.status_aktif, dbo.ak_dd_mapping_kb.id_ak_dd_mapping_kb
FROM         dbo.ak_dd_mapping_lv_1_v INNER JOIN
                      dbo.ak_dd_mapping_kb ON dbo.ak_dd_mapping_lv_1_v.kode_mapping_kb = dbo.ak_dd_mapping_kb.referensi INNER JOIN
                      dbo.mt_account INNER JOIN
                      dbo.ak_dd_mapping_kb_det ON dbo.mt_account.acc_no = dbo.ak_dd_mapping_kb_det.acc_no ON 
                      dbo.ak_dd_mapping_kb.kode_mapping_kb = dbo.ak_dd_mapping_kb_det.kode_mapping_kb
ORDER BY dbo.ak_dd_mapping_lv_1_v.kode_mapping_kb, dbo.ak_dd_mapping_kb.kode_mapping_kb



");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ak_dd_mapping_v]");
    }
};
