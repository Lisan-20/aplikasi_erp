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
        DB::statement("CREATE VIEW dbo.bill_paket_mcu_v
AS
SELECT     dbo.pl_mt_pasien_mcu_v.id_paket, SUM(dbo.tc_trans_pelayanan.bill_rs) AS billing, dbo.tc_trans_pelayanan.nama_tindakan
FROM         dbo.pl_mt_pasien_mcu_v INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pl_mt_pasien_mcu_v.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan AND 
                      dbo.pl_mt_pasien_mcu_v.no_mr = dbo.tc_trans_pelayanan.no_mr
GROUP BY dbo.pl_mt_pasien_mcu_v.id_paket, dbo.tc_trans_pelayanan.nama_tindakan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bill_paket_mcu_v]");
    }
};
