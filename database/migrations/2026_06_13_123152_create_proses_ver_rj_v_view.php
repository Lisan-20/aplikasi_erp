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
        DB::statement("CREATE VIEW dbo.proses_ver_rj_v
AS
SELECT     dbo.jumlah_kasir_rj_ver_v.kode_tc_trans_kasir, dbo.jumlah_bill_rj_ver_v.billing, dbo.jumlah_kasir_rj_ver_v.kasir, dbo.jumlah_kasir_rj_ver_v.flag_jurnal
FROM         dbo.jumlah_bill_rj_ver_v INNER JOIN
                      dbo.jumlah_kasir_rj_ver_v ON dbo.jumlah_bill_rj_ver_v.billing = dbo.jumlah_kasir_rj_ver_v.kasir AND 
                      dbo.jumlah_bill_rj_ver_v.kode_tc_trans_kasir = dbo.jumlah_kasir_rj_ver_v.kode_tc_trans_kasir
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [proses_ver_rj_v]");
    }
};
