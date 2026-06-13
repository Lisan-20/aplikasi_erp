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
        DB::statement("CREATE VIEW dbo.tc_trans_pelayanan_tind_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.kode_bagian, dbo.mt_bagian.nama_bagian, 
                      dbo.tc_trans_pelayanan.no_registrasi
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian
GROUP BY dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.kode_bagian, dbo.mt_bagian.nama_bagian, 
                      dbo.tc_trans_pelayanan.no_registrasi
HAVING      (dbo.tc_trans_pelayanan.jenis_tindakan IN (3, 7)) AND (dbo.tc_trans_pelayanan.nama_tindakan NOT LIKE '%Administrasi%')
ORDER BY dbo.tc_trans_pelayanan.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_trans_pelayanan_tind_v]");
    }
};
