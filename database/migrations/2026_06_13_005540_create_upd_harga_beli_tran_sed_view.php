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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_harga_beli_tran_sed
AS
SELECT     dbo.tran_sed.kd_tr_resep, dbo.fr_tc_far_detail.harga_beli, dbo.tran_sed.harga_beli AS harga_beli_tran, dbo.tran_sed.kode_barang, dbo.tran_sed.nama_tindakan, dbo.tran_sed.jumlah
FROM         dbo.fr_tc_far_detail INNER JOIN
                      dbo.tran_sed ON dbo.fr_tc_far_detail.kd_tr_resep = dbo.tran_sed.kd_tr_resep
WHERE     (dbo.tran_sed.harga_beli IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_harga_beli_tran_sed]");
    }
};
