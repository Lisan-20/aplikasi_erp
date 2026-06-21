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
        DB::statement("CREATE OR ALTER VIEW dbo.dash_farmasi_detail_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_far, dbo.tc_trans_pelayanan.kode_bagian_asal AS kode_bagian, dbo.mt_bagian.nama_bagian
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian_asal = dbo.mt_bagian.kode_bagian
GROUP BY dbo.tc_trans_pelayanan.kode_trans_far, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.mt_bagian.nama_bagian
HAVING      (dbo.tc_trans_pelayanan.kode_trans_far IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dash_farmasi_detail_v]");
    }
};
