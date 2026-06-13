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
        DB::statement("CREATE VIEW dbo.ks_antrian_um_v
AS
SELECT     TOP 100 PERCENT a.*, b.nama_pasien AS nama_pasien, c.nama_bagian AS nama_bagian
FROM         dbo.tc_trans_pelayanan a LEFT OUTER JOIN
                      dbo.mt_master_pasien b ON a.no_mr = b.no_mr LEFT OUTER JOIN
                      dbo.mt_bagian c ON a.kode_bagian = c.kode_bagian
WHERE     (a.status_selesai <= 2)
ORDER BY a.kode_trans_pelayanan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ks_antrian_um_v]");
    }
};
