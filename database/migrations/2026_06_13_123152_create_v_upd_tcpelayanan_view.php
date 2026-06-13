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
        DB::statement("CREATE OR ALTER VIEW dbo.v_upd_tcpelayanan
AS
SELECT     dbo.v_upd_bpjs.kode_tarif, dbo.v_upd_bpjs.nama_tarif, dbo.v_upd_bpjs.bill_rs_bpjs, dbo.v_upd_bpjs.bill_dr1_bpjs, dbo.v_upd_bpjs.bill_dr2_bpjs, 
                      dbo.v_upd_bpjs.total_bpjs, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_dr2, dbo.tc_trans_pelayanan.kode_klas, 
                      dbo.v_upd_bpjs.kode_klas AS klas_upd
FROM         dbo.v_upd_bpjs INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.v_upd_bpjs.kode_tarif = dbo.tc_trans_pelayanan.kode_tarif AND 
                      dbo.v_upd_bpjs.kode_klas = dbo.tc_trans_pelayanan.kode_klas
WHERE     (dbo.v_upd_bpjs.kode_tarif IN (310010132))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_upd_tcpelayanan]");
    }
};
