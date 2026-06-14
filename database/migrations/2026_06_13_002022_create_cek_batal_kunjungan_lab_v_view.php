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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_batal_kunjungan_lab_v
AS
SELECT DISTINCT dbo.tc_trans_pelayanan.kode_penunjang
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
WHERE     (dbo.tc_trans_pelayanan.no_mr = '036163') AND (dbo.tc_trans_pelayanan.kode_bagian = '050101') AND (dbo.tc_kunjungan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_batal_kunjungan_lab_v]");
    }
};
