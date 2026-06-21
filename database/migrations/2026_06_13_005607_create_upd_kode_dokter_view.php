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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_kode_dokter
AS
SELECT     dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_rs_jatah, 
                      dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_registrasi.kode_dokter, 
                      dbo.tc_trans_pelayanan.tgl_transaksi
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_trans_pelayanan.kode_tarif > 0) AND (dbo.tc_trans_pelayanan.kode_dokter1 = '') AND (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) >= 7) AND 
                      (dbo.tc_trans_pelayanan.kode_tarif LIKE '2%') AND (dbo.tc_trans_pelayanan.bill_dr1_jatah > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kode_dokter]");
    }
};
