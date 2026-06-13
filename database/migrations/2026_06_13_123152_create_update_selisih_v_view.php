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
        DB::statement("CREATE VIEW dbo.update_selisih_v
AS
SELECT        TOP (100) PERCENT dbo.mt_master_tarif_detail.kode_klas, dbo.mt_master_tarif_detail.kode_tarif, dbo.mt_master_tarif.nama_tarif, 
                         dbo.mt_master_tarif_detail.bill_rs_bpjs, dbo.mt_master_tarif_detail.bill_dr1_bpjs, dbo.mt_master_tarif_detail.total_bpjs
FROM            dbo.mt_master_tarif_detail INNER JOIN
                         dbo.mt_master_tarif ON dbo.mt_master_tarif_detail.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE        (dbo.mt_master_tarif_detail.total_bpjs < dbo.mt_master_tarif_detail.bill_rs_bpjs + dbo.mt_master_tarif_detail.bill_dr1_bpjs)
ORDER BY dbo.mt_master_tarif_detail.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_selisih_v]");
    }
};
