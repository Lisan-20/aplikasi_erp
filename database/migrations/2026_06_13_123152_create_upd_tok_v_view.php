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
        DB::statement("CREATE VIEW dbo.upd_tok_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, 
                      dbo.tc_trans_pelayanan_tarik.bill_rs_jatah AS bill_rs_jatah_tarik, dbo.tc_trans_pelayanan_tarik.bill_dr1_jatah AS bill_dr1_jatah_tarik, 
                      dbo.tc_trans_pelayanan_tarik.bill_rs, dbo.tc_trans_pelayanan_tarik.bill_dr1
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_pelayanan_tarik ON dbo.tc_trans_pelayanan.kode_trans_pelayanan = dbo.tc_trans_pelayanan_tarik.kode_trans_pelayanan AND 
                      dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_trans_pelayanan_tarik.no_registrasi
WHERE     (dbo.tc_trans_pelayanan.no_registrasi = 128120)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_tok_v]");
    }
};
