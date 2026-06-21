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
        DB::statement("CREATE OR ALTER VIEW dbo.penggunaan_obat_ri_det_v
AS
SELECT     kode_brg, nama_brg, SUM(jumlah) AS jumlah_pakai, kode_trans_far, kd_tr_resep
FROM         dbo.tc_penggunaan_obat_ri_det
GROUP BY kode_brg, nama_brg, kode_trans_far, kd_tr_resep
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penggunaan_obat_ri_det_v]");
    }
};
