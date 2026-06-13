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
        DB::statement("CREATE VIEW dbo.tarif_bpjs_2
AS
SELECT     dbo.mt_master_tarif_detail_bpjs.kode_tarif, dbo.mt_master_tarif_detail_bpjs.kode_klas, dbo.mt_master_tarif_detail_bpjs.bill_rs, 
                      dbo.mt_master_tarif_detail_bpjs.bill_dr1, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.jenis_tindakan
FROM         dbo.mt_master_tarif_detail_bpjs INNER JOIN
                      dbo.mt_master_tarif ON dbo.mt_master_tarif_detail_bpjs.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.mt_master_tarif.jenis_tindakan <> 4) AND (dbo.mt_master_tarif_detail_bpjs.kode_klas <> 7) AND (NOT (dbo.mt_master_tarif.kode_bagian LIKE '05%'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tarif_bpjs_2]");
    }
};
