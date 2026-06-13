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
        DB::statement("CREATE VIEW dbo.update_kode_dokter
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.tgl_transaksi,
                       dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs_jatah, 
                      dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.jumlah, dbo.tc_registrasi.kode_dokter
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_trans_pelayanan.nama_tindakan LIKE '%pem%dr%spesialis%') AND (dbo.tc_trans_pelayanan.kode_dokter1 IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kode_dokter]");
    }
};
