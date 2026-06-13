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
        DB::statement("CREATE VIEW dbo.v_list_antrian_loket
AS
SELECT     dbo.tc_antrian_loket.kode_bagian, COUNT(dbo.tc_antrian_loket.kode_bagian) AS total_antrian, dbo.v_udah_apnggil_antrian.no_antrian, dbo.mt_bagian.nama_bagian
FROM         dbo.tc_antrian_loket INNER JOIN
                      dbo.mt_bagian ON dbo.tc_antrian_loket.kode_bagian = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.v_udah_apnggil_antrian ON dbo.tc_antrian_loket.kode_bagian = dbo.v_udah_apnggil_antrian.kode_bagian
WHERE     (DAY(dbo.tc_antrian_loket.tgl_antrian) = DAY(GETDATE())) AND (MONTH(dbo.tc_antrian_loket.tgl_antrian) = MONTH(GETDATE())) AND (YEAR(dbo.tc_antrian_loket.tgl_antrian) = YEAR(GETDATE()))
GROUP BY dbo.tc_antrian_loket.kode_bagian, dbo.v_udah_apnggil_antrian.no_antrian, dbo.mt_bagian.nama_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_list_antrian_loket]");
    }
};
