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
        DB::statement("CREATE VIEW dbo.upd_trf2016_rajal_v
AS
SELECT     dbo.upd_trf2016_rajal.kode_tarif, dbo.upd_trf2016_rajal.nama_tindakan, dbo.upd_trf2016_rajal.total, dbo.upd_trf2016_rajal.bill_rs, dbo.upd_trf2016_rajal.bill_dr, dbo.upd_trf2016_rajal.klas, 
                      dbo.mt_master_tarif_detail.bill_rs AS bill_rs_upd, dbo.mt_master_tarif_detail.bill_dr1, dbo.mt_master_tarif_detail.total AS total_upd
FROM         dbo.mt_master_tarif_detail INNER JOIN
                      dbo.upd_trf2016_rajal ON dbo.mt_master_tarif_detail.kode_tarif = dbo.upd_trf2016_rajal.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_trf2016_rajal_v]");
    }
};
