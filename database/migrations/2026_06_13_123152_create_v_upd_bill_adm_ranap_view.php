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
        DB::statement("CREATE VIEW dbo.v_upd_bill_adm_ranap
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs_jatah, 
                      0.05 * dbo.v_billing_administrasi_ranap.total_billing AS adm_baru, dbo.tc_trans_pelayanan.status_selesai
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.v_billing_administrasi_ranap ON dbo.tc_trans_pelayanan.no_registrasi = dbo.v_billing_administrasi_ranap.no_registrasi
WHERE     (dbo.tc_trans_pelayanan.jenis_tindakan = 2) AND (dbo.tc_trans_pelayanan.nama_tindakan LIKE 'biaya%administrasi')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_upd_bill_adm_ranap]");
    }
};
