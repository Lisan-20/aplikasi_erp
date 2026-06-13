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
        DB::statement("CREATE VIEW dbo.upd_trf2016_penunjang_v
AS
SELECT     dbo.upd_trf2016_penunjang.kode_tarif, dbo.upd_trf2016_penunjang.nama_tindakan, dbo.upd_trf2016_penunjang.total, dbo.upd_trf2016_penunjang.bill_rs, 
                      dbo.upd_trf2016_penunjang.bill_dr, dbo.upd_trf2016_penunjang.klas, dbo.mt_master_tarif_detail.bill_rs AS bill_rs_upd, dbo.mt_master_tarif_detail.bill_dr1, 
                      dbo.mt_master_tarif_detail.total AS total_upd, dbo.mt_master_tarif_detail.kode_klas
FROM         dbo.mt_master_tarif_detail INNER JOIN
                      dbo.upd_trf2016_penunjang ON dbo.mt_master_tarif_detail.kode_tarif = dbo.upd_trf2016_penunjang.kode_tarif
WHERE     (dbo.upd_trf2016_penunjang.klas = 4) AND (dbo.mt_master_tarif_detail.kode_klas = 4)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_trf2016_penunjang_v]");
    }
};
